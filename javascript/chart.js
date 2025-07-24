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
function showPanel(name, title, data) {
    const panel = document.getElementById("info-panel");
    panel.style.display = "block";
    document.getElementById("panel-title").innerText = title;
    document.getElementById("panel-name").innerText = name;


    let content = "";

    if (data.order_id) {
        content += `<p><strong>Order ID:</strong> ${data.order_id}</p>`;
    }
    if (data.payment_status) {
        content += `<p><strong>Payment Status:</strong> ${data.payment_status}</p>`;
    }
    if (data.payment_type) {
        content += `<p><strong>Payment Type:</strong> ${data.payment_type}</p>`;
    }
    if (data.payment_date) {
        content += `<p><strong>Payment Date:</strong> ${data.payment_date}</p>`;
    }
    if (data.scheme) {
        content += `<p><strong>Scheme:</strong> ${data.scheme}</p>`;
    }

    document.getElementById("panel-content").innerHTML = content || "<p>No details available.</p>";
}

