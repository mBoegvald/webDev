async function getFromCities(){
    oFromCityResults = document.querySelector('#fromCityResults');
    oFromCityResults.innerHTML = '';

    let fromCityInput = document.querySelector('#fromCityInput');
    fromCityInput = fromCityInput.value;

    if(fromCityInput.length == 0){
        console.log('Input is empty');
        oFromCityResults.style.display = 'none';
        return; 
    }

    let jResponse = await fetch('apis/api-get-from-cities.php');
    let aCities = await jResponse.json();

    for(let i = 0; i < aCities.length; i++){
        // check from city has input value and set both to lowercase
        if((aCities[i].from.toLowerCase().indexOf(fromCityInput.toLowerCase())) == 0){
           displayFromCity(aCities[i].from);
           console.log('Har bogstav i navn', aCities[i].from);
           return;
        }
    }
    oFromCityResults.style.display = 'grid';
}
function displayFromCity(sCityFrom){
    console.log('City: ', sCityFrom);
    oFromCityResults.style.display = 'grid';
    oFromCityResults = document.querySelector('#fromCityResults');
    let sDivCityFrom = `<div class="resultItem" onclick="selectFromCity(this)">${sCityFrom}</div>`;
    oFromCityResults.innerHTML += sDivCityFrom;
}

async function getToCities(){
    oToCityResults = document.querySelector('#ToCityResults');
    oToCityResults.innerHTML = '';

    let toCityInput = document.querySelector('#toCityInput');
    toCityInput = toCityInput.value;

    if(toCityInput.length == 0){
        oToCityResults.style.display = 'none';
        return;
    }

    let jResponse = await fetch('apis/api-get-from-cities.php');
    let aCities = await jResponse.json();

    for(let i = 0; i < aCities.length; i++){
        // check to city has input value and set both to lowercase
        if((aCities[i].to.toLowerCase().indexOf(toCityInput.toLowerCase())) == 0){
           displayToCity(aCities[i].to);
           console.log('Har bogstav i navn', aCities[i].to);
           return;
        }
    }
    oToCityResults.style.display = 'grid';
}
function displayToCity(sCityTo){
    oToCityResults.style.display = 'grid';
    oToCityResults = document.querySelector('#ToCityResults');
    let sDivCityTo = `<div class="resultItem" onclick="selectToCity(this)">${sCityTo}</div>`;
    oToCityResults.innerHTML += sDivCityTo;
}

function selectFromCity(objectDOM) {
    let fromCityInput = document.querySelector('#fromCityInput');
    oFromCityResults = document.querySelector('#fromCityResults');
    let sCityFrom = objectDOM.innerHTML;
    fromCityInput.value = sCityFrom;
    oFromCityResults.style.display = "none";
    fromCityInput.focus();
    console.log("City: ",sCityFrom);
}
function selectToCity(objectDOM) {
    let toCityInput = document.querySelector('#toCityInput');
    oToCityResults = document.querySelector('#ToCityResults');
    let sCityTo = objectDOM.innerHTML;
    toCityInput.value = sCityTo;
    oToCityResults.style.display = "none";
    toCityInput.focus();
    console.log("City: ",sCityTo);
}

async function displaySearchedFlights(){
    let fromCityInput = document.querySelector('#fromCityInput');
    let toCityInput = document.querySelector('#toCityInput');
    console.log('From input: ',fromCityInput.value, 'To input: ', toCityInput.value);

    let jResponse = await fetch('apis/api-get-from-cities.php');
    let aCities = await jResponse.json();

    let flightDiv = document.querySelector('#flights');

    for(let i = 0; i < aCities.length; i++){
        if(aCities[i].from == fromCityInput.value.trim() && aCities[i].to == toCityInput.value.trim()){
            console.log('Match found');
            //Reset div
            flightDiv.innerHTML = '';
            // Convert to json instead of [OBJECT OBJECT]
            let oFlight = JSON.stringify(aCities[i]);


            // Calculate the departure and arrival time
            let dateDeparture = new Date(0); // The 0 is the key, which sets the date to the epoch
            let dateArrival = new Date(0); 
            dateDeparture.setUTCSeconds(aCities[i].departureTime);
            dateArrival.setUTCSeconds(aCities[i].arrivalTime);
            let sflightDeparture = dateDeparture.toLocaleTimeString('da-DK', {hour: '2-digit', minute: '2-digit'});
            let sflightArrival = dateArrival.toLocaleTimeString('da-DK', {hour: '2-digit', minute: '2-digit'});

                flightDiv.innerHTML += `
                    <div id='flight'>
                    <div id='flight-route'>
                        <div class='row'>
                        <div class='checkbox-container'>
                            <input type='checkbox'>
                        </div>
                        <div>
                            <img class='airline-icon' src='icons/${aCities[i].companyShortcut}.png'>
                        </div>
                        <div>
                            <b>${sflightDeparture}</b>
                            <p>${aCities[i].flightId}</p>              
                        </div>
                        <div>
                        <p><b>${aCities[i].from}</b></p>
                        Route
                        </div>
                        <div>
                            <b>${convertTotalTime(aCities[i].totalTime)}</b>
                            <p>${aCities[i].companyName}</p>
                        </div>
                        </div>
                        <div class='row'>
                        <div class='checkbox-container'>
                            <input type='checkbox'>
                        </div>
                        <div>
                            <img class='airline-icon' 
                            src='icons/${aCities[i].companyShortcut}.png'>
                        </div>
                        <div>
                        <b>${sflightArrival}</b>
                        <p>${aCities[i].flightId}</p>           
                        </div>
                        <div>
                        <p><b>${aCities[i].to}</b></p>
                            Route
                        </div>
                        <div>
                            <b>${convertTotalTime(aCities[i].totalTime)}</b>
                            <p>${aCities[i].companyName}</p>
                        </div>
                        </div>            
                    </div>
                    <div id='flight-buy'>
                        <div>
                        ${aCities[i].price} ${aCities[i].currency}
                        </div>
                        <button onclick='openModal(${oFlight})'>Buy ticket</button>
                    </div>
                    </div>
               `;
        }
    }
    if(fromCityInput.value.trim() == '' && toCityInput.value.trim() == ''){
        flightDiv.innerHTML = '';
        console.log('empty');
        for(let i = 0; i < aCities.length; i++){
            console.log(aCities[i]);
            // Calculate the departure and arrival time
            let dateDeparture = new Date(0); // The 0 is the key, which sets the date to the epoch
            let dateArrival = new Date(0); 
            dateDeparture.setUTCSeconds(aCities[i].departureTime);
            dateArrival.setUTCSeconds(aCities[i].arrivalTime);
            let sflightDeparture = dateDeparture.toLocaleTimeString('da-DK', {hour: '2-digit', minute: '2-digit'});
            let sflightArrival = dateArrival.toLocaleTimeString('da-DK', {hour: '2-digit', minute: '2-digit'});

            // Convert to json instead of [OBJECT OBJECT]
            let oFlight = JSON.stringify(aCities[i]);
       
            flightDiv.innerHTML += `
                <div id='flight'>
                    <div id='flight-route'>
                        <div class='row'>
                        <div class='checkbox-container'>
                        <input type='checkbox'>
                        </div>
                        <div>
                            <img class='airline-icon' src='icons/${aCities[i].companyShortcut}.png'>
                        </div>
                        <div>
                            <b>${sflightDeparture}</b>
                            <p>${aCities[i].flightId}</p>              
                        </div>
                        <div>
                        <p><b>${aCities[i].from}</b></p>
                        Route
                        </div>
                        <div>
                            <b>${convertTotalTime(aCities[i].totalTime)}</b>
                            <p>${aCities[i].companyName}</p>
                        </div>
                        </div>
                        <div class='row'>
                        <div class='checkbox-container'>
                            <input type='checkbox'>
                        </div>
                        <div>
                            <img class='airline-icon' 
                            src='icons/${aCities[i].companyShortcut}.png'>
                        </div>
                        <div>
                        <b>${sflightArrival}</b>
                        <p>${aCities[i].flightId}</p>           
                        </div>
                        <div>
                        <p><b>${aCities[i].to}</b></p>
                            Route
                        </div>
                        <div>
                            <b>${convertTotalTime(aCities[i].totalTime)}</b>
                            <p>${aCities[i].companyName}</p>
                        </div>
                        </div>            
                           </div>
                           <div id='flight-buy'>
                        <div>
                            ${aCities[i].price} ${aCities[i].currency}
                        </div>
                        <button onclick='openModal(${oFlight})'>Buy ticket</button>
                    </div>
                </div>
            `;
        }
    }
    //Reset fields
    document.querySelector('#fromCityResults').style.display = 'none';
    document.querySelector('#ToCityResults').style.display = 'none';
    document.querySelector('#fromCityInput').value = '';
    document.querySelector('#toCityInput').value = '';
}

function convertTotalTime(time){
    let hours = Math.trunc(time/60);
    let minutes = time % 60;
    return hours +"h. "+ minutes+"min.";
}

function openModal(oFlight){
    let modalDiv = document.querySelector('#modal');
    let overlayDiv = document.querySelector('#modal-overlay');
    modalDiv.style.display = 'grid';
    overlayDiv.style.display = 'grid';
    console.log(oFlight);

    flightModalDiv = document.querySelector('#modal');
    flightModalDiv.innerHTML += `
        <div id="modal-close-btn" onclick="closeModal()">x</div>
        <h3>Flight Details</h3>
        <div id="flight-info">
        <div class='modal-row'>
            <div>
                <img class='airline-icon' src='icons/${oFlight.companyShortcut}.png'>
            </div>
            <div>
                <b>19.45</b>
                <p>${oFlight.flightId}</p>              
            </div>
            <div>
            <p><b>${oFlight.from}</b></p>
            Route
            </div>
            <div>
                <b>2h. 30min.</b>
                <p>${oFlight.companyName}</p>
            </div>
        </div>
        <div class='modal-row'>
            <div>
                <img class='airline-icon' src='icons/${oFlight.companyShortcut}.png'>
            </div>
            <div>
                <b>19.45</b>
                <p>${oFlight.flightId}</p>              
            </div>
            <div>
            <p><b>${oFlight.to}</b></p>
            Route
            </div>
            <div>
                <b>2h. 30min.</b>
                <p>${oFlight.companyName}</p>
            </div>
        </div>
        <div id='flight-buy'>
            <h3>Book your flight</h3>
            <form class="bookingForm" onsubmit='return validate()' action="booking-login.php">
            <div id="user-name-container">
            <label for="user-name">Enter name
            <input oninput='validate()' name="user-name" type="text" placeholder="Name" data-validate="string" data-min="2" data-max="5">
            </label>
            <label for="user-lastName">Enter last name
            <input oninput='validate()' name="user-lastName" type="text" placeholder="Last name" data-validate="string" data-min="2" data-max="5">
            </label>
            </div>
            <label for="user-email">Enter email</label>
            <input oninput='validate()' name="user-email" type="text" placeholder="Email" data-validate="email">
            <button id="bookSubmit" onclick='buyTicket(${JSON.stringify(oFlight)})'>Buy ticket</button>
            </form>
        </div>
        </div>
    `;
}
function closeModal(){
    let modalDiv = document.querySelector('#modal');
    let overlayDiv = document.querySelector('#modal-overlay');
    modalDiv.style.display = 'none';
    overlayDiv.style.display = 'none';
    flightModalDiv = document.querySelector('#modal');
    flightModalDiv.innerHTML = '';
}

async function buyTicket(oFlight){
    let oForm = document.querySelector('.bookingForm');
    let aElements = oForm.querySelectorAll("[data-validate]");
    for(let i = 0; i < aElements.length; i++){
        if(aElements[i].value == ""){
            console.warn("NOT WORKING");
            aElements[i].classList.add("invalid");
        }
    }
    console.log("Buy Ticket", oFlight.id);
    if(oForm.querySelectorAll('.invalid').length == 0){
        console.error("WORKING");
        let jResponse = await fetch(`http://127.0.0.1/momondo-v11/apis/api-book-flight.php?flightId=${oFlight.id}`, {
        "method": "POST",
        "body": new FormData(oForm)
        });
        let sData = await jResponse.text();
        console.log(sData);
    }
}

function validate(){
    let oForm = event.target.localName == "input" ? event.target.parentElement : event.target;
    
    let aElements = oForm.querySelectorAll("[data-validate]");
    for(let i = 0; i < aElements.length; i++){
        aElements[i].classList.remove('invalid');
        console.log('Elements: ', aElements[i]);
        let sValidateType = aElements[i].getAttribute('data-validate');
        console.log('Data-validate: ', sValidateType);
        
        switch(sValidateType){
            case 'string':
                var sData = aElements[i].value;
                console.log(sData.length);
                var iMin = aElements[i].getAttribute('data-min');
                console.log(iMin);
                var iMax = aElements[i].getAttribute('data-max');
                console.log('Validate string');
                if(sData.length < iMin || sData.length > iMax){
                    aElements[i].classList.add("invalid");
                    console.log('test');
                }
            break;
            case 'email':
                console.log('Validate email');
                var regEmail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
                if(!regEmail.test(aElements[i].value) || aElements[i].value === ""){
                    console.log('It is not an email');
                    aElements[i].classList.add("invalid");
                    break;
                }
            break;
        }
    }
        return (oForm.querySelectorAll('.invalid').length) ? false : true; // Check how many errors that are in the form return false if there are errors
    
    }