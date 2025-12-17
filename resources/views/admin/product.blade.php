<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahsulotlar</title>
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
        /* Modal background */
        #productModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(2px);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Modal box */
        #productModal form {
            background: #1e293b;
            padding: 25px;
            border-radius: 12px;
            width: 400px;
            color: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
            animation: modalFade .25s ease-out;
        }

        @keyframes modalFade {
            from { transform: scale(0.85); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }

        /* Buttons */
        .btn-style {
            width: 100%;
            padding: 12px 0;
            margin-top: 15px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            transition: 0.2s;
        }

        .btn-style:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        /* Select */
        .product-select {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border-radius: 6px;
            border: none;
            font-size: 15px;
            background-color: #374151; /* Dark gray background */
            color: white;
        }


        .modal-overlay {
            display: none; /* defaultda yopiq */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-content {
            background: #fff;
            width: 85%;
            max-height: 85%;
            overflow-y: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0,0,0,0.3);
            position: relative;
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 30px;
            cursor: pointer;
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


        /*.table-container table {*/
        /*    width: 100%;*/
        /*    border-collapse: collapse;*/
        /*}*/

        /*.table-container th, .table-container td {*/
        /*    padding: 10px;*/
        /*    border-bottom: 1px solid #ddd;*/
        /*    text-align: center;*/
        /*}*/

        /*.table-container th {*/
        /*    background: #f5f5f5;*/
        /*    font-weight: bold;*/
        /*}*/


    </style>
</head>
<body>
<x-navbar></x-navbar>
<div class="container">
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

    <!-- Main Content -->
    <div class="main-content">
        <div id="products" class="page active">
            <h1>Mahsulotlarni Qoʻshish</h1>
            <div class="form-container">
                <form id="productForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Mahsulot Nomi</label>
                            <input type="text" id="productName" placeholder="Masalan: Kiyim" required>
                        </div>
                        <div class="form-group">
                            <label>Sonı (dona)</label>
                            <input type="number" id="productQty" placeholder="0" min="1" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Narxi (so'm)</label>
                            <input type="number" id="productPrice" placeholder="0" min="1" required>
                        </div>
                        <div class="form-group">
                            <label>Qoʻshgan User</label>
                            <select id="productUser" required>
                                <option value="">Foydalanuvchi tanlang</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Mahsulot Qoʻshish</button>
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>Mahsulot Nomi</th>
                        <th>Sonı</th>
                        <th>Narxi (so'm)</th>
                        <th>Jami (so'm)</th>
                        <th>Qoʻshgan User</th>
                        <th>Sana</th>
                        <th>Amal</th>
                    </tr>
                    </thead>
                    <tbody id="productTableBody">
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px;">Mahsulot qoʻshilmagan</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div id="editUserModal"
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">

    <form id="editUserForm"
          style="background:#1e293b; padding:20px; border-radius:8px; width:400px; color:white;">

        <h3>Mahsulotni tahrirlash</h3>

        <input type="hidden" id="editUserId">

        <div class="form-group">
            <label>Mahsulot Nomi</label>
            <input type="text" id="editUserName" required>
        </div>

        <div class="form-group">
            <label>Mahsulot Soni</label>
            <input type="number" id="editUserQty" required>
        </div>

        <div class="form-group">
            <label>Mahsulot Narxi</label>
            <input type="number" id="editUserPrice" required>
        </div>

        <button type="submit" class="btn btn-primary">Saqlash</button>
        <button type="button" class="btn btn-danger" onclick="closeEditModal()">Bekor qilish</button>

    </form>
</div>

<!-- Product Modal HTML -->
<div id="productModal">
    <form id="product">
        <h3 style="margin-bottom: 20px; font-weight: 600; text-align: center;">
            Narx farq qildi. Qaysi variantni tanlaysiz?
        </h3>

        <!-- Select Option qo'shildi -->
        <select class="product-select" id="priceOption" name="priceOption">
            <option value="" disabled selected>Ko‘rmoqchi bo‘lgan narxni tanlang</option>
        </select>

        <button type="submit" class="btn btn-primary btn-style">
            Mavjud mahsulot narxini yangilash
        </button>

        <button type="button" class="btn btn-success btn-style" id="saveOldPriceBtn">
            Yangi mahsulot sifatida qo‘shish
        </button>
    </form>
</div>

<!-- Product History Modal -->
<div id="tableModal" class="modal-overlay"
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:1000;">
    <div class="modal-content"
         style="background:#0f172a; color:#fff; max-width:900px; margin:50px auto;
                padding:20px; border-radius:8px; position:relative;">
        <span class="close-modal"
              onclick="closeTableModal()"
              style="position:absolute; top:10px; right:20px; cursor:pointer; font-size:28px;">
            &times;
        </span>

        <h2 style="margin-bottom:20px;">Mahsulotlar roʻyxati</h2>

        <div class="table-container" style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                <tr>
                    <th>Mahsulot Nomi</th>
                    <th>Soni</th>
                    <th>Narxi (so'm)</th>
                    <th>Jami (so'm)</th>
                    <th>Qoʻshgan User</th>
                    <th>Sana</th>
                </tr>
                </thead>
                <tbody id="productTableHistory">
                <tr>
                    <td colspan="6" style="text-align:center; padding:40px;">
                        Mahsulot qoʻshilmagan
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="toast" class="toast">
    <span id="toastMessage"></span>
    <span class="toast-close">&times;</span>
    <div class="toast-progress"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        loadUsers();
    });
    const API_BASE = "/api";
    function loadUsers() {
        const token = localStorage.getItem("token");

        fetch(`${API_BASE}/users/get`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        })
            .then(res => res.json())
            .then(data => {

                // API success ni tekshiramiz
                if (!data.success) {
                    console.error("API error:", data);
                    return;
                }

                const users = data.data; // <-- BU MUHIM

                const select = document.getElementById("productUser");

                users.forEach(user => {
                    const option = document.createElement("option");
                    option.value = user.id;
                    option.textContent = user.name;
                    select.appendChild(option);
                });
            })
            .catch(err => console.error(err));
    }

    document.getElementById("productForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        const token = localStorage.getItem("token");

        const name = document.getElementById("productName").value;
        const quantity = document.getElementById("productQty").value;
        const price = document.getElementById("productPrice").value;
        const user_id = document.getElementById("productUser").value;

        const bodyData = {
            name: name,
            quantity: quantity,
            price: price,
            user_id: user_id
        };

        try {
            const res = await fetch(`${API_BASE}/product`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify(bodyData)
            });

            const data = await res.json();
            console.log(data);

            const productName = document.getElementById('productName').value

            try {
                const res = await fetch(`${API_BASE}/product/price?name=${productName}`, {
                    method: "GET",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Accept": "application/json"
                    }
                });

                const contentType = res.headers.get("content-type");
                if (!contentType || !contentType.includes("application/json")) {
                    console.error("Server JSON emas:", await res.text());
                    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:40px;">Server JSON bermadi yoki token noto‘g‘ri</td></tr>`;
                    return;
                }

                const data = await res.json();
                console.log(data)

                const select = document.getElementById("priceOption");

                // Avval eski optionlarni tozalaymiz
                select.innerHTML = "";


                data?.product?.forEach((item , index)=> {
                    const option = document.createElement('option')
                    option.value = item.id;
                    option.textContent = item.price
                    select.appendChild(option);
                })


            } catch (error) {
                console.error(error);
            }


            // 409 response
            if (res.status === 409) {

                // Modalni ochamiz
                document.getElementById("productModal").style.display = "flex";
                return;
            }


            if (res.ok) {
                showToast("Mahsulot muvaffaqiyatli qo'shildi!", "success");
                document.getElementById("productForm").reset();

                loadProducts();

            } else {
                console.log(data.message || "Xatolik yuz berdi");
            }
        } catch (error) {
            console.error(error);
            console.log("Serverga ulanib bo'lmadi");
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        loadProducts();
    });

    const token = localStorage.getItem("token");

    async function loadProducts() {
        const tbody = document.getElementById("productTableBody");

        try {
            const res = await fetch(`${API_BASE}/products`, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const contentType = res.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                console.error("Server JSON emas:", await res.text());
                tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:40px;">Server JSON bermadi yoki token noto‘g‘ri</td></tr>`;
                return;
            }

            const data = await res.json();

            if (!res.ok) {
                tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:40px;">Xatolik: ${data.message}</td></tr>`;
                return;
            }

            const products = data.data;

            if (products.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:40px;">Mahsulot qoʻshilmagan</td></tr>`;
                return;
            }

            tbody.innerHTML = "";

            products.forEach(product => {
                const total = parseFloat(product.quantity) * parseFloat(product.price);
                const tr = document.createElement("tr");
                tr.innerHTML = `
                <td>${product.name}</td>
                <td>${product.quantity}</td>
                <td>${Number(product.price).toLocaleString()}</td>
                <td>${Number(total).toLocaleString()}</td>
                <td>${product.creator ? product.creator.name : 'Noma\'lum'}</td>
                <td>${new Date(product.created_at).toLocaleString()}</td>
                <td style="display: flex ; align-items: center; margin-left: 10px; gap: 5px">
                    <button class="btn-edit" data-id="${product.id}" data-name="${product.name}" data-qty="${product.quantity}" data-price="${product.price}">
                     <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" color="white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                    </button>
                    <button class="btn-delete bg-red-500" data-id="${product.id}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" color="white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    </button>
                    <button class="btn-history history-btn" data-id="${product.creator.id}">
                        <svg xmlns="http://www.w3.org/2000/svg" color="white" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-history-icon lucide-history"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M12 7v5l4 2"/></svg>
                    </button>
                </td>
            `;
                tbody.appendChild(tr);
            });

        } catch (error) {
            console.error(error);
            tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:40px;">Serverga ulanib bo'lmadi</td></tr>`;
        }
    }

    async function loadProductHistory(userId) {
        try {
            const res = await fetch(`/api/products/history/${userId}`, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });
            const data = await res.json();

            console.log("History data:", data);

            renderHistoryTable(data);
        } catch (err) {
            console.error("History yuklashda xato:", err);
        }
    }

    function renderHistoryTable(response) {
        const tbody = document.getElementById("productTableHistory");
        tbody.innerHTML = "";

        // backend data: [ ... ] yoki { data: [ ... ] }
        const items = Array.isArray(response) ? response : response.data;

        if (!items || items.length === 0) {
            tbody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px;">Tarix topilmadi</td>
            </tr>
        `;
            return;
        }

        items.forEach(item => {
            console.log(item);
            tbody.innerHTML += `
            <tr>
                <td>${item.product?.name ?? "-"}</td>
                <td>${item.quantity}</td>
                <td>${item.product?.price}</td>
                <td>${item.quantity * (item.product?.price ?? 0)}</td>
                <td>${item.user?.name ?? "-"}</td>
                <td>${new Date(item.created_at).toLocaleString()}</td>

            </tr>
        `;
        });
    }


    function openTableModal() {
        document.getElementById("tableModal").style.display = "flex";
    }

    function closeTableModal() {
        document.getElementById("tableModal").style.display = "none";
    }

    // HISTORY BUTTON bosilganda modalni ochish + data yuklash
    document.addEventListener("click", async function(e) {
        const btn = e.target.closest(".history-btn");

        if (btn) {
            const userId = btn.getAttribute("data-id");

            openTableModal();          // modalni ochamiz
            await loadProductHistory(userId); // ma'lumotlarni yuklaymiz
        }
    });


    // Event delegation: delete & update
    document.getElementById("productTableBody").addEventListener("click", async function(e) {
        const btn = e.target.closest("button"); // SVG bosilgan bo'lsa ham buttonni oladi
        if (!btn) return;

            // DELETE
            if (btn.classList.contains("btn-delete")) {
                if (!confirm("Rostdan o'chirmoqchimisiz?")) return;
                const id = btn.dataset.id;
                try {
                    const res = await fetch(`${API_BASE}/product/${id}`, {
                        method: "DELETE",
                        headers: {
                            "Authorization": `Bearer ${token}`,
                            "Accept": "application/json"
                        }
                    });
                    const data = await res.json();
                    if (res.ok) {
                        showToast("Mahsulot o'chirildi!", "success");
                        loadProducts();
                    } else {
                        alert(data.message || "Xatolik yuz berdi");
                    }
                } catch (err) {
                    console.error(err);
                    alert("Serverga ulanib bo'lmadi");
                }
            }

            // UPDATE
        if (btn && btn.classList.contains("btn-edit")) {
            const product = {
                id: btn.dataset.id,
                name: btn.dataset.name,
                quantity: btn.dataset.qty,
                price: btn.dataset.price
            };
            openEditModal(product); // modalni ochadi va inputlarni to‘ldiradi
        }

    });
    function openEditModal(product) {
        document.getElementById("editUserId").value = product.id;
        document.getElementById("editUserName").value = product.name;
        document.getElementById("editUserQty").value = product.quantity;
        document.getElementById("editUserPrice").value = product.price;

        document.getElementById("editUserModal").style.display = "flex";
    }

    function closeEditModal() {
        document.getElementById("editUserModal").style.display = "none";
    }

    document.getElementById("editUserForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        const token = localStorage.getItem("token");

        const id = document.getElementById("editUserId").value;
        const name = document.getElementById("editUserName").value;
        const quantity = document.getElementById("editUserQty").value;
        const price = document.getElementById("editUserPrice").value;

        try {
            const res = await fetch(`${API_BASE}/product/${id}`, {
                method: "POST", // yoki PUT, sening backend route ga qarab
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify({ name, quantity, price })
            });

            const data = await res.json();

            if (res.ok) {
                showToast("Mahsulot yangilandi!", "success");
                closeEditModal();
                loadProducts();
            } else {
                alert(data.message || "Xatolik yuz berdi");
            }
        } catch (err) {
            console.error(err);
            alert("Serverga ulanib bo'lmadi");
        }
    });


    // MODAL PRIMARY BUTTON — Mavjud mahsulot narxini yangilash
    document.querySelector("#product .btn-primary").addEventListener("click", async function(e) {
        e.preventDefault();

        const token = localStorage.getItem("token");

        // Formdagi oxirgi qiymatlar
        const quantity = document.getElementById("productQty").value;
        const new_price = document.getElementById("productPrice").value;
        let conflictProductId = document.getElementById('priceOption').value;

        const bodyData = {
            product_id: conflictProductId,
            quantity: quantity,
            new_price: new_price,

        };


        try {
            const res = await fetch("/api/products/update-price-and-add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify(bodyData)
            });

            const data = await res.json();
            console.log("UPDATE PRICE RESPONSE:", data);

            if (res.ok) {
                showToast("Sahifa muvafaqiyatli yangiladi!", "success");
                document.getElementById("productModal").style.display = "none";
                document.getElementById("productForm").reset();
                loadProducts();
            } else {
                console.log(data.message || "Xatolik yuz berdi");
            }
        } catch (err) {
            console.error(err);
        }
    });

    document.getElementById("saveOldPriceBtn").addEventListener("click", async function() {
        const token = localStorage.getItem("token");

        const name = document.getElementById("productName").value;
        const quantity = document.getElementById("productQty").value;
        const price = document.getElementById("productPrice").value;

        const bodyData = { name, quantity, price };

        try {
            const res = await fetch("/api/products/force-create", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify(bodyData)
            });

            const data = await res.json();
            console.log("FORCE CREATE RESPONSE:", data);

            if (res.ok) {
                showToast("Mahsulot Qo'shildi!", "success");
                document.getElementById("productModal").style.display = "none";
                document.getElementById("productForm").reset();
                loadProducts();
            } else {
                console.log(data.message || "Xatolik yuz berdi");
            }
        } catch (err) {
            console.error(err);
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




</script>

</body>
</html>








