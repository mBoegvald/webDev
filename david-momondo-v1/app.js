/* ######################### GET FROM CITIES ####################### */
async function getFromCities() {
  oFromCityResults = document.querySelector("#fromCityResults");
  oFromCityResults.innerHTML = "";

  if (txtFromCity.value.length == 0) {
    oFromCityResults.style.display = "none";
    return;
  }

  var sSearchFor = txtFromCity.value;

  var jResponse = await fetch(
    "api/api-get-from-cities.php?fromCityName=" + sSearchFor
  );
  var aCities = await jResponse.json();

  for (var i = 0; i < aCities.flyingFromCities.length; i++) {
    renderFromCity(aCities.flyingFromCities[i].from);
  }
  oFromCityResults.style.display = "grid";
}

// Show the city in the "drop down"
function renderFromCity(sCityName) {
  oFromCityResults = document.querySelector("#fromCityResults");
  var sDivCityName = `<div onclick="selectFromCity(this)">${sCityName}</div>`;
  oFromCityResults.innerHTML += sDivCityName;
}

// Select a city
function selectFromCity(objectDOM) {
  var sCityName = objectDOM.innerHTML;
  txtFromCity.value = sCityName;
  fromCityResults.style.display = "none";
}

/* ############################## GET TO CITIES ######################### */
async function getToCities() {
  oToCityResults = document.querySelector("#toCityResults");
  oToCityResults.innerHTML = "";

  if (txtToCity.value.length == 0) {
    oToCityResults.style.display = "none";
    return;
  }

  var sSearchFor = txtToCity.value;

  var jResponse = await fetch(
    "api/api-get-to-cities.php?toCityName=" + sSearchFor
  );
  var aCities = await jResponse.json();

  for (var i = 0; i < aCities.flyingToCities.length; i++) {
    renderToCity(aCities.flyingToCities[i].to);
  }
  oToCityResults.style.display = "grid";
}

// Show the city in the "drop down"
function renderToCity(sCityName) {
  oToCityResults = document.querySelector("#toCityResults");
  var sDivCityName = `<div onclick="selectToCity(this)">${sCityName}</div>`;
  oToCityResults.innerHTML += sDivCityName;
}

// Select a city
function selectToCity(objectDOM) {
  var sCityName = objectDOM.innerHTML;
  txtToCity.value = sCityName;
  toCityResults.style.display = "none";
}

/* ##################### SWITCH CITIES ################## */

// Switch cities by clicking on the switch button between from- and to input field
function switchCities() {
  var fromCity = document.querySelector("#txtFromCity").value;
  var toCity = document.querySelector("#txtToCity").value;

  document.querySelector("#txtFromCity").value = toCity;
  document.querySelector("#txtToCity").value = fromCity;
}

/* ##################### SHOW FOR SELECTED FLIGHT ROUTE(S) ################## */

async function getFlights() {
  var searchedFromCity = txtFromCity.value;
  var searchedToCity = txtToCity.value;
  var connection = await fetch(
    "api/api-get-flights.php?fromCityName=" +
      searchedFromCity +
      "&toCityName=" +
      searchedToCity
  );
  var jData = await connection.json();
  document.querySelector("#flights").innerHTML = "";
  var sFlightsRoutes = "";

  for (var i = 0; i < jData.length; i++) {
    if (
      jData[i].schedule[0].from == searchedFromCity &&
      jData[i].schedule[0].to == searchedToCity
    ) {
      sFlightsRoutes += `<div id="flight">
        <div id="flightRoute">`;

      for (var n = 0; n < jData[i].schedule.length; n++) {
        // Convert totalTime to hours and minuts
        var init = jData[i].schedule[n].totalTime;
        var hours = Math.floor(init / 3600);
        var minutes = Math.floor((init / 60) % 60);
        var totalTime = hours + "h. " + minutes + "min.";

        // Convert epoch departureTime into human readable time
        var epochTime = new Date(jData[i].schedule[n].departureTime * 1000);
        var months = [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec"
        ]; // Array of months because in javascript months will be outputted as 0,1,2 etc.
        var year = epochTime.getFullYear();
        var month = months[epochTime.getMonth()];
        var date = epochTime.getDate();
        var hour = epochTime.getHours();
        var min = epochTime.getMinutes();
        var time = date + "-" + month + "-" + year + " " + hour + ":" + min;

        sFlightsRoutes += `
          <div class="row">
            <div>
              <input type='checkbox'>
            </div>
            <div>
              <img class='airline-icon' src='icons/${jData[i].schedule[n].companyShortcut}.png'>
            </div>
            <div>
            ${time}
              <p>${jData[i].schedule[n].companyShortcut}</p>
            </div>
            <div>`;
        if (jData[i].schedule.length === 1) {
          sFlightsRoutes += `Direct`;
        } else {
          sFlightsRoutes += ` 1 stop
          <p>${jData[i].schedule[0].to}`;
        }
        sFlightsRoutes += `</p>
            </div>
            <div>
            ${totalTime}
              <p>${jData[i].schedule[n].fromShortcut} - ${jData[i].schedule[n].toShortcut}</p>
            </div>
          </div>`;
      }
      sFlightsRoutes += `</div>
      <div id='flightBuy'>
    <div>
      ${jData[i].price} ${jData[i].currency}
    </div>
      <button id='${jData[i].id}' onclick='checkFlightId(event)'>BUY</button>
    </div>
  </div>`;
    }
  }
  document.getElementById("flights").innerHTML = sFlightsRoutes;
}

/* ##################### BUY TICKET ################## */

var bookingInfo;

async function checkFlightId(event) {
  var connection = await fetch("data.json");
  var jData = await connection.json();

  console.log(event.target.id);
  for (var i = 0; i < jData.length; i++) {
    console.log(jData[i].id);
    if (event.target.id == jData[i].id) {
      bookingInfo = jData[i].id;
      //console.log(jData[i].id);
      document.querySelector("#buyTicketModal").style.display = "block";
    }
  }
}

async function buyFlight(bookingInfo) {
  console.log("test");
  var oForm = document.querySelector("#frmBuyTicket");
  var jConnection = await fetch("api/api-book-flight.php?id=" + bookingInfo, {
    method: "POST",
    body: new FormData(oForm)
  });

  var jResponse = await jConnection.text();

  console.log(jResponse);
}

/* ##################### VALIDATION ################## */

function validate() {
  if (event.type == "submit") {
    var oForm = event.target;
    var aElements = oForm.querySelectorAll("[data-validate]");
  } else {
    var aElements = [event.target];
  }

  for (let i = 0; i < aElements.length; i++) {
    aElements[i].classList.remove("invalid");
    let sValidateType = aElements[i].getAttribute("data-validate");
    switch (sValidateType) {
      case "email":
        var sData = aElements[i].value;
        var regEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!regEmail.test(sData)) {
          aElements[i].classList.add("invalid");
        }
        break;
      case "string":
        var sData = aElements[i].value;
        var regName = /^[a-zA-Z0-9 ]+$/;
        var iMin = aElements[i].getAttribute("data-min");
        var iMax = aElements[i].getAttribute("data-max");
        if (
          sData.length < iMin ||
          sData.length > iMax ||
          !regName.test(sData)
        ) {
          aElements[i].classList.add("invalid");
        }
        break;
      case "integer":
        var sData = aElements[i].value;
        if (/^\d+$/.test(sData) === false) {
          console.log("NOT A VALID NUMBER");
          aElements[i].classList.add("invalid");
          break;
        }
        sData = parseInt(aElements[i].value);
        var iMin = parseInt(aElements[i].getAttribute("data-min"));
        var iMax = parseInt(aElements[i].getAttribute("data-max"));
        if (sData < iMin || sData > iMax) {
          aElements[i].classList.add("invalid");
        }
        break;
    }
  }
  if (oForm) {
    return oForm.querySelectorAll(".invalid").length ? false : true;
    // if (oForm.querySelectorAll(".invalid").length) {
    //   return false;
    // } else {
    //   return true;
    // }
  }
}
