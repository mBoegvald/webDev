// Fired oninput, searches for the cities in the array from the url.

async function getCities(fromOrTo) {
  var oCityResults;
  if (fromOrTo == "from") {
    oCityResults = document.querySelector("#fromCityResults");
    oCityResults.innerHTML = "";
    sSearchFor = txtSearchFromCity.value;
  }
  if (fromOrTo == "to") {
    oCityResults = document.querySelector("#toCityResults");
    oCityResults.innerHTML = "";
    sSearchFor = txtSearchToCity.value;
  }

  let url = `api/api-search-flight.php?cityName=${sSearchFor}&fromOrTo=${fromOrTo}`;

  var jResponse = await fetch(url);
  var aCities = await jResponse.json();

  console.log(aCities);

  if (sSearchFor.length == 0 || !aCities[fromOrTo].length) {
    oCityResults.style.display = "none";
    return;
  }

  for (i = 0; i < aCities[fromOrTo].length; i++) {
    renderCity(aCities[fromOrTo][i], oCityResults);
  }
  oCityResults.style.display = "grid";
}

async function getSearchedFlights(fromOrTo) {
  let url = `api/api-get-searched-flights.php?cityName=${sSearchFor}&fromOrTo=${fromOrTo}`;
  var jResponse = await fetch(url);
  var aCities = await jResponse.json();
  var sFlightDiv = "";
  for (i = 0; i < aCities.length; i++) {
    var sDepartureDateUTC = new Date(aCities[i].departureTime * 1000);
    var sDepartureDate = sDepartureDateUTC.toDateString();
    var sHomeDateUTC = new Date(aCities[i].homeDate * 1000);
    var sHomeDate = sHomeDateUTC.toDateString();
    sFlightDiv += `
            <div id='flight'>
                <div id='flightRoute'>
                    <div class='row'>
                        <div>
                            <input type='checkbox'>
                        </div>
                        <div>
                            <img class='airlineIcon' src='icons/${aCities[i].companyShortcut}.png' alt=''>
                        </div>
                        <div>
                          ${sDepartureDate}
                            <p>${aCities[i].companyName}</p>
                        </div>
                        <div>
                            Direct
                        </div>
                        <div>
                            Total time
                            <p>${aCities[i].fromShortcut} - ${aCities[i].toShortcut}</p>
                        </div>
                    </div>
                    <div class='row'>
                        <div>
                            <input type='checkbox'>
                        </div>
                        <div>
                            <img class='airlineIcon' src='icons/${aCities[i].companyShortcut}.png' alt=''>
                        </div>
                        <div>
                        ${sHomeDate}
                            <p>${aCities[i].companyName}</p>
                        </div>
                        <div>
                            Direct
                        </div>
                        <div>
                        Total time
                            <p>${aCities[i].toShortcut} - ${aCities[i].fromShortcut}</p>
                        </div>
                    </div>
                </div>
                <div id='flightBuy'>
                    <div>
                        ${aCities[i].price} kr.
                    </div>
                    <button id='flight-${aCities[i].id}' onclick='checkFlightId(event)'>Buy</button>
                </div>
            </div>
        `;
  }
  document.getElementById("flights").innerHTML = sFlightDiv;
}

function renderCity(sCityName, oCityResults) {
  var sDivCityName = `<div onclick="selectCity(this)">${sCityName}</div`;
  oCityResults.innerHTML += sDivCityName;
}

function selectCity(objectDOM) {
  let sCityName = objectDOM.innerHTML;
  if (objectDOM.parentNode.id == "fromCityResults") {
    txtSearchFromCity.value = sCityName;
  }
  if (objectDOM.parentNode.id == "toCityResults") {
    txtSearchToCity.value = sCityName;
  }
}

function switchInput() {
  var fromCityValue = document.querySelector("#txtSearchFromCity").value;
  var toCityValue = document.querySelector("#txtSearchToCity").value;

  document.querySelector("#txtSearchFromCity").value = toCityValue;
  document.querySelector("#txtSearchToCity").value = fromCityValue;
}

async function updateFlight(a) {
  let oForm = document.querySelector("#frmFlightList");
  console.dir(a);

  let jConnection = await fetch(
    "http://localhost/momondo-v1/api/api-update-flight.php",
    {
      method: "POST",
      body: new FormData(oForm)
    }
  );
  let jResponse = await jConnection.text();
  // console.log(jResponse);
}

var flightObj;

async function checkFlightId(event) {
  var jResponse = await fetch("data/flights.json");
  var aFlights = await jResponse.json();
  for (i = 0; i < aFlights.length; i++) {
    if (`flight-${aFlights[i].id}` == event.target.id) {
      flightObj = aFlights[i];
      document.querySelector("#buyTicketModal").style.display = "block";
    }
  }
}
async function bookFlight(flight) {
  var url = `api/api-book-flight.php?id=${flight.id}`;

  var oForm = document.querySelector("#frmBuyTicket");
  var jConnection = await fetch(url, {
    method: "POST",
    body: new FormData(oForm)
  });
  var jResponse = await jConnection.text();
  console.log(jResponse);
}

function rangePrice() {
  document.querySelector("#range-price").textContent =
    document.querySelector("#price-slide").value + " kr.";
}
