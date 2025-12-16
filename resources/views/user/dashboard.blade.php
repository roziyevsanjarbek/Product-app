<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <h1>Dashboard</h1>
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Mavjud Mahsulotlar</h3>
                <div class="stat-value" id="totalProducts">0</div>
                <div class="stat-label" id="totalProductsValue">Jami qiymati: 0 so'm</div>
            </div>
            <div class="stat-card">
                <h3>Sotilgan Mahsulotlar</h3>
                <div class="stat-value" id="soldCount">0</div>
                <div class="stat-label" id="soldValue">Jami daromad: 0 so'm</div>
            </div>
            <div class="stat-card">
                <h3>Qolgan Mahsulotlar</h3>
                <div class="stat-value" id="remainingCount">0</div>
                <div class="stat-label" id="remainingValue">Qolgan qiymati: 0 so'm</div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    loadDashboardStats();
});

const API_BASE = "/api";

async function loadDashboardStats() {
    const token = localStorage.getItem("token");

    try {
        // --- Mahsulotlar ---
        const productsRes = await fetch(`${API_BASE}/product`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        });
        const productsData = await productsRes.json();
        const products = productsData.data || [];

        // --- Sotilgan mahsulotlar ---
        const salesRes = await fetch(`${API_BASE}/sale`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        });
        const salesData = await salesRes.json();
        const sales = salesData.data || [];

        // --- Hisoblash ---
        let totalProductsQty = 0;
        let totalProductsValue = 0;
        let soldQtyTotal = 0;
        let soldValue = 0;
        let remainingQty = 0;
        let remainingValue = 0;

        products.forEach(product => {
            const pQty = parseFloat(product.quantity);
            const pPrice = parseFloat(product.price);

            totalProductsQty += pQty;
            totalProductsValue += pQty * pPrice;

            const soldProduct = sales.find(s => s.product_id === product.id);
            const soldQty = soldProduct ? parseFloat(soldProduct.quantity) : 0;
            const soldPrice = soldProduct ? parseFloat(soldProduct.total_price) : 0;

            soldQtyTotal += soldQty;
            soldValue += soldPrice;

            remainingQty += (pQty - soldQty);
            remainingValue += (pQty - soldQty) * pPrice;
        });

        // --- Foydalanuvchilar ---
        const usersRes = await fetch(`${API_BASE}/users`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        });
        const usersData = await usersRes.json();
        const users = usersData.data || [];
        const userCount = users.length;

        // --- DOM ga chiqarish ---
        document.getElementById("totalProducts").textContent = totalProductsQty;
        document.getElementById("totalProductsValue").textContent = `Jami qiymati: ${Number(totalProductsValue).toLocaleString()} so'm`;

        document.getElementById("soldCount").textContent = soldQtyTotal;
        document.getElementById("soldValue").textContent = `Jami daromad: ${Number(soldValue).toLocaleString()} so'm`;

        document.getElementById("remainingCount").textContent = remainingQty;
        document.getElementById("remainingValue").textContent = `Qolgan qiymati: ${Number(remainingValue).toLocaleString()} so'm`;

        document.getElementById("userCount").textContent = userCount;

    } catch (err) {
        console.error("Dashboard statistikasini olishda xatolik:", err);
    }
}
</script>
</body>
</html>
