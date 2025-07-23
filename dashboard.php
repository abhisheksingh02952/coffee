<?php
include 'auth.php';
authorize('employee');
if (!isset($_SESSION['user_id'])) {
  echo json_encode(["error" => "User not authenticated"]);
  exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Org Chart</title>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="./treant/Treant.css">
  <link rel="stylesheet" href="css/chart.css">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <style>
    * {
      box-sizing: border-box
    }

    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    }

    input[type=text]:focus,
    input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }

    #tree {
      width: 100%;
      height: 900px;
      padding: 20px;
      box-sizing: border-box;
      background-color: #f8f9fa;
    }

    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }

    #sidebar {
      min-height: 100vh;
    }

    .nav-link.active,
    .nav-link:hover {
      background-color: #495057;
      color: #ffc107 !important;
    }

    .tree-wrapper {
      width: 100%;
      height: 100%;
      overflow: auto;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #tree {
      transform: scale(1);
      /* Adjust scale as needed */
      transform-origin: top center;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <?php
      include "sidebar.php";
      ?>
      <!-- Main Content -->
      <main class="col-md-10">

        <div class="tree-wrapper">
          <div id="tree"></div>
        </div>


        <div id="info-panel" style="display:none;" class="profile-panel">
          <div class="profile-header">
            <span id="panel-title">Employee Name</span>
            <span onclick="document.getElementById('info-panel').style.display='none'" style="cursor:pointer;">✖</span>
          </div>

          <div class="profile-details">
            <div id="panel-content">Click on a node to see details here.</div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="./treant/vendor/raphael.js"></script>
  <script src="./treant/Treant.js"></script>
  <script src="javascript/chart.js"></script>


  <script>
    fetch('google_data.php?reporting_id=<?= $_SESSION['user_id'] ?>')
      .then(res => res.json())
      .then(data => {
        /* new OrgChart(document.getElementById("tree"), {
           nodes: data,
           editForm: {
             buttons: false,
           },
           collapse: { level: 2, allChildren: true },
           showXScroll: true,
           showYScroll: true,
           template: 'polina',
           nodeBinding: {
             field_0: "name",
             field_1: "position",
           },
           toolbar: {
             layout: true,
             zoom: true,
             fit: true,
             expandAll: false,
             fullScreen: true
           }
         });*/

        const chart_config = {
          chart: {
            container: "#tree",
            rootOrientation: "NORTH", // or WEST, SOUTH, EAST
            levelSeparation: 50,
            siblingSeparation: 30,
            subTeeSeparation: 30,
            scrollbar: "fancy",
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
            el.addEventListener('click', function() {
              const clickedId = this.id; // this.id will now work!
              console.log("Clicked node ID:", clickedId);
              const dataNode = findNodeById(chart_config.nodeStructure, clickedId);
              if (dataNode && dataNode.data) {
                showPanel(dataNode.text.name, dataNode.data);
              }
            });
          });
        }, 300);
      })
      .catch(error => console.error("Error loading org chart:", error));
  </script>
</body>

</html>