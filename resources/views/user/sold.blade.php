<x-header :pageTitle="$pageTitle"></x-header>

<x-user.navbar></x-user.navbar>
<div class="container">
    <!-- Sidebar -->
    <x-user.sidebar></x-user.sidebar>

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
     <div id="toast" class="toast">
         <span id="toastMessage"></span>
         <span class="toast-close">&times;</span>
         <div class="toast-progress"></div>
     </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const API_BASE = "/api";

    document.addEventListener("DOMContentLoaded", function () {
    loadProducts();
});


    // Mahsulotlarni yuklash
    async function loadProducts() {
        try {
            const res = await fetch(`${API_BASE}/product`, { // API route tekshirilishi kerak
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
    // Form submit
document.getElementById("soldForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const product_id = document.getElementById("soldProduct").value;
    const sold_qty = document.getElementById("soldQty").value;

    const bodyData = {
        product_id,
        quantity: sold_qty,
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

        if (res.ok) {
            showTopRightToast("Sotilgan mahsulot qo'shildi!");
            document.getElementById("soldForm").reset();

            // 🔥 MUHIM JOY — jadvalni darhol yangilaymiz
            loadSales();
        } else {
            console.log(data.message || "Xatolik yuz berdi");
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

        }
    } catch (err) {
        console.error(err);
        console.log("Serverga ulanib bo'lmadi");
    }
});

   document.addEventListener("DOMContentLoaded", function () {
    loadSales();
});

const token = localStorage.getItem("token"); // ✔️ token globalga chiqarildi

// Sotilgan mahsulotlarni yuklash
    let currentPage = 1;
async function loadSales(page = 1) {
    try {
        const res = await fetch(`${API_BASE}/sale?page=${page}`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        });

        const contentType = res.headers.get("content-type");
        if (!contentType.includes("application/json")) {
            console.error("Server JSON bermadi:", await res.text());
            return;
        }

        const data = await res.json();

        if (!res.ok) {
            console.error(data.message || "Xatolik yuz berdi");
            return;
        }

        const tbody = document.getElementById("soldTableBody");
        tbody.innerHTML = "";

        if (data.data.length === 0) {
            tbody.innerHTML = `
                <tr><td colspan="7" style="text-align:center; padding:40px;">
                    Sotilgan mahsulot qoʻshilmagan
                </td></tr>`;
            return;
        }

        data.data.forEach(sale => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${sale.product.name}</td>
                <td>${sale.quantity}</td>
                <td>${sale.product.price}</td>
                <td>${sale.total_price}</td>
                <td>${sale.creator.name}</td>
                <td>${new Date(sale.created_at).toLocaleString()}</td>`;
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

    } catch (err) {
        console.error("Sotilgan mahsulotlarni yuklab bo'lmadi:", err);
    }
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














