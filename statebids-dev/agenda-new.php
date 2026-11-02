<?php
include("./includes/connect_portal123.php");

$query = mysqli_query($mysqli_link,"SELECT * FROM state_excel_test WHERE status_value=1");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<style>
.collapsible {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #ccc;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
</style>

<div>One</div><div>Two</div><div>Three</div><div>Four</div>
<?php
if(mysqli_num_rows($query)>0) {
	while($rec = mysqli_fetch_array($query)) {
?>
<button type="button" class="collapsible">
<?php echo $rec['released']; ?></span>
<span><?php echo $rec['rfp_date']; ?></span>
<span><?php echo $rec['contract_vehicle']; ?></span>
<span><?php echo $rec['contract_vehicle_two']; ?></span>
<span><?php echo $rec['manager']; ?></span>
<span><?php echo $rec['title']; ?></span></button>
<div class="content">
  <div>Title</div><div><?php echo $rec['title']; ?></div>
</div>
<?php } } ?>


<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
