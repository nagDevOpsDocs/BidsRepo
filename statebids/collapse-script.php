<?php
print("
<script>
var coll7 = document.getElementsByClassName('collapsible7');
var i;

for (i = 0; i < coll7.length; i++) {
  coll7[i].addEventListener('click', function() {
    this.classList.toggle('active7');
    var content7 = this.nextElementSibling;
    if (content7.style.display === 'block') {
      content7.style.display = 'none';
    } else {
      content7.style.display = 'block';
    }
  });
}
</script>
");
?>