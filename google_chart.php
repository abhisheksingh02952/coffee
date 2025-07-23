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

<script>
   const chart_config = {
          chart: {
            container: "#chart-container",
            node: {
              collapsable: true,
              verticalSpacing: 10, // reduce vertical gap between nodes
              horizontalSpacing: 10 // reduce horizontal gap
            },
            animation: {
              nodeAnimation: "easeOutBounce",
              nodeSpeed: 700,
              connectorsAnimation: "bounce",
              connectorsSpeed: 700
            },
            connectors: {
              type: 'curve', // or 'step', 'straight'
              style: {
                'stroke': '#686868', // Line color (blue)
                'stroke-width': 1 // Line thickness
              }
            }
          },

          node: {
            HTMLclass: 'node-style'
          },

          nodeStructure: {
            text: {
              name: "CEO"
            },
            HTMLid: "node_2",
            HTMLclass: "node-style",
            data: {
              id: 1,
              email: "john@example.com",
              phone: "1111111111"
            },
            children: [{
                text: {
                  name: "CTO"
                },
                HTMLclass: "node-style",
                data: {
                  id: 2,
                  email: "jane@example.com",
                  phone: "9876543210"
                },
                children: [{
                  text: {
                    name: "Dev Team Lead"
                  },
                  HTMLclass: "node-style",
                  stackChildren: true,
                  data: {
                    id: 2,
                    email: "jane@example.com",
                    phone: "9876543210"
                  },
                  children: [{
                      text: {
                        name: "Developer 1"
                      },
                      HTMLclass: "node-style",
                      data: {
                        id: 2,
                        email: "jane@example.com",
                        phone: "9876543210"
                      },
                    },
                    {
                      text: {
                        name: "Developer 2"
                      },
                      HTMLclass: "node-style",
                      data: {
                        id: 2,
                        email: "jane@example.com",
                        phone: "9876543210"
                      },
                    }
                  ]
                }]
              },
              {
                text: {
                  name: "CFO"
                },
                HTMLclass: "node-style",
                children: [{
                  text: {
                    name: "Accountant"
                  },
                  HTMLclass: "node-style"
                }]
              }
            ]
          }
        };

        new Treant(chart_config);

        // Add click listener after tree is rendered
setTimeout(() => {
    document.querySelectorAll('.node-style').forEach(el => {
        el.addEventListener('click', function () {
            const clickedId = this.id; // this.id will now work!
            console.log("Clicked node ID:", clickedId);
            const dataNode = findNodeById(chart_config.nodeStructure, clickedId);
            if (dataNode && dataNode.data) {
                showPanel(dataNode.text.name, dataNode.data);
            }
        });
    });
}, 300);

</script>

</body>
</html>