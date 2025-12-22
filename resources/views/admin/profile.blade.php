<x-profile></x-profile>
<!-- Sidebar Navigation -->
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
        <div id="toast" class="toast">
            <span id="toastMessage"></span>
            <span class="toast-close">&times;</span>
            <div class="toast-progress"></div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            showTopRightToast("Profil muvaffaqiyatli yangilandi!");
            closeEditModal();


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
