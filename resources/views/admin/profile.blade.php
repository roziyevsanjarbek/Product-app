<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sahifasi</title>
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
            --bg: #0f172a;
            --card: #1e293b;
            --success: #10b981;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background-color: var(--bg);
            color: var(--text-primary);
            line-height: 1.6;
            display: flex;
        }

        /* Sidebar Navigation */
        .sidebar {
            width: 280px;
            background-color: var(--card);
            border-right: 1px solid var(--border);
            height: 100vh;
            overflow-y: auto;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-logo {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-menu {
            flex: 1;
            list-style: none;
            padding: 15px 0;
        }

        .sidebar-menu-item {
            margin: 0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            font-size: 14px;
        }

        .sidebar-link:hover {
            background-color: var(--primary);
            color: var(--text-primary);
            border-left-color: var(--accent);
        }

        .sidebar-link.active {
            background-color: var(--primary);
            color: var(--accent);
            border-left-color: var(--accent);
        }

        .sidebar-icon {
            font-size: 18px;
            width: 20px;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .sidebar-user:hover {
            background-color: var(--primary);
        }

        .sidebar-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .sidebar-user-info h4 {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .sidebar-user-info p {
            font-size: 11px;
            color: var(--text-secondary);
        }

        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .header h1 {
            font-size: 28px;
            color: var(--accent);
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

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

        .btn-secondary {
            background-color: var(--primary);
            color: var(--text-primary);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background-color: var(--card);
            border-color: var(--accent);
        }

        /* Profile Card */
        .profile-card {
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 40px;
            margin-bottom: 30px;
        }

        .profile-header {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
            align-items: flex-start;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            flex-shrink: 0;
            border: 3px solid var(--accent);
        }

        .profile-info {
            flex: 1;
        }

        .profile-info h2 {
            font-size: 24px;
            margin-bottom: 5px;
            color: var(--text-primary);
        }

        .profile-info .role {
            display: inline-block;
            background-color: rgba(59, 130, 246, 0.2);
            color: var(--accent);
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .profile-info p {
            color: var(--text-secondary);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding-top: 30px;
            border-top: 1px solid var(--border);
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: var(--accent);
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Info Grid */
        .info-grid {
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .info-grid h3 {
            font-size: 18px;
            margin-bottom: 20px;
            color: var(--accent);
        }

        .info-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-item {
            padding: 15px;
            background-color: var(--primary);
            border: 1px solid var(--border);
            border-radius: 6px;
        }

        .info-label {
            font-size: 12px;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 14px;
            color: var(--text-primary);
            font-weight: 500;
        }

        /* Activity Section */
        .activity-section {
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .activity-section h3 {
            font-size: 18px;
            margin-bottom: 20px;
            color: var(--accent);
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-time {
            color: var(--text-secondary);
            min-width: 100px;
            font-size: 12px;
        }

        .activity-text {
            color: var(--text-primary);
            flex: 1;
        }

        .activity-status {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--success);
            margin-right: 8px;
        }

        /* Edit Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 30px;
            width: 90%;
            max-width: 500px;
        }

        .modal-header {
            font-size: 20px;
            margin-bottom: 20px;
            color: var(--accent);
            border-bottom: 1px solid var(--border);
            padding-bottom: 15px;
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

        input, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background-color: var(--primary);
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.3s;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .modal-actions button {
            flex: 1;
        }

        /* Responsive Sidebar Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
                border-bottom: 1px solid var(--border);
                flex-direction: row;
            }

            .sidebar-header {
                padding: 15px 20px;
                flex: 1;
            }

            .sidebar-menu {
                display: flex;
                gap: 5px;
                padding: 0;
                overflow-x: auto;
                flex: 2;
                padding: 0 10px;
            }

            .sidebar-link {
                padding: 10px 15px;
                white-space: nowrap;
                border-left: none;
                border-bottom: 2px solid transparent;
            }

            .sidebar-link:hover,
            .sidebar-link.active {
                border-left: none;
                border-bottom-color: var(--accent);
            }

            .sidebar-footer {
                display: none;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .container {
                padding: 0;
            }

            .profile-header {
                flex-direction: column;
                gap: 20px;
                align-items: center;
                text-align: center;
            }

            .profile-card {
                padding: 20px;
            }

            .profile-stats {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .info-items {
                grid-template-columns: 1fr;
            }

            .modal-content {
                width: 95%;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar Navigation -->
<x-sidebar></x-sidebar>
<div class="main-content">
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Profil Sahifasi</h1>
            <div class="header-actions">
                <button class="btn btn-secondary" onclick="goBack()">← Orqaga</button>
                <button class="btn btn-primary" onclick="openEditModal()">Tahrirlash</button>
            </div>
        </div>

        <!-- Profile Card -->
<div class="profile-card" id="profile-card">
    <div class="profile-header">
        <div class="profile-avatar">👤</div>
        <div class="profile-info">
            <h2 id="user-name">Foydalanuvchi</h2>
            <span class="role" id="user-role">Role</span>
            <p id="user-email">📧 email@example.com</p>
        </div>
    </div>
</div>




<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">Profilni Tahrirlash</div>
        <form id="editForm">
            <div class="form-group">
                <label>Toliq Ism</label>
                <input type="text" id="editName" value="Javlon Azimov" required>
            </div>
            <div class="form-group">
                <label>Email Manzili</label>
                <input type="email" id="editEmail" value="javlon@example.com" required>
            </div>
            <div class="form-group">
                <label>Parol</label>
                <input type="text" id="editPassword" value="">
            </div>
            <div class="form-group">
                <label>Password Conformation</label>
                <input type="text" id="editConfirmedPassword" value="">
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">Saqlash</button>
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Bekor qilish</button>
            </div>
        </form>
    </div>
</div>

<script>
    const token = localStorage.getItem("token");
    const API_BASE = "/api";
    // API dan login user ma'lumotini olish
    fetch('/api/profile', {
        headers: {
            "Authorization": `Bearer ${token}`,
            "Accept": "application/json"
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            const user = data.data;
            document.getElementById('user-name').textContent = user.name;
            document.getElementById('user-email').textContent = "📧 " + user.email;
            document.getElementById('user-role').textContent = user.roles.map(r => r.name).join(', ');
        }
    })
    .catch(err => console.error(err));


    // ❗ 1) Modalni ochish + serverdan ma'lumot olish
    async function openEditModal() {
        document.getElementById('editModal').classList.add('active');

        try {
            const res = await fetch(`${API_BASE}/profile`, {
                method: "GET",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const data = await res.json();

            if (!res.ok) {
                alert("Xatolik: " + data.message);
                return;
            }

            // Inputlarga user ma'lumotlarini joylaymiz
            document.getElementById("editName").value = data.data.name;
            document.getElementById("editEmail").value = data.data.email;
            document.getElementById("editPassword").value = "";

        } catch (error) {
            alert("Profil ma'lumotlarini olishda xatolik!");
            console.log(error);
        }
    }

    // Modalni yopish
    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
    }

    // ❗ 2) Profilni yangilash (POST request)
    document.getElementById('editForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const name = document.getElementById("editName").value;
        const email = document.getElementById("editEmail").value;
        const password = document.getElementById("editPassword").value;
        const password_confirmation = document.getElementById("editConfirmedPassword").value;

        try {
            const response = await fetch(`${API_BASE}/profile`, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    ...(password ? { password: password } : {}), // parol bo‘sh bo‘lsa yubormaymiz
                    ...(password_confirmation ? {password_confirmation: password_confirmation} : {})
                })
            });

            const data = await response.json();

            if (!response.ok) {
                alert("Xatolik: " + data.message);
                return;
            }

            alert("Profil muvaffaqiyatli yangilandi!");
            closeEditModal();

            // sahifani yangilab qo‘yish (agar kerak bo‘lsa)
            location.reload();

        } catch (error) {
            alert("Serverga ulanib bo‘lmadi!");
        }
    });

    // Tashqariga bosilsa yopiladi
    document.getElementById('editModal').addEventListener('click', function (e) {
        if (e.target === this) closeEditModal();
    });

    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>
