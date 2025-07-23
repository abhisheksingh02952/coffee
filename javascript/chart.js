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
    <p><strong>order_id:</strong> ${data.order_id}</p>
    <p><strong>payment_status:</strong> ${data.payment_status}</p>
    <p><strong>payment_type:</strong> ${data.payment_type}</p>
    <p><strong>date:</strong> ${data.date}</p>
    <p><strong>scheme:</strong> ${data.scheme}</p>
  `;
}

