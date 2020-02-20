async function getFromCities() {
  oFromCityResults = document.querySelector("#fromCityResults");
  oFromCityResults.innerHTML = "";
  let sSearchFor = txtSearchFromCity.value;
  let url = `api/api-get-from-cities.php?cityName=${sSearchFor}`;

  var jResponse = await fetch(url);
  var aCities = await jResponse.json();

  if (sSearchFor.length == 0 || !aCities.cities.length) {
    oFromCityResults.style.display = "none";
    return;
  }
  for (i = 0; i < aCities.cities.length; i++) {
    renderFromCity(aCities.cities[i]);
  }
  oFromCityResults.style.display = "grid";
}
function renderFromCity(sCityName) {
  oFromCityResults = document.querySelector("#fromCityResults");
  var sDivCityName = `<div onclick="selectCity(this)">${sCityName}</div`;
  oFromCityResults.innerHTML += sDivCityName;
}
function selectCity(objectDOM) {
  let sCityName = objectDOM.innerHTML;
  txtSearchFromCity.value = sCityName;
}
