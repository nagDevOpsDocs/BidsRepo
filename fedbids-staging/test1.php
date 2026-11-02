<!-- 
<html>
<head>
<style>
.div-table {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}

.div-table.header {
    background: #2c3e50;
    color: white;
    font-weight: bold;
}

.div-table.row:nth-child(even) {
    background: #f7f7f7;
}

.col {
    flex: 1;
}

.sortable {
    cursor: pointer;
}

.sortable:after {
    content: " ⇅";
    font-size: 12px;
}
</style>
</head>

<body>
<div class="container">

  <!-- Search box -->
  <!-- <input type="text" id="searchBox" class="form-control"
         placeholder="Search players..." style="margin-bottom:10px;"> -->

  <!-- Filters -->
  <!-- <select id="cityFilter" class="form-control" style="width:200px; margin-bottom:10px;">
    <option value="">All Cities</option>
    <option value="Hyderabad">Hyderabad</option>
    <option value="Bangalore">Bangalore</option>
    <option value="Chennai">Chennai</option>
  </select> -->

  <!-- Grid Header -->
  <!-- <div class="div-table header">
    <div class="col sortable" data-col="name">Name</div>
    <div class="col sortable" data-col="city">City</div>
    <div class="col sortable" data-col="rating">Rating</div>
  </div> -->

  <!-- Rows -->
  <!-- <div id="tableBody">
    <div class="div-table row" data-name="Pradeep" data-city="Hyderabad" data-rating="4.5">
      <div class="col">Pradeep</div>
      <div class="col">Hyderabad</div>
      <div class="col">4.5</div>
    </div>

    <div class="div-table row" data-name="Ravi" data-city="Bangalore" data-rating="3.2">
      <div class="col">Ravi</div>
      <div class="col">Bangalore</div>
      <div class="col">3.2</div>
    </div>

    <div class="div-table row" data-name="Suresh" data-city="Chennai" data-rating="5.0">
      <div class="col">Suresh</div>
      <div class="col">Chennai</div>
      <div class="col">5.0</div>
    </div>
  </div>

</div> 

<script>
/*
let sortDir = 1;

document.getElementById("searchBox").addEventListener("keyup", function() {
    let val = this.value.toLowerCase();
    document.querySelectorAll(".div-table.row").forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(val) ? "flex" : "none";
    });
});

document.getElementById("cityFilter").addEventListener("change", function() {
    let city = this.value;
    document.querySelectorAll(".div-table.row").forEach(row => {
        if (city === "" || row.dataset.city === city) {
            row.style.display = "flex";
        } else {
            row.style.display = "none";
        }
    });
});

document.querySelectorAll(".sortable").forEach(header => {
    header.addEventListener("click", function() {
        let col = this.dataset.col;
        let rows = Array.from(document.querySelectorAll(".div-table.row"));

        rows.sort((a,b) => {
            let x = a.dataset[col];
            let y = b.dataset[col];

            if (!isNaN(x)) return sortDir * (parseFloat(x) - parseFloat(y));
            return sortDir * x.localeCompare(y);
        });

        sortDir *= -1;

        let body = document.getElementById("tableBody");
        body.innerHTML = "";
        rows.forEach(r => body.appendChild(r));
    });
}); */
</script>

</body>
</html>  -->

<html>
<head>

<style>
.table {
  width: 400px;
  border: 1px solid #ccc;
}

.header, .row {
  display: flex;
}

.col {
  flex: 1;
  padding: 8px;
  border-bottom: 1px solid #eee;
}

.header .col {
  font-weight: bold;
  cursor: pointer;
  user-select: none;
}

.arrow {
  margin-left: 5px;
}

</style>

<div class="table">
  <div class="header">
    <div class="col sortable" data-col="0">Name <span class="arrow"></span></div>
    <div class="col sortable" data-col="1">Age <span class="arrow"></span></div>
    <div class="col sortable" data-col="2">City <span class="arrow"></span></div>
  </div>

  <div class="row">
    <div class="col">Alice</div>
    <div class="col">30</div>
    <div class="col">London</div>
  </div>
  <div class="row">
    <div class="col">Bob</div>
    <div class="col">25</div>
    <div class="col">Paris</div>
  </div>
  <div class="row">
    <div class="col">Charlie</div>
    <div class="col">35</div>
    <div class="col">Berlin</div>
  </div>
</div>

<script>
let sortState = {}; // track column sort direction

document.querySelectorAll(".sortable").forEach(header => {
  header.addEventListener("click", () => {
    const colIndex = header.dataset.col;
    const rows = Array.from(document.querySelectorAll(".row"));

    // toggle sort direction
    const direction = sortState[colIndex] === "asc" ? "desc" : "asc";
    sortState = { [colIndex]: direction };

    // clear all arrows
    document.querySelectorAll(".arrow").forEach(a => a.textContent = "");

    // set arrow for current column
    header.querySelector(".arrow").textContent =
      direction === "asc" ? "⬆️" : "⬇️";

    rows.sort((a, b) => {
      let valA = a.children[colIndex].textContent;
      let valB = b.children[colIndex].textContent;

      // numeric sort if possible
      if (!isNaN(valA) && !isNaN(valB)) {
        return direction === "asc" ? valA - valB : valB - valA;
      }

      // string sort
      return direction === "asc"
        ? valA.localeCompare(valB)
        : valB.localeCompare(valA);
    });

    const table = document.querySelector(".table");
    rows.forEach(row => table.appendChild(row));
  });
});
</script>

</body>
</html>
