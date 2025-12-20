<x-header></x-header>

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
        <div class="pagination-wrapper">
            <div id="pagination" class="pagination"></div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                showTopRightToast("Foydalanuvchi muvaffaqiyatli qo‘shildi!");
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

    let currentPage = 1;
    async function loadUsers(page = 1) {
        const token = localStorage.getItem("token");
        const tbody = document.getElementById("userTableBody");

        try {
            const res = await fetch(`${API_BASE}/users?page=${page}`, {
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

            const users = data.data.data;

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

            const paginationContainer = document.getElementById("pagination");

            // Agar faqat 1 sahifa bo'lsa — pagination chiqmasin
            if (data.data.last_page <= 1) {
                paginationContainer.style.display = "none";
                return;
            }

            paginationContainer.style.display = "flex";
            paginationContainer.innerHTML = "";

            // Raqamli pagination
            for (let i = 1; i <= data.data.last_page; i++) {
                const btn = document.createElement("button");
                btn.textContent = i;
                btn.className = i === data.data.current_page ? "active" : "";
                btn.onclick = () => loadUsers(i);
                paginationContainer.appendChild(btn);
            }


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
                showTopRightToast('Foydalanuvchi muvaffaqiyatli qo‘shildi')
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
        showTopRightToast('Foydalanuvchi muvaffaqiyatli yangilandi');

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
    function showTopRightToast(message, icon = 'success') {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: icon,
            title: message,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            showCloseButton: true,
            width: 350,
            padding: '1em',
            didOpen: (toast) => {
                // Sichqoncha ustida timer to‘xtaydi
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    }

        </script>
<x-footer></x-footer>
