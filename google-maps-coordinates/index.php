<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Google Maps Polygon Coordinates Tool</title>
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <style>
    <?php
      include './css/style.css'
    ?>
  </style>
</head>


<body onload="initialize()">
  <div id="map-canvas"></div>
  <button id="clipboard-btn" onclick="copyToClipboard(document.getElementById('info').innerHTML)">Copy to Clipboard</button>
  <textarea id="info"></textarea>
  <!-- <script src="js/index.js"></script> -->

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCx7UqFSWYeSjVzcXbgBKB5nnarnHZWoM&callback=initMap" async defer></script>
  <script>
    <?php
      include './js/index.js'
    ?>
  </script>
</body>

</html>