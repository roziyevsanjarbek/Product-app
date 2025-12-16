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
    </style>
</head>
<body>
     <x-user.navbar></x-user.navbar>
<div class="container">
    <!-- Sidebar -->
    <x-user.sidebar></x-user.sidebar>

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
                    </tr>
                    </thead>
                    <tbody id="productTableBody">
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px;">Mahsulot qoʻshilmagan</td>
                        <td colspan="7" style="text-align: center; padding: 40px;">
                            <img src="https://product.websol.uz/storage/app/public/history.png" alt="img">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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


     <script>
    const API_BASE = "/api";


    document.getElementById("productForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const token = localStorage.getItem("token");

    const name = document.getElementById("productName").value;
    const quantity = document.getElementById("productQty").value;
    const price = document.getElementById("productPrice").value;

    const bodyData = {
        name: name,
        quantity: quantity,
        price: price,
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
            console.log("Mahsulot muvaffaqiyatli qo'shildi!");

            // 🔥 FORMNI TOZALAYDI
            document.getElementById("productForm").reset();

            // 🔥 REFRESH QILMASDAN YANGILAYDI
            loadProducts();
        } else {
            console.log(data.message || "Xatolik yuz berdi");
        }


    } catch (error) {
        console.error(error);
        console.log("Serverga ulanib bo'lmadi");
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


    document.addEventListener("DOMContentLoaded", function () {
        loadProducts();
    });

    const token = localStorage.getItem("token");

    async function loadProducts() {
        const tbody = document.getElementById("productTableBody");

        try {
            const res = await fetch(`${API_BASE}/product`, {
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
            `;
                tbody.appendChild(tr);
            });

        } catch (error) {
            console.error(error);
            tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:40px;">Serverga ulanib bo'lmadi</td></tr>`;
        }
    }





    // Event delegation: delete & update
    document.getElementById("productTableBody").addEventListener("click", async function(e) {
        const btn = e.target;

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
                    alert("Mahsulot o'chirildi!");
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
        if (btn.classList.contains("btn-edit")) {
            const id = btn.dataset.id;
            const name = btn.dataset.name;
            const qty = btn.dataset.qty;
            const price = btn.dataset.price;

            const newName = prompt("Mahsulot nomini kiriting:", name);
            if (newName === null) return;

            const newQty = prompt("Mahsulot sonini kiriting:", qty);
            if (newQty === null) return;

            const newPrice = prompt("Mahsulot narxini kiriting:", price);
            if (newPrice === null) return;

            try {
                const res = await fetch(`${API_BASE}/product/${id}`, {
                    method: "POST",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        name: newName,
                        quantity: newQty,
                        price: newPrice
                    })
                });

                const data = await res.json();
                if (res.ok) {
                    alert("Mahsulot yangilandi!");
                    loadProducts();
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








