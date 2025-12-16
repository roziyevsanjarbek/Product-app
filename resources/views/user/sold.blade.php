<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sotilgan Mahsulotlar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1f2937;
            --secondary: #111827;
            --accent: #3b82f6;
            --accent-light: #60a5fa;
            --border: #374151;
            --text-primary: #f3f4f6;
            --text-secondary: #d1d5db;
            --success: #10b981;
            --danger: #ef4444;
            --bg: #0f172a;
            --card: #1e293b;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background-color: var(--bg);
            color: var(--text-primary);
            line-height: 1.6;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--primary);
            border-right: 1px solid var(--border);
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 20px;
            text-align: center;
        }

        .sidebar-header h2 {
            font-size: 18px;
            color: var(--accent);
        }

        .nav-item {
            padding: 15px 20px;
            cursor: pointer;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-item:hover {
            background-color: var(--secondary);
            border-left-color: var(--accent);
        }

        .nav-item.active {
            background-color: var(--secondary);
            border-left-color: var(--accent);
            color: var(--accent);
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 30px;
        }

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: var(--accent);
        }

        /* Dashboard Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 20px;
            transition: all 0.3s;
        }

        .stat-card:hover {
            border-color: var(--accent);
            transform: translateY(-2px);
        }

        .stat-card h3 {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: var(--accent);
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-secondary);
        }

        /* Forms */
        .form-container {
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background-color: var(--primary);
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.3s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-primary {
            background-color: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--accent-light);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-danger:hover {
            opacity: 0.8;
        }

        /* Tables */
        .table-container {
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: var(--primary);
            border-bottom: 1px solid var(--border);
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        tr:hover {
            background-color: var(--primary);
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-admin {
            background-color: rgba(59, 130, 246, 0.2);
            color: var(--accent);
        }

        .badge-user {
            background-color: rgba(16, 185, 129, 0.2);
            color: var(--success);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-secondary);
        }

        .empty-state p {
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .sidebar-header h2 {
                font-size: 12px;
            }

            .nav-item {
                padding: 15px 10px;
                justify-content: center;
            }

            .main-content {
                margin-left: 60px;
                padding: 15px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
     <x-user.navbar></x-user.navbar>
<div class="container">
    <!-- Sidebar -->
    <x-user.sidebar></x-user.sidebar>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Sotilgan Mahsulotlar</h1>
        <div class="form-container">
            <form id="soldForm">
                <div class="form-row">
                    <div class="form-group">
                        <label>Mahsulot Tanlang</label>
                        <select id="soldProduct" required>
                            <option value="">Mahsulot tanlang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sotilgan Sonı</label>
                        <input type="text" id="soldQty" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Sotilgan Narxi (so'm)</label>
                        <input type="number" id="soldPrice" placeholder="0" min="1" required>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Sotilgan Mahsulot Qoʻshish</button>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>Mahsulot Nomi</th>
                    <th>Sotilgan Sonı</th>
                    <th>Birlik Narxi (so'm)</th>
                    <th>Jami (so'm)</th>
                    <th>Sotgan User</th>
                    <th>Sana</th>
                    <th>Amal</th>
                </tr>
                </thead>
                <tbody id="soldTableBody">
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px;">Sotilgan mahsulot qoʻshilmagan</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    const API_BASE = "/api";

    document.addEventListener("DOMContentLoaded", function () {
    loadProducts();
});


    // Mahsulotlarni yuklash
    async function loadProducts() {
        try {
            const res = await fetch(`${API_BASE}/product`, { // API route tekshirilishi kerak
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const contentType = res.headers.get("content-type");
            if (!contentType.includes("application/json")) {
                const html = await res.text();
                console.error("Server HTML qaytardi:", html);
                return;
            }

            const data = await res.json();

            if (!res.ok) {
                console.error(data.message);
                return;
            }

            const select = document.getElementById("soldProduct");
            data.data.forEach(product => {
                const option = document.createElement("option");
                option.value = product.id;
                option.textContent = product.name;
                select.appendChild(option);
            });

        } catch (err) {
            console.error("Mahsulotlarni yuklab bo'lmadi:", err);
        }
    }

    // Form submit
    // Form submit
document.getElementById("soldForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const product_id = document.getElementById("soldProduct").value;
    const sold_qty = document.getElementById("soldQty").value;

    const bodyData = {
        product_id,
        quantity: sold_qty,
    };

    try {
        const res = await fetch(`${API_BASE}/sales`, {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify(bodyData)
        });

        const data = await res.json();
        console.log(data);

        if (res.ok) {
            console.log("Sotilgan mahsulot qo'shildi!");
            document.getElementById("soldForm").reset();

            // 🔥 MUHIM JOY — jadvalni darhol yangilaymiz
            loadSales();
        } else {
            console.log(data.message || "Xatolik yuz berdi");
        }
    } catch (err) {
        console.error(err);
        console.log("Serverga ulanib bo'lmadi");
    }
});

   document.addEventListener("DOMContentLoaded", function () {
    loadSales();
});

const token = localStorage.getItem("token"); // ✔️ token globalga chiqarildi

// Sotilgan mahsulotlarni yuklash
async function loadSales() {
    try {
        const res = await fetch(`${API_BASE}/sale`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        });

        const contentType = res.headers.get("content-type");
        if (!contentType.includes("application/json")) {
            console.error("Server JSON bermadi:", await res.text());
            return;
        }

        const data = await res.json();

        if (!res.ok) {
            console.error(data.message || "Xatolik yuz berdi");
            return;
        }

        const tbody = document.getElementById("soldTableBody");
        tbody.innerHTML = "";

        if (data.data.length === 0) {
            tbody.innerHTML = `
                <tr><td colspan="7" style="text-align:center; padding:40px;">
                    Sotilgan mahsulot qoʻshilmagan
                </td></tr>`;
            return;
        }

        data.data.forEach(sale => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${sale.product.name}</td>
                <td>${sale.quantity}</td>
                <td>${sale.product.price}</td>
                <td>${sale.total_price}</td>
                <td>${sale.creator.name}</td>
                <td>${new Date(sale.created_at).toLocaleString()}</td>
                <td>
                    <button class="btn-update"
                        data-id="${sale.id}"
                        data-qty="${sale.quantity}"
                        data-price="${sale.product.price}">✏️</button>
                    <button class="btn-delete" data-id="${sale.id}">🗑️</button>
                </td>`;
            tbody.appendChild(tr);
        });

    } catch (err) {
        console.error("Sotilgan mahsulotlarni yuklab bo'lmadi:", err);
    }
}


// UPDATE & DELETE buttonlar
document.getElementById("soldTableBody").addEventListener("click", async function(e) {
    const btn = e.target;

    // DELETE
    if (btn.classList.contains("btn-delete")) {
        if (!confirm("O'chirmoqchimisiz?")) return;

        const id = btn.dataset.id;

        try {
            const res = await fetch(`${API_BASE}/sales/${id}`, {
                method: "DELETE",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const data = await res.json();

            if (res.ok) {
                alert("O'chirildi!");
                loadSales();     // ✔️ refreshsiz yangilanadi
            } else {
                alert(data.message || "Xatolik yuz berdi");
            }

        } catch (err) {
            console.error(err);
            alert("Serverga ulanib bo'lmadi");
        }
    }

    // UPDATE
    if (btn.classList.contains("btn-update")) {
        const id = btn.dataset.id;
        const oldQty = btn.dataset.qty;
        const oldPrice = btn.dataset.price;

        const newQty = prompt("Sotilgan soni:", oldQty);
        if (newQty === null) return;

        const newPrice = prompt("Narxi:", oldPrice);
        if (newPrice === null) return;

        try {
            const res = await fetch(`${API_BASE}/sales/${id}`, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    quantity: newQty,
                    price: newPrice
                })
            });

            const data = await res.json();

            if (res.ok) {
                alert("Yangilandi!");
                loadSales();     // ✔️ refreshsiz yangilanadi
            } else {
                alert(data.message || "Xatolik yuz berdi");
            }

        } catch (err) {
            console.error(err);
            alert("Serverga ulanib bo'lmadi");
        }
    }
});


</script>
</body>
</html>




















