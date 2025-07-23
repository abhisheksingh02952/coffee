 const chart_config = {
        chart: {
            container: "#chart-container",
            node: {
                collapsable: true,
                verticalSpacing: 10,     // reduce vertical gap between nodes
                horizontalSpacing: 10    // reduce horizontal gap
            },
            animation: {
                nodeAnimation: "easeOutBounce",
                nodeSpeed: 700,
                connectorsAnimation: "bounce",
                connectorsSpeed: 700
            },
            connectors: {
                 type: 'curve',         // or 'step', 'straight'
      style: {
        'stroke': '#686868', // Line color (blue)
        'stroke-width': 1    // Line thickness
      }
            }
        },

         node: {
    HTMLclass: 'node-style'
  },

        nodeStructure: {
            text: { name: "CEO" },
            HTMLid: "node_2",  
            HTMLclass: "node-style",
                  data: {
            id: 1,
            email: "john@example.com",
            phone: "1111111111"
          },
            children: [
                {
                    text: { name: "CTO" },
                    HTMLclass: "node-style",
                    data: {
          id: 2,
          email: "jane@example.com",
          phone: "9876543210"
        },
                    children: [
                        {
                            text: { name: "Dev Team Lead" },
                            HTMLclass: "node-style",
                            stackChildren: true,
                            data: {
          id: 2,
          email: "jane@example.com",
          phone: "9876543210"
        },
                            children: [
                                {
                                    text: { name: "Developer 1" },
                                    HTMLclass: "node-style",
                                    data: {
          id: 2,
          email: "jane@example.com",
          phone: "9876543210"
        },
                                },
                                {
                                    text: { name: "Developer 2" },
                                    HTMLclass: "node-style",
                                    data: {
          id: 2,
          email: "jane@example.com",
          phone: "9876543210"
        },
                                }
                            ]
                        }
                    ]
                },
                {
                    text: { name: "CFO" },
                    HTMLclass: "node-style",
                    children: [
                        {
                            text: { name: "Accountant" },
                            HTMLclass: "node-style"
                        }
                    ]
                }
            ]
        }
    };

    new Treant(chart_config);
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

// Show panel with node info
function showPanel(name, data) {
  const panel = document.getElementById("info-panel");
  panel.style.display = "block";
  document.getElementById("panel-title").innerText = name;
  document.getElementById("panel-content").innerHTML = `
    <p><strong>Phone:</strong> ${data.phone}</p>
    <p><strong>Email:</strong> ${data.email}</p>
  `;
}

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
