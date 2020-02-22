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
  let url = `api/api-get-from-cities.php?cityName=${sSearchFor}`;
  var jResponse = await fetch(url);
  var aCities = await jResponse.json();

  if (sSearchFor.length == 0 || !aCities.cities.length) {
    oCityResults.style.display = "none";
    return;
  }
  for (i = 0; i < aCities.cities.length; i++) {
    renderCity(aCities.cities[i], oCityResults);
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

async function saveFlight() {
  let oForm = document.querySelector("#frmFlightList");

  let jConnection = await fetch(
    "http://localhost/momondo-v1/api/api-update-flight.php",
    {
      method: "POST",
      body: new FormData(oForm)
    }
  );
  let jResponse = await jConnection.text();
  console.log(jResponse);
}
