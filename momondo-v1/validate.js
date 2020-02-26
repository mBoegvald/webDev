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
      case "string":
        var sData = aElements[i].value;
        var iMin = aElements[i].getAttribute("data-min");
        var iMax = aElements[i].getAttribute("data-max");

        if (sData.length < iMin || sData.length > iMax) {
          aElements[i].classList.add("invalid");
        }

        break;
      case "integer":
        var sData = aElements[i].value;
        if (/^\d+$/.test(sData) === false) {
          aElements[i].classList.add("invalid");
          break;
        }

        var iMin = parseInt(aElements[i].getAttribute("data-min"));
        // console.log(iMin);

        var iMax = parseInt(aElements[i].getAttribute("data-max"));
        // console.log(iMax);

        if (sData < iMin || sData > iMax) {
          aElements[i].classList.add("invalid");
        }
        break;
      case "email":
        var sData = aElements[i].value;
        var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!reg.test(sData)) {
          aElements[i].classList.add("invalid");
        }
        break;
    }
  }

  return oForm.querySelectorAll(".invalid").length ? false : true;
}
