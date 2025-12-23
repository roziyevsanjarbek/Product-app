<x-header  :pageTitle="$pageTitle"></x-header>

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
     <div id="toast" class="toast">
         <span id="toastMessage"></span>
         <span class="toast-close">&times;</span>
         <div class="toast-progress"></div>
     </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            showTopRightToast("Mahsulot muvaffaqiyatli qo'shildi!");

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
                showTopRightToast('Mahsulot muvaffaqiyatli yangilandi')
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
                showTopRightToast('Mahsulot muvaffaqiyatli qoshildi')
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

    let currentPage = 1;
    async function loadProducts(page = 1) {
        const tbody = document.getElementById("productTableBody");

        try {
            const res = await fetch(`${API_BASE}/product?page=${page}`, {
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



    const productModal = document.getElementById('productModal');

    productModal.addEventListener('click', function (e){
        if ( e.target === productModal){
            document.getElementById('productModal').style.display = 'none';
        }
    })
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






