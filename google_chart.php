<!DOCTYPE html>
<html>
  <head>
    <title>Org Chart with Google Charts</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'ID');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        data.addRows([
            <?php include("google_data.php"); ?>
        ]);

        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        chart.draw(data, {'allowHtml':true});
      }
    </script>
  </head>
  <body>
    <h2>Org Chart using Google Charts</h2>
    <div id="chart_div"></div>
  </body>
</html>
