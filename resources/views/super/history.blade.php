<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarix - History</title>
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
            --warning: #f59e0b;
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
            margin-top: 65px;
            padding: 30px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: var(--accent);
        }

        /* History Sections */
        .history-section {
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .history-section h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: var(--accent-light);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-icon {
            width: 24px;
            height: 24px;
            display: inline-block;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: var(--secondary);
        }

        th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border);
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        tbody tr:hover {
            background-color: var(--primary);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-secondary);
        }

        .empty-state p {
            font-size: 16px;
        }

        /* Status Badges */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: rgba(16, 185, 129, 0.2);
            color: var(--success);
        }

        .badge-warning {
            background-color: rgba(245, 158, 11, 0.2);
            color: var(--warning);
        }

        .badge-danger {
            background-color: rgba(239, 68, 68, 0.2);
            color: var(--danger);
        }

        .badge-info {
            background-color: rgba(59, 130, 246, 0.2);
            color: var(--accent);
        }

        /* Filter Section */
        .filter-section {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group label {
            display: block;
            font-size: 13px;
            margin-bottom: 5px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background-color: var(--primary);
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.3s;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--primary);
            border-bottom: 1px solid var(--border);
            padding: 15px 30px;
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--accent);
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            border-radius: 6px;
            background-color: var(--secondary);
            cursor: pointer;
            transition: all 0.3s;
        }

        .navbar-user:hover {
            background-color: var(--border);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .user-name {
            font-size: 14px;
            color: var(--text-primary);
        }

        .navbar-notifications {
            position: relative;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .navbar-notifications:hover {
            background-color: var(--secondary);
        }

        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: var(--danger);
            color: white;
            font-size: 10px;
            font-weight: 600;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
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

            .filter-section {
                flex-direction: column;
            }

            .filter-group {
                min-width: 100%;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px 10px;
            }

            /* Updated navbar for mobile */
            .navbar {
                left: 60px;
                padding: 10px 15px;
            }

            .navbar-title {
                font-size: 16px;
            }

            .user-name {
                display: none;
            }

            .navbar-right {
                gap: 10px;
            }
        }
    </style>
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
                        <option value="">Barchasi</option>
                        <option value="completed">Yakunlangan</option>
                        <option value="pending">Kutilmoqda</option>
                        <option value="cancelled">Bekor qilingan</option>
                    </select>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mahsulot ID</th>
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
                        <option value="created">Yaratilgan</option>
                        <option value="updated">Yangilangan</option>
                        <option value="deleted">O'chirilgan</option>
                    </select>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>Mahsulot Nomi</th>
                        <th>Harakat turi</th>
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
                O'chirilgan foydalanuvchilar tarixi
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
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>Ism</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>O'chirilgan admin</th>
                        <th>O'chirilgan vaqti</th>
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
</script>
</body>
</html>
