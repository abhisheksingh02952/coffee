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

