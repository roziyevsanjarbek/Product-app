<x-header></x-header>
    <x-super.navbar></x-super.navbar>
<div class="container">
    <!-- Sidebar -->
    <x-super.sidebar></x-super.sidebar>


    <!-- Main Content -->
    <div class="main-content">
        <h1>Dashboard</h1>
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Mavjud Mahsulotlar</h3>
                <div class="stat-value" id="totalProducts">0</div>
                <div class="stat-label" id="totalProductsValue">Jami qiymati: 0 so'm</div>
            </div>
            <div class="stat-card">
                <h3>Sotilgan Mahsulotlar</h3>
                <div class="stat-value" id="soldCount">0</div>
                <div class="stat-label" id="soldValue">Jami daromad: 0 so'm</div>
            </div>
            <div class="stat-card">
                <h3>Qolgan Mahsulotlar</h3>
                <div class="stat-value" id="remainingCount">0</div>
                <div class="stat-label" id="remainingValue">Qolgan qiymati: 0 so'm</div>
            </div>
            <div class="stat-card">
                <h3>Jami Foydalanuvchilar</h3>
                <div class="stat-value" id="userCount">0</div>
                <div class="stat-label">Sistemada roʻyxatdan oʻtgan</div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    loadDashboardStats();
});

const API_BASE = "/api";

async function loadDashboardStats() {
    const token = localStorage.getItem("token");

    try {
        // --- Mahsulotlar ---
        const productsRes = await fetch(`${API_BASE}/products`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        });
        const productsData = await productsRes.json();
        const products = productsData.data.data || [];

        // --- Sotilgan mahsulotlar ---
        const salesRes = await fetch(`${API_BASE}/sales`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        });
        const salesData = await salesRes.json();
        const sales = salesData.data.data || [];

        // --- Hisoblash ---
        let totalProductsQty = 0;
        let totalProductsValue = 0;
        let soldQtyTotal = 0;
        let soldValue = 0;
        let remainingQty = 0;
        let remainingValue = 0;

        products.forEach(product => {
            const pQty = parseFloat(product.quantity);
            const pPrice = parseFloat(product.price);

            totalProductsQty += pQty;
            totalProductsValue += pQty * pPrice;

            const soldProduct = sales.find(s => s.product_id === product.id);
            const soldQty = soldProduct ? parseFloat(soldProduct.quantity) : 0;
            const soldPrice = soldProduct ? parseFloat(soldProduct.total_price) : 0;

            soldQtyTotal += soldQty;
            soldValue += soldPrice;

            remainingQty += (pQty - soldQty);
            remainingValue += (pQty - soldQty) * pPrice;
        });

        // --- Foydalanuvchilar ---
        const usersRes = await fetch(`${API_BASE}/users`, {
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        });
        const usersData = await usersRes.json();
        const users = usersData.data.data || [];
        const userCount = users.length;

        // --- DOM ga chiqarish ---
        document.getElementById("totalProducts").textContent = totalProductsQty;
        document.getElementById("totalProductsValue").textContent = `Jami qiymati: ${Number(totalProductsValue).toLocaleString()} so'm`;

        document.getElementById("soldCount").textContent = soldQtyTotal;
        document.getElementById("soldValue").textContent = `Jami daromad: ${Number(soldValue).toLocaleString()} so'm`;

        document.getElementById("remainingCount").textContent = remainingQty;
        document.getElementById("remainingValue").textContent = `Qolgan qiymati: ${Number(remainingValue).toLocaleString()} so'm`;

        document.getElementById("userCount").textContent = userCount;

    } catch (err) {
        console.error("Dashboard statistikasini olishda xatolik:", err);
    }
}
</script>
<x-footer></x-footer>
