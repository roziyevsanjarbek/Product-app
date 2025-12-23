<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarix - History</title>
    <link rel="stylesheet" href="{{ asset('css/history.css') }}">
</head>
<body>
<!-- Added navbar -->
<x-navbar></x-navbar>

<div class="container">
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

    <!-- Main Content -->
    <main class="main-content">
        <h1>📜 Tarix - History</h1>

        <!-- Sales History Section -->
        <section class="history-section">
            <h2>
                <span class="section-icon">💰</span>
                Sotuvlar tarixi
            </h2>

            <div class="filter-section">
                <div class="filter-group">
                    <label for="salesDateFrom">Sanadan:</label>
                    <input type="date" id="salesDateFrom">
                </div>
                <div class="filter-group">
                    <label for="salesDateTo">Sanagacha:</label>
                    <input type="date" id="salesDateTo">
                </div>
                <div class="filter-group">
                    <label for="salesStatus">Holat:</label>
                    <select id="salesStatus">
                        <option>Filter</option>
                        <option value="update">Yangilangan</option>
                        <option value="delete">O'chirilgan</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>&nbsp;</label>
                    <button id="resetSalesFilter" class="reset-btn">
                        Filterni tozalash
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mahsulot Nomi</th>
                        <th>Eski miqdor</th>
                        <th>Yangi miqdor</th>
                        <th>Eski narx</th>
                        <th>Yangi narx</th>
                        <th>Holat</th>
                        <th>Kim tomonidan</th>
                        <th>Sana</th>
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
                <div class="pagination-wrapper">
                    <div id="pagination" class="pagination"></div>
                </div>
            </div>
        </section>

        <!-- Products History Section -->
        <section class="history-section">
            <h2>
                <span class="section-icon">📦</span>
                Mahsulotlar tarixi
            </h2>

            <div class="filter-section">
                <div class="filter-group">
                    <label for="productsDateFrom">Sanadan:</label>
                    <input type="date" id="productsDateFrom">
                </div>
                <div class="filter-group">
                    <label for="productsDateTo">Sanagacha:</label>
                    <input type="date" id="productsDateTo">
                </div>
                <div class="filter-group">
                    <label for="productsAction">Harakat:</label>
                    <select id="productsAction">
                        <option value="">Barchasi</option>
                        <option value="add quantity">Yaratilgan</option>
                        <option value="update">Yangilangan</option>
                        <option value="delete">O'chirilgan</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>&nbsp;</label>
                    <button id="resetProductFilters" class="reset-btn">
                        Filterni tozalash
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mahsulot Oldingi Nomi</th>
                        <th>Mahsulot Hozirgi Nomi</th>
                        <th>Holat</th>
                        <th>Yangilanishdan avvalgi Soni</th>
                        <th>Hozirgi Soni</th>
                        <th>Yangilanishdan avvalgi Narxi</th>
                        <th>Hozirgi (so'm)</th>
                        <th>Yangilanishdan avvalgi Jami (so'm)</th>
                        <th>Hozirgi Jami (so'm)</th>
                        <th>Qo'shgan User</th>
                        <th>Sana</th>
                    </tr>
                    </thead>
                    <tbody id="productTableHistory">
                    <tr>
                        <td colspan="10" style="text-align:center; padding:40px;">
                            Mahsulot qo'shilmagan
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    <div id="paginationProduct" class="pagination"></div>
                </div>
            </div>
        </section>

        <!-- Users History Section -->
        <section class="history-section">
            <h2>
                <span class="section-icon">👥</span>
                Foydalanuvchilar tarixi
            </h2>

            <div class="filter-section">
                <div class="filter-group">
                    <label for="usersDateFrom">Sanadan:</label>
                    <input type="date" id="usersDateFrom">
                </div>
                <div class="filter-group">
                    <label for="usersDateTo">Sanagacha:</label>
                    <input type="date" id="usersDateTo">
                </div>
                <div class="filter-group">
                    <label for="usersRole">Rol:</label>
                    <select id="usersRole">
                        <option value="">Barchasi</option>
                        <option value="update">Yangilangan</option>
                        <option value="delete">O'chirilgan</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>&nbsp;</label>
                    <button id="resetUsersFilter" class="reset-btn">
                        Filterni tozalash
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Oldingi ism</th>
                        <th>Yangi ism</th>
                        <th>Oldingi email</th>
                        <th>Yangi email</th>
                        <th>Oldingi rol</th>
                        <th>Yangilangan admin</th>
                        <th>Holat</th>
                        <th>Yangilangan vaqti</th>
                    </tr>
                    </thead>
                    <tbody id="userHistoryBody">
                    <tr>
                        <td colspan="5" style="text-align:center; padding:40px;">
                            Yuklanmoqda...
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">
                <div id="paginationUsers" class="pagination"></div>
            </div>
        </section>
    </main>
</div>

<script>
    // Bu yerda JavaScript funksiyalari qo'shishingiz mumkin
    // Masalan: filter logic, dynamic data loading, va boshqalar

    console.log('History page loaded');

    // Filter example
    document.querySelectorAll('input[type="date"], select').forEach(element => {
        element.addEventListener('change', function() {
            console.log('Filter changed:', this.id, this.value);
            // Bu yerda filter logikasini qo'shing
        });
    });
    document.addEventListener("DOMContentLoaded", () => {
        loadProductHistory();
        loadSalesHistory();
        loadUserHistory();
    });

    let currentProductPage = 1;
    async function loadProductHistory(page = 1) {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("productTableHistory");

        tbody.innerHTML = `
        <tr>
            <td colspan="10" style="text-align:center; padding:40px;">
                Yuklanmoqda...
            </td>
        </tr>
    `;

        try {
            const res = await fetch(`/api/all/product-history?page=${page}`, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();

            if (!response.success || !response.data || response.data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="10" style="text-align:center; padding:40px;">
                        Tarix mavjud emas
                    </td>
                </tr>
            `;
                return;
            }

            tbody.innerHTML = "";

            response.data.data.forEach((item, index) => {
                // 🔹 Action nomi
                let actionText = "";
                if (item.action === "create") actionText = "Yaratilgan";
                else if (item.action === "update") actionText = "Yangilangan";
                else if (item.action === "delete") actionText = "O‘chirilgan";
                else actionText = item.action;

                const date = new Date(item.created_at).toLocaleString();
                const userName = item.user ? item.user.name : "-";

                tbody.innerHTML += `
                <tr>
                    <td>${response.data.from + index}</td>
                    <td>${item.old_name}</td>
                    <td>${item.new_name}</td>
                    <td>${actionText}</td>
                    <td>${item.old_quantity ?? "-"}</td>
                    <td>${item.quantity ?? "-"}</td>
                    <td>${item.old_price ?? "-"}</td>
                    <td>${item.price ?? "-"}</td>
                    <td>${item.old_total_price ?? "-"}</td>
                    <td>${item.total_price ?? "-"}</td>
                    <td>${userName}</td>
                    <td>${date}</td>
                </tr>
            `;
            });

            const paginationContainer = document.getElementById("paginationProduct");

            // Agar faqat 1 sahifa bo'lsa — pagination chiqmasin
            if (response.data.last_page <= 1) {
                paginationContainer.style.display = "none";
                return;
            }

            paginationContainer.style.display = "flex";
            paginationContainer.innerHTML = "";

            // Raqamli pagination
            for (let i = 1; i <= response.data.last_page; i++) {
                const btn = document.createElement("button");
                btn.textContent = i;
                btn.className = i === response.data.current_page ? "active" : "";
                btn.onclick = () => loadProductHistory(i);
                paginationContainer.appendChild(btn);
            }


        } catch (error) {
            console.error(error);
            tbody.innerHTML = `
            <tr>
                <td colspan="10" style="text-align:center; padding:40px;">
                    Serverga ulanib bo‘lmadi
                </td>
            </tr>
        `;
        }
    }


    async function searchProductHistory() {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("productTableHistory");

        const from = document.getElementById("productsDateFrom").value;
        const to = document.getElementById("productsDateTo").value;

        let url = "/api/product-history-search-date?";
        if (from) url += `from=${from}&`;
        if (to) url += `to=${to}&`;

        tbody.innerHTML = `
        <tr>
            <td colspan="12" style="text-align:center; padding:40px;">
                Yuklanmoqda...
            </td>
        </tr>
    `;

        try {
            const res = await fetch(url, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();




            if (!response.success || response.data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="12" style="text-align:center; padding:40px;">
                        Ma’lumot topilmadi
                    </td>
                </tr>
            `;
                return;
            }

            renderProductHistory(response.data);

        } catch (e) {
            console.error("Product history yuklanmadi:", e);
            tbody.innerHTML = `
            <tr>
                <td colspan="12" style="text-align:center; padding:40px;">
                    Server bilan aloqa yo‘q
                </td>
            </tr>
        `;
        }
    }

    function renderProductHistory(data) {
        const tbody = document.getElementById("productTableHistory");
        console.log(data);

        tbody.innerHTML = "";

        data.forEach((item, index) => {
            let actionText = "";
            if (item.action === "create") actionText = "Yaratilgan";
            else if (item.action === "update") actionText = "Yangilangan";
            else if (item.action === "delete") actionText = "O‘chirilgan";
            else actionText = item.action;
            console.log(item);
            const oldName = item.old_name ?? "-";
            const newName = item.new_name ?? "-";
            const userName = item.user?.name ?? "-";
            const date = new Date(item.created_at).toLocaleString();

            tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${oldName}</td>
                <td>${newName}</td>
                <td>${actionText}</td>
                <td>${item.old_quantity ?? "-"}</td>
                <td>${item.quantity ?? "-"}</td>
                <td>${item.old_price ?? "-"}</td>
                <td>${item.price ?? "-"}</td>
                <td>${item.old_total_price ?? "-"}</td>
                <td>${item.total_price ?? "-"}</td>
                <td>${userName}</td>
                <td>${date}</td>
            </tr>
        `;
        });
    }


    async function searchProductHistoryByAction() {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("productTableHistory");

        const from = document.getElementById("productsDateFrom").value;
        const to = document.getElementById("productsDateTo").value;
        const action = document.getElementById("productsAction").value;

        let url = "/api/product-search-action?";
        if (from) url += `from=${from}&`;
        if (to) url += `to=${to}&`;
        if (action && action !== "sale") url += `action=${action}&`;

        tbody.innerHTML = `
        <tr>
            <td colspan="9" style="text-align:center; padding:40px;">
                Yuklanmoqda...
            </td>
        </tr>
    `;

        try {
            const res = await fetch(url, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();
            console.log(response)

            if (!response.success || !response.data || response.data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align:center; padding:40px;">
                        Maʼlumot topilmadi
                    </td>
                </tr>
            `;
                return;
            }

            renderProductsHistory(response.data);

        } catch (error) {
            console.error("Sale history yuklanmadi:", error);
            tbody.innerHTML = `
            <tr>
                <td colspan="9" style="text-align:center; padding:40px;">
                    Server bilan aloqa yo‘q
                </td>
            </tr>
        `;
        }
    }

    function renderProductsHistory(data) {
        const tbody = document.getElementById("productTableHistory");
        tbody.innerHTML = "";

        data.forEach((item, index) => {
            let statusText = "";
            if (item.action === "sale") statusText = "Sotilgan";
            else if (item.action === "update") statusText = "Yangilangan";
            else if (item.action === "delete") statusText = "O‘chirilgan";
            else if (item.action === "cancelled") statusText = "Bekor qilingan";
            else statusText = item.action;

            const productName = item.product?.name ?? "O‘chirilgan mahsulot";
            const userName = item.user?.name ?? "-";
            const date = new Date(item.created_at).toLocaleString();

            tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${item.old_name}</td>
                <td>${item.new_name}</td>
                <td>${statusText}</td>
                <td>${item.old_quantity ?? "-"}</td>
                <td>${item.quantity ?? "-"}</td>
                <td>${item.old_price ?? "-"}</td>
                <td>${item.price ?? "-"}</td>
                <td>${item.old_total_price}</td>
                <td>${item.total_price}</td>
                <td>${userName}</td>
                <td>${date}</td>
            </tr>
        `;
        });
    }

    document.getElementById("productsDateFrom")
        .addEventListener("change", searchProductHistoryByAction);

    document.getElementById("productsDateTo")
        .addEventListener("change", searchProductHistoryByAction);

    document.getElementById("productsAction")
        .addEventListener("change", searchProductHistoryByAction);


    document.getElementById("productsDateFrom").addEventListener("change", searchProductHistory);
    document.getElementById("productsDateTo").addEventListener("change", searchProductHistory);
    // document.getElementById("productsAction").addEventListener("change", searchProductHistory);

    function resetProductFilters() {
        document.getElementById("productsDateFrom").value = "";
        document.getElementById("productsDateTo").value = "";
        document.getElementById("productsAction").selectedIndex = 0;

        // 🔄 Barcha sotuvlarni qayta yuklash
        loadProductHistory();
    }
    document
        .getElementById("resetProductFilters")
        .addEventListener("click", resetProductFilters);






    let currentPage = 1;
    async function loadSalesHistory(page = 1) {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("salesTableHistory");

        tbody.innerHTML = `
        <tr>
            <td colspan="9" style="text-align:center; padding:40px;">
                Yuklanmoqda...
            </td>
        </tr>
    `;

        try {
            const res = await fetch(`/api/all/sale-history?page=${page}`, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();

            if (!response.success || !response.data || response.data.data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align:center; padding:40px;">
                        Sotuvlar tarixi mavjud emas
                    </td>
                </tr>
            `;
                return;
            }


            tbody.innerHTML = "";

            response.data.data.forEach((item, index) => {
                // 🔹 Action / Holat
                let statusText = "";
                if (item.action === "created") statusText = "Yaratilgan";
                else if (item.action === "update") statusText = "Yangilangan";
                else if (item.action === "deleted") statusText = "O‘chirilgan";
                else statusText = item.action;

                const date = new Date(item.created_at).toLocaleString();
                const userName = item.user ? item.user.name : "delete";


                tbody.innerHTML += `
                <tr>
                    <td>${response.data.from + index}</td>
                    <td>${item.product_id ? `${item.product_id}` : "delete"}</td>
                    <td>${item.old_quantity ?? "-"}</td>
                    <td>${item.quantity ?? "-"}</td>
                    <td>${item.old_price ?? "-"}</td>
                    <td>${item.price ?? "-"}</td>
                    <td>${statusText}</td>
                    <td>${userName}</td>
                    <td>${date}</td>
                </tr>
            `;
            });

            const paginationContainer = document.getElementById("pagination");

            // Agar faqat 1 sahifa bo'lsa — pagination chiqmasin
            if (response.data.last_page <= 1) {
                paginationContainer.style.display = "none";
                return;
            }

            paginationContainer.style.display = "flex";
            paginationContainer.innerHTML = "";

            // Raqamli pagination
            for (let i = 1; i <= response.data.last_page; i++) {
                const btn = document.createElement("button");
                btn.textContent = i;
                btn.className = i === response.data.current_page ? "active" : "";
                btn.onclick = () => loadSalesHistory(i);
                paginationContainer.appendChild(btn);
            }


        } catch (error) {
            console.error("Sale history yuklanmadi:", error);
            tbody.innerHTML = `
            <tr>
                <td colspan="9" style="text-align:center; padding:40px;">
                    Serverga ulanib bo‘lmadi
                </td>
            </tr>
        `;
        }
    }

    function resetSalesFilters() {
        document.getElementById("salesDateFrom").value = "";
        document.getElementById("salesDateTo").value = "";
        document.getElementById("salesStatus").selectedIndex = 0;

        // 🔄 Barcha sotuvlarni qayta yuklash
        loadSalesHistory();
    }

    document
        .getElementById("resetSalesFilter")
        .addEventListener("click", resetSalesFilters);


    async function searchSaleHistoryByDate() {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("salesTableHistory");

        const from = document.getElementById("salesDateFrom").value;
        const to = document.getElementById("salesDateTo").value;

        let url = "/api/sale-history-search-date?";
        if (from) url += `from=${from}&`;
        if (to) url += `to=${to}`;

        tbody.innerHTML = `
        <tr>
            <td colspan="9" style="text-align:center; padding:40px;">
                Yuklanmoqda...
            </td>
        </tr>
    `;

        try {
            const res = await fetch(url, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();

            if (!response.success || !response.data || response.data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align:center; padding:40px;">
                        Maʼlumot topilmadi
                    </td>
                </tr>
            `;
                return;
            }

            renderSaleHistoryTable(response.data);

        } catch (error) {
            console.error("Sale history yuklanmadi:", error);
            tbody.innerHTML = `
            <tr>
                <td colspan="9" style="text-align:center; padding:40px;">
                    Server bilan aloqa yo‘q
                </td>
            </tr>
        `;
        }
    }

    function renderSaleHistoryTable(data) {
        const tbody = document.getElementById("salesTableHistory");
        tbody.innerHTML = "";

        data.forEach((item, index) => {
            let statusText = "";
            if (item.action === "created") statusText = "Yaratilgan";
            else if (item.action === "update") statusText = "Yangilangan";
            else if (item.action === "deleted") statusText = "O‘chirilgan";
            else statusText = item.action;

            const productName = item.product?.name ?? "O‘chirilgan mahsulot";
            const userName = item.user?.name ?? "-";
            const date = new Date(item.created_at).toLocaleString();

            tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${productName}</td>
                <td>${item.old_quantity ?? "-"}</td>
                <td>${item.quantity ?? "-"}</td>
                <td>${item.old_price ?? "-"}</td>
                <td>${item.price ?? "-"}</td>
                <td>${statusText}</td>
                <td>${userName}</td>
                <td>${date}</td>
            </tr>
        `;
        });
    }

    async function searchSaleHistoryByAction() {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("salesTableHistory");

        const from = document.getElementById("salesDateFrom").value;
        const to = document.getElementById("salesDateTo").value;
        const action = document.getElementById("salesStatus").value;

        let url = "/api/sale-search-action?";
        if (from) url += `from=${from}&`;
        if (to) url += `to=${to}&`;
        if (action && action !== "sale") url += `action=${action}&`;

        tbody.innerHTML = `
        <tr>
            <td colspan="9" style="text-align:center; padding:40px;">
                Yuklanmoqda...
            </td>
        </tr>
    `;

        try {
            const res = await fetch(url, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();

            if (!response.success || !response.data || response.data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align:center; padding:40px;">
                        Maʼlumot topilmadi
                    </td>
                </tr>
            `;
                return;
            }

            renderSalesHistory(response.data);

        } catch (error) {
            console.error("Sale history yuklanmadi:", error);
            tbody.innerHTML = `
            <tr>
                <td colspan="9" style="text-align:center; padding:40px;">
                    Server bilan aloqa yo‘q
                </td>
            </tr>
        `;
        }
    }

    function renderSalesHistory(data) {
        const tbody = document.getElementById("salesTableHistory");
        tbody.innerHTML = "";

        data.forEach((item, index) => {
            let statusText = "";
            if (item.action === "sale") statusText = "Sotilgan";
            else if (item.action === "update") statusText = "Yangilangan";
            else if (item.action === "delete") statusText = "O‘chirilgan";
            else if (item.action === "cancelled") statusText = "Bekor qilingan";
            else statusText = item.action;

            const productName = item.product?.name ?? "O‘chirilgan mahsulot";
            const userName = item.user?.name ?? "-";
            const date = new Date(item.created_at).toLocaleString();

            tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${productName}</td>
                <td>${item.old_quantity ?? "-"}</td>
                <td>${item.quantity ?? "-"}</td>
                <td>${item.old_price ?? "-"}</td>
                <td>${item.price ?? "-"}</td>
                <td>${statusText}</td>
                <td>${userName}</td>
                <td>${date}</td>
            </tr>
        `;
        });
    }

    document.getElementById("salesDateFrom")
        .addEventListener("change", searchSaleHistoryByAction);

    document.getElementById("salesDateTo")
        .addEventListener("change", searchSaleHistoryByAction);

    document.getElementById("salesStatus")
        .addEventListener("change", searchSaleHistoryByAction);


    document.getElementById("salesDateFrom")
        .addEventListener("change", searchSaleHistoryByDate);

    document.getElementById("salesDateTo")
        .addEventListener("change", searchSaleHistoryByDate);





    let currentUsersPage = 1;
    async function loadUserHistory(page = 1) {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("userHistoryBody");

        tbody.innerHTML = `
        <tr>
            <td colspan="7" style="text-align:center; padding:40px;">
                Yuklanmoqda...
            </td>
        </tr>
    `;

        try {
            const res = await fetch(`/api/all/user-history?page=${page}`, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();

            if (!response.success || !response.data || response.data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align:center; padding:40px;">
                        Foydalanuvchilar tarixi mavjud emas
                    </td>
                </tr>
            `;
                return;
            }

            tbody.innerHTML = "";

            response.data.data.forEach((item, index) => {
                let statusText = "";
                if (item.action === "created") statusText = "Yaratilgan";
                else if (item.action === "update") statusText = "Yangilangan";
                else if (item.action === "deleted") statusText = "O‘chirilgan";
                else statusText = item.action;


                // 🔹 Sana
                const date = new Date(item.created_at).toLocaleString();
                console.log(item);

                tbody.innerHTML += `
                <tr>
                    <td>${response.data.from + index}</td>
                    <td>${item.old_name ?? "-"}</td>
                    <td>${item.new_name ?? "-"}</td>
                    <td>${item.old_email ?? "-"}</td>
                    <td>${item.new_email ?? "-"}</td>
                    <td>${item.old_role}</td>
                    <td>${item.editor.name}</td>
                    <td>${statusText}</td>
                    <td>${date}</td>
                </tr>
            `;
            });

            const paginationContainer = document.getElementById("paginationUsers");

            // Agar faqat 1 sahifa bo'lsa — pagination chiqmasin
            if (response.data.last_page <= 1) {
                paginationContainer.style.display = "none";
                return;
            }

            paginationContainer.style.display = "flex";
            paginationContainer.innerHTML = "";

            // Raqamli pagination
            for (let i = 1; i <= response.data.last_page; i++) {
                const btn = document.createElement("button");
                btn.textContent = i;
                btn.className = i === response.data.current_page ? "active" : "";
                btn.onclick = () => loadUserHistory(i);
                paginationContainer.appendChild(btn);
            }


        } catch (error) {
            console.error("User history yuklanmadi:", error);
            tbody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align:center; padding:40px;">
                    Serverga ulanib bo‘lmadi
                </td>
            </tr>
        `;
        }
    }

    async function searchUserHistory() {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("userHistoryBody");

        const from = document.getElementById("usersDateFrom").value;
        const to = document.getElementById("usersDateTo").value;
        const role = document.getElementById("usersRole").value;

        let url = "/api/user-history-search-date?";
        if (from) url += `from=${from}&`;
        if (to) url += `to=${to}&`;
        if (role) url += `role=${role}&`;

        tbody.innerHTML = `
        <tr>
            <td colspan="9" style="text-align:center; padding:40px;">
                Yuklanmoqda...
            </td>
        </tr>
    `;

        try {
            const res = await fetch(url, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();

            if (!response.success || response.data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align:center; padding:40px;">
                        Ma’lumot topilmadi
                    </td>
                </tr>
            `;
                return;
            }

            renderUserHistory(response.data);

        } catch (e) {
            console.error("User history yuklanmadi:", e);
            tbody.innerHTML = `
            <tr>
                <td colspan="9" style="text-align:center; padding:40px;">
                    Server bilan aloqa yo‘q
                </td>
            </tr>
        `;
        }
    }

    function renderUserHistory(data) {
        const tbody = document.getElementById("userHistoryBody");
        tbody.innerHTML = "";

        data.forEach((item, index) => {
            let statusText = "";
            if (item.action === "created") statusText = "Yaratilgan";
            else if (item.action === "updated") statusText = "Yangilangan";
            else if (item.action === "deleted") statusText = "O‘chirilgan";
            else statusText = item.action;
            // 🔹 OLD ROLE (JSON string → array)
            let oldRoles = "-";
            try {
                const parsed = JSON.parse(item.old_role);
                oldRoles = parsed.map(r => r.name).join(", ");
            } catch (e) {}

            // 🔹 Sana
            const date = new Date(item.created_at).toLocaleString();

            tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.old_name ?? "-"}</td>
                    <td>${item.new_name ?? "-"}</td>
                    <td>${item.old_email ?? "-"}</td>
                    <td>${item.new_email ?? "-"}</td>
                    <td>${oldRoles}</td>
                    <td>${item.editor.name}</td>
                    <td>${statusText}</td>
                    <td>${date}</td>
                </tr>
            `;
        });
    }

    async function searchUserHistoryByAction() {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("userHistoryBody");

        // DOM elementlar
        const fromInput = document.getElementById("usersDateFrom");
        const toInput = document.getElementById("usersDateTo");
        const roleSelect = document.getElementById("usersRole");

        const from = fromInput ? fromInput.value : "";
        const to = toInput ? toInput.value : "";
        let action = roleSelect ? roleSelect.value : "";

        // frontend value → backend mapping
        if (action === "update") action = "update";
        if (action === "delete") action = "delete";

        let url = "/api/user-search-action?";
        if (from) url += `from=${from}&`;
        if (to) url += `to=${to}&`;
        if (action) url += `action=${action}&`;

        tbody.innerHTML = `
        <tr>
            <td colspan="9" style="text-align:center; padding:40px;">
                Yuklanmoqda...
            </td>
        </tr>
    `;

        try {
            const res = await fetch(url, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();

            if (!response.success || !response.data || response.data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align:center; padding:40px;">
                        Maʼlumot topilmadi
                    </td>
                </tr>
            `;
                return;
            }

            renderUsersHistory(response.data);

        } catch (error) {
            console.error("User history yuklanmadi:", error);
            tbody.innerHTML = `
            <tr>
                <td colspan="9" style="text-align:center; padding:40px;">
                    Server bilan aloqa yo‘q
                </td>
            </tr>
        `;
        }
    }

    function renderUsersHistory(data) {
        const tbody = document.getElementById("userHistoryBody");
        tbody.innerHTML = "";


        data.forEach((item, index) => {
            let statusText = "";
            if (item.action === "create") statusText = "Yaratilgan";
            else if (item.action === "update") statusText = "Yangilangan";
            else if (item.action === "delete") statusText = "O‘chirilgan";
            else statusText = item.action;
            const oldName = item.old_name ?? "-";
            const newName = item.new_name ?? "-";
            const oldEmail = item.old_email ?? "-";
            const newEmail = item.new_email ?? "-";
            const oldRole = item.old_role ?? "-";
            const editorName = item.editor?.name ?? "-";
            const date = new Date(item.created_at).toLocaleString();

            tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${oldName}</td>
                <td>${newName}</td>
                <td>${oldEmail}</td>
                <td>${newEmail}</td>
                <td>${oldRole}</td>
                <td>${editorName}</td>
                <td>${statusText}</td>
                <td>${date}</td>
            </tr>
        `;
        });
    }

    document.getElementById("usersDateFrom")
        .addEventListener("change", searchUserHistoryByAction);

    document.getElementById("usersDateTo")
        .addEventListener("change", searchUserHistoryByAction);

    document.getElementById("usersRole")
        .addEventListener("change", searchUserHistoryByAction);




    document.getElementById("usersDateFrom").addEventListener("change", searchUserHistory);
    document.getElementById("usersDateTo").addEventListener("change", searchUserHistory);
    // document.getElementById("usersRole").addEventListener("change", searchUserHistory);

    function resetUsersFilters() {
        document.getElementById("usersDateFrom").value = "";
        document.getElementById("usersDateTo").value = "";
        document.getElementById("usersRole").selectedIndex = 0;

        // 🔄 Barcha sotuvlarni qayta yuklash
        loadUserHistory();
    }

    document
        .getElementById("resetUsersFilter")
        .addEventListener("click", resetUsersFilters);



</script>
</body>
</html>
