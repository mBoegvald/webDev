async function buy() {
  let oForm = document.querySelector("#frmFlight");
  if (oForm.txtAirlineName.value.length > 100) {
    alert("Airline name is too long!");
  }
  let jConnection = await fetch("api-buy.php", {
    method: "POST",
    body: new FormData(oForm)
  });
  let jResponse = await jConnection.text();
  console.log(jResponse);
}
