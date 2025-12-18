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
        .btn-edit{
            padding: 5px;
            border-radius: 10px;
            background-color: #fbbf24;   /* bg-amber-400 */
            display: flex;               /* flex */
            justify-content: center;     /* justify-center */
            align-items: center;         /* align-center (to‘g‘risi: items-center) */
        }
        .btn-delete{
            padding: 5px;
            border-radius: 10px;
            background-color: #fb2424;   /* bg-amber-400 */
            display: flex;               /* flex */
            justify-content: center;     /* justify-center */
            align-items: center;         /* align-center (to‘g‘risi: items-center) */
        }
        .btn-history{
            padding: 5px;
            border-radius: 10px;
            background-color: #4ffb24;   /* bg-amber-400 */
            display: flex;               /* flex */
            justify-content: center;     /* justify-center */
            align-items: center;         /* align-center (to‘g‘risi: items-center) */
        }
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4caf50; /* muvaffaqiyat uchun yashil */
            color: white;
            padding: 15px 40px 15px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 9999;
            width: 300px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        .toast.error {
            background-color: #f44336; /* xatolik uchun qizil */
        }

        .toast-close {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            font-weight: bold;
            font-size: 24px;
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            background: #fff;
            width: 100%;
            transform-origin: left;
            animation: progressBar 3s linear forwards;
        }

        @keyframes progressBar {
            from { transform: scaleX(1); }
            to { transform: scaleX(0); }
        }

    </style>
</head>
<body>
    <x-navbar></x-navbar>
<div class="container">
    <!-- Sidebar -->
        <x-sidebar></x-sidebar>

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
                        <label>Sotgan User</label>
                        <select id="soldUser" required>
                            <option value="">Foydalanuvchi tanlang</option>
                        </select>
                    </div>
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
    <!-- Sales History Modal -->
    <div id="salesModal"
         style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.6); z-index:1000;">

        <div style="
        background:#0f172a;
        color:#fff;
        max-width:1100px;
        margin:50px auto;
        padding:20px;
        border-radius:10px;
        position:relative;
    ">

        <span onclick="closeSalesModal()"
              style="position:absolute; top:10px; right:20px; font-size:28px; cursor:pointer;">
            &times;
        </span>

            <h2 style="margin-bottom:20px;">Sotuvlar tarixi</h2>

            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                    <tr style="background:#020617;">
                        <th style="padding:10px;">#</th>
                        <th style="padding:10px;">Mahsulot ID</th>
                        <th style="padding:10px;">Eski miqdor</th>
                        <th style="padding:10px;">Yangi miqdor</th>
                        <th style="padding:10px;">Eski narx</th>
                        <th style="padding:10px;">Yangi narx</th>
                        <th style="padding:10px;">Holat</th>
                        <th style="padding:10px;">Kim tomonidan</th>
                        <th style="padding:10px;">Sana</th>
                    </tr>
                    </thead>
                    <tbody id="salesTableHistory">
                    <tr>
                        <td colspan="9" style="text-align:center; padding:40px;">
                            Sotuv mavjud emas
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- Edit Sale Modal -->
    <div id="editSaleModal"
         style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">

        <form id="editSaleForm"
              style="background:#1e293b; padding:20px; border-radius:8px; width:400px; color:white; position:relative;">

            <!-- X tugmasi -->
            <span id="closeEditSaleModalBtn"
                  style="position:absolute; top:10px; right:15px; font-size:22px; font-weight:bold; cursor:pointer; color:white;">
            &times;
        </span>

            <h3>Sotuvni tahrirlash</h3>

            <input type="hidden" id="editSaleId">
            <input type="hidden" id="editUserId">

            <div class="form-group">
                <label>Mahsulot Soni</label>
                <input type="number" id="editSaleQty" required>
            </div>

            <div class="form-group">
                <label>Mahsulot Narxi</label>
                <input type="number" id="editSalePrice" required>
            </div>

            <button type="submit" class="btn btn-primary">Saqlash</button>
            <button type="button" class="btn btn-danger" onclick="closeEditSaleModal()">Bekor qilish</button>

        </form>
    </div>

    <div id="toast" class="toast">
        <span id="toastMessage"></span>
        <span class="toast-close">&times;</span>
        <div class="toast-progress"></div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        loadUsers();
        loadProducts();
    });
    const API_BASE = "/api";
    // Tokenni globalga olish
    const token = localStorage.getItem("token");

    // Userlarni yuklash
    function loadUsers() {
        fetch(`${API_BASE}/users/get`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        })
            .then(res => res.json())
            .then(data => {
                if (!data.success) return console.error("API error:", data);
                const select = document.getElementById("soldUser");
                data.data.forEach(user => {
                    const option = document.createElement("option");
                    option.value = user.id;
                    option.textContent = user.name;
                    select.appendChild(option);
                });
            })
            .catch(err => console.error(err));
    }

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
    document.getElementById("soldForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        const product_id = document.getElementById("soldProduct").value;
        const sold_qty = document.getElementById("soldQty").value;
        const user_id = document.getElementById("soldUser").value;
        const sold_price = document.getElementById("soldPrice").value;

        const bodyData = {
            product_id,
            quantity: sold_qty,
            user_id,
            price: sold_price
        };

        try {
            const res = await fetch(`${API_BASE}/sales`, { // POST route API bo‘lishi kerak
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
                showToast("Sotilgan mahsulot qo'shildi!", "success");
                console.log("Sotilgan mahsulot qo'shildi!");
                document.getElementById("soldForm").reset();

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

    // History modal
    function openSalesHistoryModal(productId = null, userId, saleId) {
        const modal = document.getElementById("salesModal");
        modal.style.display = "block";

        const tbody = document.getElementById("salesTableHistory");
        tbody.innerHTML = `
        <tr>
            <td colspan="9" style="text-align:center; padding:40px;">
                Yuklanmoqda...
            </td>
        </tr>
    `;

        fetch(`${API_BASE}/sales/history/${userId}/${saleId}`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        })
            .then(res => res.json())
            .then(res => {
                const items = res.data ?? [];
                console.log(items);
                console.log(productId);
                const filtered = productId
                    ? items.filter(i => String(i.product_id) === String(productId))
                    : items;

                tbody.innerHTML = "";

                if (!filtered.length) {
                    tbody.innerHTML = `
                    <tr>
                        <td colspan="9" style="text-align:center; padding:40px;">
                            Ma’lumot topilmadi
                        </td>
                    </tr>
                `;
                    return;
                }

                filtered.forEach((item, index) => {
                    const status =
                        item.action === "update" ? "Yangilandi" :
                            item.action === "delete" ? "O‘chirildi" :
                                "Yaratildi";

                    const userName = item.user?.name ?? '—';

                    tbody.innerHTML += `
                    <tr>
                        <td style="padding:10px; text-align:center;">${index + 1}</td>
                        <td style="padding:10px; text-align:center;">${item.product_id}</td>
                        <td style="padding:10px; text-align:center;">${item.old_quantity}</td>
                        <td style="padding:10px; text-align:center;">${item.quantity}</td>
                        <td style="padding:10px; text-align:center;">${item.old_price}</td>
                        <td style="padding:10px; text-align:center;">${item.price}</td>
                        <td style="padding:10px; text-align:center;">${status}</td>
                        <td style="padding:10px; text-align:center;">${userName}</td>
                        <td style="padding:10px; text-align:center;">
                            ${new Date(item.created_at).toLocaleString()}
                        </td>
                    </tr>
                `;
                });
            })
            .catch(() => {
                tbody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align:center; padding:40px;">
                        Xatolik yuz berdi
                    </td>
                </tr>
            `;
            });
    }

    function closeSalesModal() {
        document.getElementById("salesModal").style.display = "none";
    }


    document.getElementById("soldTableBody").addEventListener("click", function(e) {
        const btn = e.target.closest("button");
        if (!btn) return;

        const userId = btn.getAttribute("data-user-id");
        const productId = btn.getAttribute("data-product-id");
        if (btn.classList.contains("history-btn")) {
            const saleId = btn.dataset.id;

            openSalesHistoryModal(productId, userId, saleId);
        }
    });



    // Sotilgan mahsulotlarni yuklash
    async function loadSales() {
        try {
            const token = localStorage.getItem("token");

            const res = await fetch(`${API_BASE}/sales`, {
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
                console.error(data.message || "Xatolik yuz berdi");
                return;
            }

            const tbody = document.getElementById("soldTableBody");
            tbody.innerHTML = ""; // oldingi contentni tozalash

            if (data.data.length === 0) {
                tbody.innerHTML = `<tr>
                <td colspan="7" style="text-align: center; padding: 40px;">Sotilgan mahsulot qoʻshilmagan</td>
            </tr>`;
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
                 <td style="display: flex ; align-items: center; margin-left: 10px; gap: 5px">
                    <button class="btn-update btn-edit"
                        data-id="${sale.id}"
                        data-user-id="${sale.creator.id}"
                        data-qty="${sale.quantity}"
                        data-price="${sale.product.price}">
                     <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" color="white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                    </button>
                    <button class="btn-delete" data-id="${sale.id}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" color="white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                     </button>
                     <button class="btn-history history-btn" data-user-id="${sale.creator.id}" data-id="${sale.id}" data-product-id="${sale.product.id}">
                        <svg xmlns="http://www.w3.org/2000/svg" color="white" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-history-icon lucide-history"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M12 7v5l4 2"/></svg>
                    </button>
                </td>
            `;
                tbody.appendChild(tr);
            });

        } catch (err) {
            console.error("Sotilgan mahsulotlarni yuklab bo'lmadi:", err);
        }
    }

    // Event delegation: update & delete
    document.getElementById("soldTableBody").addEventListener("click", async function(e) {
        const btn = e.target.closest("button");

        // DELETE
        if (btn.classList.contains("btn-delete")) {
            if (!confirm("Haqiqatan ham ushbu sotuvni o'chirmoqchimisiz?")) return;

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
                    showToast("Sotuv o'chirildi!", "success");
                    loadSales();
                } else {
                    alert(data.message || "Xatolik yuz berdi");
                }
            } catch (err) {
                console.error(err);
                alert("Serverga ulanib bo'lmadi");
            }
        }

        // UPDATE
        const userId = btn.getAttribute("data-user-id");
        if (btn.classList.contains("btn-update")) {
            const sale = {
                id: btn.dataset.id,
                quantity: btn.dataset.qty,
                price: btn.dataset.price,
                userId,
            };
            openEditSaleModal(sale);
        }
    });
    function openEditSaleModal(sale) {
        document.getElementById("editSaleId").value = sale.id;
        document.getElementById("editSaleQty").value = sale.quantity;
        document.getElementById("editSalePrice").value = sale.price;
        document.getElementById("editUserId").value = sale.userId;

        document.getElementById("editSaleModal").style.display = "flex";
    }

    function closeEditSaleModal() {
        document.getElementById("editSaleModal").style.display = "none";
    }

    document.getElementById("editSaleForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        const id = document.getElementById("editSaleId").value;
        const quantity = document.getElementById("editSaleQty").value;
        const price = document.getElementById("editSalePrice").value;
        const user_id = document.getElementById("editUserId").value;

        try {
            const res = await fetch(`${API_BASE}/sales/${id}`, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({user_id, quantity, price })
            });

            const data = await res.json();
            if (res.ok) {
                showToast("Sotuv yangilandi!", "success");
                closeEditSaleModal();
                loadSales();
            } else {
                alert(data.message || "Xatolik yuz berdi");
            }
        } catch (err) {
            console.error(err);
            alert("Serverga ulanib bo'lmadi");
        }
    });
    function showToast(message, type = "success") {
        const toast = document.getElementById("toast");
        const toastMessage = document.getElementById("toastMessage");
        const toastProgress = toast.querySelector(".toast-progress");
        const toastClose = toast.querySelector(".toast-close");

        toastMessage.textContent = message;

        // type ga qarab rang berish
        toast.className = "toast"; // klassni tozalash
        if(type === "error") {
            toast.classList.add("error");
        }

        toast.classList.add("show");

        // progress animatsiyasini qayta ishga tushirish
        toastProgress.style.animation = "none";
        void toastProgress.offsetWidth; // reflow trigger
        toastProgress.style.animation = "progressBar 3s linear forwards";

        // 3 soniyadan keyin avtomatik yopish
        let timeout = setTimeout(() => {
            toast.classList.remove("show");
        }, 3000);

        // X tugmasini bosganida toastni yopish
        toastClose.onclick = () => {
            toast.classList.remove("show");
            clearTimeout(timeout);
        };
    }

    document.getElementById("closeEditSaleModalBtn").addEventListener("click", function () {
        closeEditSaleModal();
    });

    const editModal = document.getElementById('editSaleModal');
    const historyModal = document.getElementById('salesModal');

    editModal.addEventListener('click', function (e){
        if (e.target === editModal) {
            closeEditSaleModal();
        }
    });

    historyModal.addEventListener('click', function (e){
        if (e.target === historyModal){
            closeSalesModal();
        }
    });




    </script>
</body>
</html>




















