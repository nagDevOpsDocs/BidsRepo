<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
  .collapsible-content-history {
    display: none;
  }
  .active-history {
    display: block;
  }
</style>
</head>

<body>


<div onclick="toggleContent(this)">
  <h3>Click to toggle content</h3>
  <div class="collapsible-content-history">
    <p>Hidden content</p>
  </div>
</div>

<script>
  function toggleContent(element) {
    var content = element.querySelector('.collapsible-content-history');
    content.classList.toggle('active-history');
  }
</script>
</body>
</html>