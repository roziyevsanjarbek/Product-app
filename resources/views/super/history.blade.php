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
<x-super.navbar></x-super.navbar>

<div class="container">
    <!-- Sidebar -->
    <x-super.sidebar></x-super.sidebar>

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
{{--                    <label for="salesDateFrom">Sanadan:</label>--}}
{{--                    <input type="date" id="salesDateFrom">--}}
                </div>
                <div class="filter-group">
{{--                    <label for="salesDateTo">Sanagacha:</label>--}}
{{--                    <input type="date" id="salesDateTo">--}}
                </div>
                <div class="filter-group">
{{--                    <label for="salesStatus">Holat:</label>--}}
{{--                    <select id="salesStatus">--}}
{{--                        <option value="">Barchasi</option>--}}
{{--                        <option value="completed">Yakunlangan</option>--}}
{{--                        <option value="pending">Kutilmoqda</option>--}}
{{--                        <option value="cancelled">Bekor qilingan</option>--}}
{{--                    </select>--}}
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
{{--                    <label for="productsDateFrom">Sanadan:</label>--}}
{{--                    <input type="date" id="productsDateFrom">--}}
                </div>
                <div class="filter-group">
{{--                    <label for="productsDateTo">Sanagacha:</label>--}}
{{--                    <input type="date" id="productsDateTo">--}}
                </div>
                <div class="filter-group">
{{--                    <label for="productsAction">Harakat:</label>--}}
{{--                    <select id="productsAction">--}}
{{--                        <option value="">Barchasi</option>--}}
{{--                        <option value="created">Yaratilgan</option>--}}
{{--                        <option value="updated">Yangilangan</option>--}}
{{--                        <option value="deleted">O'chirilgan</option>--}}
{{--                    </select>--}}
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
{{--                    <label for="usersDateFrom">Sanadan:</label>--}}
{{--                    <input type="date" id="usersDateFrom">--}}
                </div>
                <div class="filter-group">
{{--                    <label for="usersDateTo">Sanagacha:</label>--}}
{{--                    <input type="date" id="usersDateTo">--}}
                </div>
                <div class="filter-group">
{{--                    <label for="usersRole">Rol:</label>--}}
{{--                    <select id="usersRole">--}}
{{--                        <option value="">Barchasi</option>--}}
{{--                        <option value="admin">Admin</option>--}}
{{--                        <option value="manager">Manager</option>--}}
{{--                        <option value="user">User</option>--}}
{{--                    </select>--}}
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

    async function loadProductHistory() {
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
            const res = await fetch("/api/all/product-history/", {
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

            response.data.forEach((item, index) => {
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
                    <td>${index + 1}</td>
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

    async function loadSalesHistory() {
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
            const res = await fetch("/api/all/sale-history/", {
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
                        Sotuvlar tarixi mavjud emas
                    </td>
                </tr>
            `;
                return;
            }

            tbody.innerHTML = "";

            response.data.forEach((item, index) => {
                // 🔹 Action / Holat
                let statusText = "";
                if (item.action === "created") statusText = "Yaratilgan";
                else if (item.action === "update") statusText = "Yangilangan";
                else if (item.action === "deleted") statusText = "O‘chirilgan";
                else statusText = item.action;

                const date = new Date(item.created_at).toLocaleString();
                const userName = item.user ? item.user.name : "-";

                tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.product.name}</td>
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
    async function loadUserHistory() {
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
            const res = await fetch("/api/all/user-history/", {
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

            response.data.forEach((item, index) => {
                let statusText = "";
                if (item.action === "created") statusText = "Yaratilgan";
                else if (item.action === "update") statusText = "Yangilangan";
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

</script>
</body>
</html>
