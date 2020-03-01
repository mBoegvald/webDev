<section id="search">
      <div id="boxFromCity">
        <input id="txtFromCity" oninput="getFromCities()" type="text" placeholder="from city"/>
        <div id="fromCityResults">
        </div>
      </div>
      <button onclick="switchCities()">&lt;- -&gt;</button>
      <div id="boxToCity">
          <input id="txtToCity" oninput="getToCities()" type="text" placeholder="to city" />
          <div id="toCityResults">
          </div>
      </div>
      <input type="text" placeholder="from date" />
      <input type="text" placeholder="to date" />
      <button id="btnSearch" onclick="getFlights()">Search</button>
    </section>