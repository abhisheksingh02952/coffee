<!DOCTYPE html>
<html>
<head>
    <title>Treant Collapsible OrgChart</title>
    <link rel="stylesheet" href="./treant/Treant.css">
    <link rel="stylesheet" href="css/chart.css">
</head>
<body>

<div id="chart-container" style="width:100%; height:auto;"></div>


<div id="info-panel" style="display:none;" class="profile-panel">
  <div class="profile-header">
    <span id="panel-title">Employee Name</span>
    <span onclick="document.getElementById('info-panel').style.display='none'" style="cursor:pointer;">✖</span>
  </div>
  
  <div class="profile-details">
    <div id="panel-content">Click on a node to see details here.</div>
  </div>
</div>


<script src="./treant/vendor/raphael.js"></script>
<script src="./treant/Treant.js"></script>
<script src="javascript/chart.js"></script>

</body>
</html>