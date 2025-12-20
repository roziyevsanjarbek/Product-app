<x-header></x-header>
    <x-super.navbar></x-super.navbar>
<div class="container">
    <!-- Sidebar -->
    <x-super.sidebar></x-super.sidebar>

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
                        <div class="form-group" hidden="hidden">
                            <label>Qoʻshgan User</label>
                            <select id="productUser" required>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Mahsulot Qoʻshish</button>
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


    <!-- Edit Modal HTML -->
    <div id="editUserModal"
         style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">

        <form id="editUserForm"
              style="background:#1e293b; padding:20px; border-radius:8px; width:400px; color:white; position: relative;">

            <!-- X tugmasi -->
            <span id="closeEditModalBtn" style="position:absolute; top:10px; right:15px; font-size:22px; font-weight:bold; cursor:pointer; color:white;">&times;</span>

            <h3>Mahsulotni tahrirlash</h3>

            <input type="hidden" id="editUserId">
            <div class="form-group" hidden="hidden">
                <label>Tahrirlagan User</label>
                <input type="number" id="editUser" required>
            </div>

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
                        <th>Mahsulot Oldingi Nomi</th>
                        <th>Mahsulot Hozirgi Nomi</th>
                        <th>Hatakat turi</th>
                        <th>Yangilanishdan avvalgi Soni</th>
                        <th>Hozirgi Soni</th>
                        <th>Yangilanishdan avvalgi Narxi</th>
                        <th>Hozirgi (so'm)</th>
                        <th>Yangilanishdan avvalgi Jami (so'm)</th>
                        <th>Hozirgi Jami (so'm)</th>
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




    <!-- CDN orqali qo'shish -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        loadUsers();
    });

    const API_BASE = "/api";
    function loadUsers() {
        const token = localStorage.getItem("token");

        fetch(`${API_BASE}/user/get`, {
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

                const user = data.data; // <-- BU MUHIM

                const select = document.getElementById("productUser");
                const option = document.createElement("option");
                option.textContent = user.name;
                select.appendChild(option);
                option.value = user.id;
            })
            .catch(err => console.error(err));
    }

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
                showTopRightToast("Ma'lumot muvaffaqiyatli saqlandi!")

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
    let currentPage = 1;
    async function loadProducts(page = 1) {
        const tbody = document.getElementById("productTableBody");

        try {
            const res = await fetch(`${API_BASE}/products?page=${page}`, {
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

            const products = data.data.data;

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
                    <button class="btn-edit" data-id="${product.id}" data-user-id="${product.creator.id}" data-name="${product.name}" data-qty="${product.quantity}" data-price="${product.price}">
                     <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" color="white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                    </button>
                    <button class="btn-delete bg-red-500" data-id="${product.id}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" color="white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    </button>
                    <button class="btn-history history-btn" data-id="${product.creator.id}" data-product-id="${product.id}">
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
                btn.onclick = () => loadProducts(i);
                paginationContainer.appendChild(btn);
            }


        } catch (error) {
            console.error(error);
            tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:40px;">Serverga ulanib bo'lmadi</td></tr>`;
        }
    }

    async function loadProductHistory(userId,productId) {
        try {
            const res = await fetch(`/api/product/history/${userId}/${productId}`, {
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

        let items = [];

        // 🔥 ENG MUHIM JOY
        if (Array.isArray(response.product)) {
            items = response.product; // ← TO‘G‘RI
        } else if (response.product) {
            items = [response.product]; // bitta object bo‘lsa
        } else if (Array.isArray(response.data)) {
            items = response.data;
        }

        if (!items.length) {
            tbody.innerHTML = `
            <tr>
                <td colspan="10" style="text-align:center; padding:40px;">
                    Tarix topilmadi
                </td>
            </tr>
        `;
            return;
        }

        items.forEach(item => {
            tbody.innerHTML += `
            <tr>
                <td>${item.old_name ?? "-"}</td>
                <td>${item.new_name ?? "-"}</td>

                <td>${item.action ?? "-"}</td>

                <td>${item.old_quantity ?? "-"}</td>
                <td>${item.quantity ?? "-"}</td>

                <td>${Number(item.old_price ?? 0).toLocaleString()}</td>
                <td>${Number(item.price ?? 0).toLocaleString()}</td>

                <td>${Number(item.old_total_price ?? 0).toLocaleString()}</td>
                <td>${Number(item.total_price ?? 0).toLocaleString()}</td>

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
            const productId = btn.getAttribute('data-product-id');

            openTableModal();          // modalni ochamiz
            await loadProductHistory(userId, productId); // ma'lumotlarni yuklaymiz
        }
    });

    // Event delegation: delete & update
    document.getElementById("productTableBody").addEventListener("click", async function(e) {
        const btn = e.target.closest("button");

        // DELETE
        if (btn.classList.contains("btn-delete")) {
            const id = btn.dataset.id;

            // SweetAlert2 confirm
            Swal.fire({
                title: 'Diqqat!',
                text: "Rostdan o'chirmoqchimisiz?",
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
                        const res = await fetch(`${API_BASE}/product/${id}`, {
                            method: "DELETE",
                            headers: {
                                "Authorization": `Bearer ${token}`,
                                "Accept": "application/json"
                            }
                        });
                        const data = await res.json();
                        if (res.ok) {
                            showTopRightToast("Mahsulot o'chirildi!")
                            loadProducts();
                        } else {
                            Swal.fire('Xatolik', data.message || "Xatolik yuz berdi", 'error');
                        }
                    } catch (err) {
                        console.error(err);
                        Swal.fire('Xatolik', "Serverga ulanib bo'lmadi", 'error');
                    }
                }
            });
        }



        // UPDATE
        const userId = btn.getAttribute("data-user-id")
        if (btn && btn.classList.contains("btn-edit")) {
            const product = {
                id: btn.dataset.id,
                user_id: userId,
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
        document.getElementById("editUser").value = product.user_id;


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
        const userId = document.getElementById('editUser').value;
        try {

            const res = await fetch(`${API_BASE}/product/${id}`, {
                method: "POST", // yoki PUT, sening backend route ga qarab
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify({id, userId, name, quantity, price })
            });

            const data = await res.json();

            if (res.ok) {
                showTopRightToast("Ma'lumot muvaffaqiyatli saqlandi!")
                closeEditModal();
                loadProducts();
            } else {
                showTopRightToast(data.message || "Saqlashda xatolik yuz berdi", "error")
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
        const userId = document.getElementById("productUser").value;

        const bodyData = {
            user_id: userId,
            product_id: conflictProductId,
            quantity: quantity,
            new_price: new_price,

        };


        try {
            const res = await fetch(`${API_BASE}/products/update-price-and-add`, {
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
                showTopRightToast("Ma'lumot muvaffaqiyatli saqlandi!");
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
                showTopRightToast("Ma'lumot muvaffaqiyatli saqlandi!")
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


    // Modal overlay bosilganda yopish
    const editModal = document.getElementById("editUserModal");
    const historyModal = document.getElementById("tableModal");
    const productModal = document.getElementById("productModal");


    editModal.addEventListener("click", function(e) {
        // Agar bosilgan joy modalning o'z formi bo'lmasa, modalni yopamiz
        if (e.target === editModal) {
            closeEditModal();
        }
    });

    historyModal.addEventListener("click", function (e) {
        if (e.target === historyModal) {
            closeTableModal();
        }
    });

    productModal.addEventListener("click", function (e){
        if(e.target === productModal){
            document.getElementById("productModal").style.display = "none";
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








