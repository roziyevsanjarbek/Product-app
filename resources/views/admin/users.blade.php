<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foydalanuvchilar</title>
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

        <h1>Foydalanuvchilar</h1>

        <div class="form-container">
            <form id="userForm">
                <div class="form-row">
                    <div class="form-group">
                        <label>Ism Familya</label>
                        <input type="text" id="userName" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="userEmail" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Roli</label>
                        <select id="userRole">
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Parol</label>
                        <input type="password" id="userPassword" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Foydalanuvchi qo‘shish</button>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>Ism Familya</th>
                    <th>Email</th>
                    <th>Roli</th>
                    <th>Ro‘yxatdan o‘tgan sana</th>
                    <th>Amallar</th>
                </tr>
                </thead>
                <tbody id="userTableBody">
                <tr>
                    <td colspan="5" style="text-align:center; padding:40px;">Foydalanuvchi yo‘q</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



        <!-- Edit Modal HTML -->
        <div id="editUserModal"
             style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">

            <form id="editUserForm"
                  style="background:#1e293b; padding:20px; border-radius:8px; width:400px; position:relative; color:white;">

                <!-- X tugmasi -->
                <span id="closeEditUserModalBtn"
                      style="position:absolute; top:10px; right:15px; font-size:22px; font-weight:bold; cursor:pointer; color:white;">
            &times;
        </span>

                <h3>Foydalanuvchini tahrirlash</h3>

                <input type="hidden" id="editUserId">

                <div class="form-group">
                    <label>Ism Familya</label>
                    <input type="text" id="editUserName" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="editUserEmail" required>
                </div>

                <div class="form-group">
                    <label>Roli</label>
                    <select id="editUserRole" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Parol (ixtiyoriy)</label>
                    <input type="password" id="editUserPassword">
                </div>

                <button type="submit" class="btn btn-primary">Saqlash</button>
                <button type="button" class="btn btn-danger" onclick="closeEditModal()">Bekor qilish</button>

            </form>
        </div>

        <!-- User Delete History Modal -->
        <div id="userHistoryModal"
             style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:1000;">
            <div class="modal-content"
                 style="background:#0f172a; color:#fff; max-width:900px; margin:50px auto;
                padding:20px; border-radius:8px; position:relative; max-height:80vh; overflow-y:auto;">
        <span class="close-modal"
              onclick="closeUserHistoryModal()"
              style="position:absolute; top:10px; right:20px; cursor:pointer; font-size:28px;">
            &times;
        </span>

                <h2 style="margin-bottom:20px;">O'chirilgan foydalanuvchilar tarixi</h2>

                <div class="table-container" style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                        <tr>
                            <th>Oldingi ism</th>
                            <th>Yangi ism</th>
                            <th>Oldingi email</th>
                            <th>Yangi email</th>
                            <th>Oldingi rol</th>
                            <th>Yangilangan admin</th>
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
            </div>
        </div>
<div id="toast" class="toast">
    <span id="toastMessage"></span>
    <span class="toast-close">&times;</span>
    <div class="toast-progress"></div>
</div>

        <script>
    const API_BASE = "/api";

    document.getElementById("userForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        const token = localStorage.getItem("token"); // admin tokenini oling

        const name = document.getElementById("userName").value.trim();
        const email = document.getElementById("userEmail").value.trim();
        const role = document.getElementById("userRole").value;
        const password = document.getElementById("userPassword").value;

        if (!name || !email || !role || !password) {
            alert("Iltimos, barcha maydonlarni to‘ldiring!");
            return;
        }

        const bodyData = {
            name: name,
            email: email,
            role: role,
            password: password
        };

        try {
            const res = await fetch(`${API_BASE}/user`, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify(bodyData)
            });

            const data = await res.json();
            console.log(data);

            if (res.ok) {
                showToast("Foydalanuvchi muvaffaqiyatli qo‘shildi!", "success");
                document.getElementById("userForm").reset();
                loadUsers();
            } else {
                let errorMsg = data.message || "Xatolik yuz berdi";
                if (data.errors) {
                    // Validation xatolarini birlashtirish
                    errorMsg = Object.values(data.errors).flat().join("\n");
                }
                alert(errorMsg);
            }

        } catch (err) {
            console.error(err);
            alert("Serverga ulanib bo‘lmadi");
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        loadUsers();
    });

    async function loadUsers() {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("userTableBody");

        try {
            const res = await fetch(`${API_BASE}/users`, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const contentType = res.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                const html = await res.text();
                console.error("Server HTML qaytardi:", html);
                tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding:40px;">Server JSON bermadi yoki token noto‘g‘ri</td></tr>`;
                return;
            }

            const data = await res.json();

            if (!res.ok || !data.success) {
                tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding:40px;">Xatolik: ${data.message || "API xatosi"}</td></tr>`;
                return;
            }

            const users = data.data;

            if (users.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding:40px;">Foydalanuvchi yo‘q</td></tr>`;
                return;
            }

            tbody.innerHTML = ""; // oldingi contentni tozalash

            users.forEach(user => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.role || "user"}</td>
                <td>${new Date(user.created_at).toLocaleString()}</td>
                <td style="display: flex ; align-items: center; margin-left: 10px; gap: 5px">
                    <button class="btn-edit" data-id="${user.id}">
                     <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" color="white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                    </button>
                    <button class="btn-delete" data-id="${user.id}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" color="white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    ️</button>
                    <button class="btn-history history-btn" data-id="${user.id}">
                        <svg xmlns="http://www.w3.org/2000/svg" color="white" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-history-icon lucide-history"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M12 7v5l4 2"/></svg>
                    </button>
                </td>
            `;
                tbody.appendChild(tr);
            });

            // Edit tugmalarini qo'shish
            document.querySelectorAll(".btn-edit").forEach(btn => {
                btn.addEventListener("click", () => editUser(btn.dataset.id));
            });

            // Delete tugmalarini qo'shish
            document.querySelectorAll(".btn-delete").forEach(btn => {
                btn.addEventListener("click", () => deleteUser(btn.dataset.id));
            });

        } catch (err) {
            console.error("Foydalanuvchilarni yuklab bo'lmadi:", err);
            tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding:40px;">Serverga ulanib bo'lmadi</td></tr>`;
        }
    }

    // O'chirish funksiyasi
    async function deleteUser(id) {
        if (!confirm("Haqiqatan ham ushbu foydalanuvchini o'chirmoqchimisiz?")) return;

        const token = localStorage.getItem("token");
        try {
            const res = await fetch(`${API_BASE}/user/${id}`, {
                method: "DELETE",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const data = await res.json();

            if (res.ok) {
                showToast("Foydalanuvchi o'chirildi!", "success");
                loadUsers(); // jadvalni yangilash
            } else {
                alert(data.message || "Xatolik yuz berdi");
            }
        } catch (err) {
            console.error(err);
            alert("Serverga ulanib bo'lmadi");
        }
    }

    // Edit funksiyasi
    function editUser(id) {
        const token = localStorage.getItem("token");

        fetch(`${API_BASE}/user/${id}`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    alert("Foydalanuvchi ma'lumotlarini olishda xatolik");
                    return;
                }

                const user = data.data;

                document.getElementById("editUserId").value = user.id;
                document.getElementById("editUserName").value = user.name;
                document.getElementById("editUserEmail").value = user.email;
                document.getElementById("editUserRole").value = user.role;

                document.getElementById("editUserModal").style.display = "flex";
            })
            .catch(err => console.error(err));
    }

    // Modalni yopish
    function closeEditModal() {
        document.getElementById("editUserModal").style.display = "none";
    }

    // Edit form submit
    document.getElementById("editUserForm").addEventListener("submit", async function(e){
    e.preventDefault();

    const token = localStorage.getItem("token");

    const id = document.getElementById("editUserId").value;
    const name = document.getElementById("editUserName").value.trim();
    const email = document.getElementById("editUserEmail").value.trim();
    const role = document.getElementById("editUserRole").value;

    const res = await fetch(`${API_BASE}/user/${id}`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`,
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify({ role, name, email })
    });

    const data = await res.json();

    if(res.ok){
        showToast("Foydalanuvchi yangilandi!", "success");

        // 🔥 Modalni yopish
        closeEditModal();

        // 🔄 Jadvalni yangilash
        loadUsers();
    } else {
        alert(data.message || "Xatolik yuz berdi");

        // 🔥 Modalni yopish
        closeEditModal();

        // 🔄 Jadvalni yangilash
        loadUsers();
    }
});

    // Event delegation orqali history tugmasi
    document.getElementById("userTableBody").addEventListener("click", function(e) {
        const btn = e.target.closest(".history-btn");
        if (!btn) return;

        // Agar kerak bo‘lsa, ma’lum user IDni ham olishingiz mumkin
        const userId = btn.dataset.id;

        // Modalni ochish va tarixni yuklash
        openUserHistoryModal(userId);
    });

    function openUserHistoryModal(userId = null) {
        document.getElementById("userHistoryModal").style.display = "flex";
        loadUserHistory(userId);
    }

    function closeUserHistoryModal() {
        document.getElementById("userHistoryModal").style.display = "none";
    }

    async function loadUserHistory(userId = null) {
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
            const res = await fetch(`${API_BASE}/history/${userId}`, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();

            if (!response.data || response.data.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align:center; padding:40px;">
                        Tarix mavjud emas
                    </td>
                </tr>
            `;
                return;
            }

            tbody.innerHTML = "";

            response.data.forEach(item => {
                // 🔹 OLD ROLE (JSON string)
                let oldRoles = "-";
                try {
                    const parsed = JSON.parse(item.old_role);
                    oldRoles = parsed.map(r => r.name).join(", ");
                } catch (e) {}

                const adminName = item.user ? item.user.name : "-";
                const updatedAt = new Date(item.created_at).toLocaleString();

                tbody.innerHTML += `
                <tr>
                    <td>${item.old_name}</td>
                    <td>${item.new_name}</td>
                    <td>${item.old_email}</td>
                    <td>${item.new_email}</td>
                    <td>${oldRoles}</td>
                    <td>${adminName}</td>
                    <td>${updatedAt}</td>
                </tr>
            `;
            });

        } catch (err) {
            console.error(err);
            tbody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align:center; padding:40px;">
                    Serverga ulanib bo‘lmadi
                </td>
            </tr>
        `;
        }
    }

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
    document.getElementById("closeEditUserModalBtn").addEventListener("click", function () {
        closeEditModal();
    });
    const editModal = document.getElementById('editUserModal');
    const historyModal = document.getElementById('userHistoryModal');

    editModal.addEventListener('click', function (e){
        if (e.target === editModal) {
            closeEditModal();
        }
    });

    historyModal.addEventListener('click', function (e){
        if (e.target === historyModal){
            closeUserHistoryModal();
        }
    });


        </script>

</body>
</html>
