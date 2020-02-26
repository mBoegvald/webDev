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

  if (sSearchFor.length == 0 || !aCities[fromOrTo].length) {
    oCityResults.style.display = "none";
    return;
  }

  for (i = 0; i < aCities[fromOrTo].length; i++) {
    renderCity(aCities[fromOrTo][i], oCityResults);
  }
  oCityResults.style.display = "grid";
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
