<!DOCTYPE html>
<html>
<head>
    <title>Org Chart using OrgChart.js</title>
    <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
    <script src="https://cdn.balkan.app/orgchart.js"></script>
    
    <style>
        #tree {
            width: 10%;
            height: 50px;
        }
    </style>
</head>
<body>
    <h2>Company Org Chart</h2>
    <div id="tree"></div>

    <script>
        fetch('fetch_employees.php')
            .then(res => res.json())
            .then(data => {
                new OrgChart(document.getElementById("tree"), {
                    nodes: data,
                    nodeBinding: {
                        field_0: "name",
                        field_1: "position"
                    }
                });
            });
    </script>
</body>
</html>
