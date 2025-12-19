<x-header></x-header>

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
            data.data.forEach(product => {
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
            showToast("Sotilgan mahsulot qo'shildi!", "success");
            document.getElementById("soldForm").reset();

            // 🔥 MUHIM JOY — jadvalni darhol yangilaymiz
            loadSales();
        } else {
            console.log(data.message || "Xatolik yuz berdi");
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
async function loadSales() {
    try {
        const res = await fetch(`${API_BASE}/sale`, {
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

    } catch (err) {
        console.error("Sotilgan mahsulotlarni yuklab bo'lmadi:", err);
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


</script>
<x-footer></x-footer>














