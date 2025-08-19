<?php
include 'auth.php';
authorize('employee');

if (!isset($_SESSION['user_id'])) {
  echo json_encode(["error" => "User not authenticated"]);
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Org Chart</title>

<!-- Treant CSS -->
<link rel="stylesheet" href="./treant/Treant.css">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>
* { box-sizing: border-box; }

/* Chart wrapper - scrollable */
.tree-wrapper {
    width: 100%;
    height: calc(100vh - 100px);
    overflow: auto;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    background: #f8f9fa;
}

#tree {
    display: inline-block;
    padding: 20px;
    min-width: 100%;
    min-height: 100%;
    box-sizing: border-box;
}

/* Node style */
.node-style {
    width: 260px;
    border-radius: 15px;
    background-color: #0099e6;
    color: white;
    text-align: center;
    font-size: 16px;
    line-height: 60px;
    padding: 0;
    margin: 0;
    white-space: nowrap;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.node-style:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    cursor: pointer;
}
.node-style .node-name { font-size: 20px; display: block; }
.node-style .node-role { font-size: 11px; opacity: 0.9; display: block; }

/* Collapse button */
.Treant .collapse-switch {
    top: auto !important;
    bottom: -7px;
    left: 50%;
    transform: translateX(-50%);
    width: 20px;
    height: 20px;
    background-color: white;
    border-radius: 50%;
    color: #aeaeae;
    text-align: center;
    font-size: 30px;
    line-height: 19px;
    cursor: pointer;
    border: 1px ridge #aeaeae9c;
}
.Treant .node.collapsed .collapse-switch::after { content: "+"; }
.Treant .node .collapse-switch::after { content: "−"; }

/* Profile Panel */
.profile-panel {
    position: fixed;
    top: 50px;
    right: 30px;
    width: 400px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 20px;
    z-index: 9999;
    transform: translateY(50px);
    opacity: 0;
    display: none;
    transition: all 0.4s ease;
}
.profile-panel.show {
    transform: translateY(0);
    opacity: 1;
}
.profile-header {
    background: #03a9f4;
    color: #fff;
    padding: 10px;
    border-radius: 12px 12px 0 0;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.profile-details { font-size: 14px; color: #444; }
.profile-details p { margin: 10px 0; }

/* Responsive: Tablets */
@media (max-width: 992px) {
    .node-style { width: 180px; font-size: 14px; line-height: 40px; }
    .node-style .node-name { font-size: 16px; }
    .tree-wrapper { height: calc(100vh - 80px); overflow-x: scroll; overflow-y: scroll; }
    .profile-panel { width: 300px; right: 10px; top: 20px; }
}

/* Responsive: Phones */
@media (max-width: 576px) {
    .node-style { width: 140px; font-size: 12px; line-height: 35px; }
    .node-style .node-name { font-size: 14px; }
    .node-style .node-role { font-size: 10px; }
    .tree-wrapper { overflow-x: scroll; overflow-y: scroll; }
    .profile-panel { width: 90%; left: 5%; right: 5%; top: 10px; font-size: 13px; }
}
</style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include "sidebar.php"; ?>
        <!-- Main Content -->
        <main class="col-md-10">
            <div class="tree-wrapper">
                <div id="tree">
                    <div id="chart"></div>
                </div>
            </div>

            <!-- Info Panel -->
            <div id="info-panel" class="profile-panel">
                <div class="profile-header">
                    <span id="panel-name">Employee Name</span>
                    <span id="panel-title">Title</span>
                    <span onclick="hidePanel()" style="cursor:pointer;">✖</span>
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
<script src="https://cdn.jsdelivr.net/npm/@panzoom/panzoom/dist/panzoom.min.js"></script>

<script>
// Helper to find node by id
function findNodeById(node, id) {
    if (node.HTMLid === id) return node;
    if (!node.children) return null;
    for (let child of node.children) {
        const found = findNodeById(child, id);
        if (found) return found;
    }
    return null;
}

// Show panel with order/payment details
function showPanel(name, title, data) {
    const panel = document.getElementById("info-panel");
    panel.style.display = "block";
    setTimeout(() => panel.classList.add("show"), 50);

    document.getElementById("panel-title").innerText = title;
    document.getElementById("panel-name").innerText = name;

    let content = "";
    if (data.order_id) content += `<p><strong>Order ID:</strong> ${data.order_id}</p>`;
    if (data.payment_status) content += `<p><strong>Payment Status:</strong> ${data.payment_status}</p>`;
    if (data.payment_type) content += `<p><strong>Payment Type:</strong> ${data.payment_type}</p>`;
    if (data.payment_date) content += `<p><strong>Last Payment Date:</strong> ${data.payment_date}</p>`;
    if (data.scheme) content += `<p><strong>Scheme:</strong> ${data.scheme}</p>`;

    document.getElementById("panel-content").innerHTML = content || "<p>No details available.</p>";
}

// Hide info panel
function hidePanel() {
    const panel = document.getElementById("info-panel");
    panel.classList.remove("show");
    setTimeout(() => panel.style.display = "none", 300);
}

// Fetch org chart data
fetch('google_data.php?reporting_id=<?= $_SESSION['user_id'] ?>')
.then(res => res.json())
.then(data => {
    const chart_config = {
        chart: {
            container: "#chart",
            rootOrientation: "WEST",
            levelSeparation: 50,
            siblingSeparation: 30,
            subTeeSeparation: 30,
            scrollbar: "fancy",
            node: { collapsable: true, verticalSpacing: 10, horizontalSpacing: 10 },
            animation: { nodeAnimation: "easeOutBounce", nodeSpeed: 700, connectorsAnimation: "bounce", connectorsSpeed: 700 },
            connectors: { type: 'curve', style: { 'stroke': '#686868', 'stroke-width': 1 } }
        },
        node: { HTMLclass: 'node-style' },
        nodeStructure: data
    };

    new Treant(chart_config);

    // Node click listener
    setTimeout(() => {
        document.querySelectorAll('.node-style').forEach(el => {
            el.addEventListener('click', function () {
                const clickedId = this.id;
                const dataNode = findNodeById(chart_config.nodeStructure, clickedId);
                if (dataNode && dataNode.data) {
                    showPanel(dataNode.text.name, dataNode.text.title, dataNode.data);
                }
            });
        });
    }, 300);

    // Pan & Zoom only for desktop
    if (window.innerWidth > 992) {
        const treeElement = document.getElementById('tree');
        const panzoom = Panzoom(treeElement, { maxScale: 2, minScale: 0.5 });
        treeElement.parentElement.addEventListener('wheel', panzoom.zoomWithWheel);
    }
})
.catch(err => console.error("Error loading org chart:", err));
</script>

</body>
</html>
