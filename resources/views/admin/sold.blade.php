<x-header  :pageTitle="$pageTitle"></x-header>

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
                        <label>Sotilgan Narxi (so'm)</label>
                        <input type="number" id="soldPrice" placeholder="0" min="1" required>
                    </div>
                    <div class="form-group" hidden="hidden">
                        <label>Sotgan User</label>
                        <select id="soldUser" required>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sotilgan Mahsulot Qoʻshish</button>
            </form>
        </div>
        <div class="pagination-wrapper">
            <div id="pagination" class="pagination"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        fetch(`${API_BASE}/user/get`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        })
            .then(res => res.json())
            .then(data => {
                if (!data.success) return console.error("API error:", data);
                const user = data.data;
                const select = document.getElementById("soldUser");
                const option = document.createElement("option");
                option.value = user.id;
                option.textContent = user.name;
                select.appendChild(option);
            })
            .catch(err => console.error(err));
    }

    // Mahsulotlarni yuklash
    async function loadProducts() {
        try {
            const res = await fetch(`${API_BASE}/products`, { // API route tekshirilishi kerak
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
            data.data.data.forEach(product => {
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
        const sold_qty   = document.getElementById("soldQty").value;
        const sold_price = document.getElementById("soldPrice").value;

        const bodyData = {
            product_id,
            quantity: sold_qty,
            price: sold_price
        };

        try {
            const res = await fetch(`${API_BASE}/sales`, {
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

            // ❌ XATOLIKLAR
            if (!res.ok) {

                // 403 → boshqa user mahsuloti
                if (res.status === 403) {
                    Swal.fire({
                        icon: "error",
                        title: "Ruxsat yo‘q",
                        text: data.message || "Bu mahsulotni sota olmaysiz"
                    });
                    return;
                }

                // 400 → omborda yetarli emas
                if (res.status === 400) {
                    Swal.fire({
                        icon: "warning",
                        title: "Yetarli mahsulot yo‘q",
                        html: `
                        <p>${data.message}</p>
                        <b>Omborda mavjud:</b> ${data.quantity} dona
                             `
                    });
                    return;
                }


                // boshqa xatolar
                Swal.fire({
                    icon: "error",
                    title: "Xatolik",
                    text: data.message || "Noma’lum xatolik yuz berdi"
                });
                return;
            }

            // ✅ MUVAFFAQIYAT
            showTopRightToast('Sotilgan mahsulot qo‘shildi' , 'success')

            // Swal.fire({
            //     icon: "success",
            //     title: "Muvaffaqiyatli",
            //     text: "Sotilgan mahsulot qo‘shildi!",
            //     timer: 1500,
            //     showConfirmButton: false
            // });

            document.getElementById("soldForm").reset();
            loadSales();

        } catch (err) {
            console.error(err);

            Swal.fire({
                icon: "error",
                title: "Server xatosi",
                text: "Serverga ulanib bo‘lmadi"
            });
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
    let currentPage = 1;
    async function loadSales(page = 1) {
        try {
            const token = localStorage.getItem("token");

            const res = await fetch(`${API_BASE}/sales?page=${page}`, {
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

            data.data.data.forEach(sale => {
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
                btn.onclick = () => loadSales(i);
                paginationContainer.appendChild(btn);
            }


        } catch (err) {
            console.error("Sotilgan mahsulotlarni yuklab bo'lmadi:", err);
        }
    }

    // Event delegation: update & delete
    document.getElementById("soldTableBody").addEventListener("click", async function(e) {
        const btn = e.target.closest("button");

        // DELETE
        if (btn.classList.contains("btn-delete")) {
            const id = btn.dataset.id;

            // SweetAlert2 confirm
            Swal.fire({
                title: 'Diqqat!',
                text: "Haqiqatan ham ushbu sotuvni o'chirmoqchimisiz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ha, o‘chirilsin!',
                cancelButtonText: 'Bekor qilish'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    // 🔹 Backendga DELETE request
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
                            showTopRightToast("Sotilgan mahsulot o'chirildi!")
                            loadSales();
                        } else {
                            alert(data.message || "Xatolik yuz berdi");
                        }
                    } catch (err) {
                        console.error(err);
                        alert("Serverga ulanib bo'lmadi");
                    }
                }
            });
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
                showTopRightToast('Sotuv yangilandi!' , 'success')
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

















