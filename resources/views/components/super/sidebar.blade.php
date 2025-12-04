<style>
.sidebar {
    position: fixed;      /* doimiy chap tomonda turadi */
    width: 240px;
    background: #1f2937;  /* navbar bilan bir xil rang */
    color: #fff;
    height: 100vh;
    padding-top: 20px;
    z-index: 1000;        /* navbar ustida chiqmasligi uchun */
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 14px 20px;
    color: #ddd;
    text-decoration: none;
    font-size: 16px;
    transition: 0.2s ease;
}

.nav-item:hover {
    background: #333;
}

.nav-item.active {
    background: #4a90e2;
    color: white;
    font-weight: bold;
}


</style>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>EGS Super Admin</h2>
    </div>

    <a class="nav-item {{ request()->is('super/dashboard') ? 'active' : '' }}"
       href="{{ route('superDashboard') }}">
        📊 Dashboard
    </a>

    <a class="nav-item {{ request()->is('super/products*') ? 'active' : '' }}"
       href="/super/products">
        📦 Mahsulotlar
    </a>

    <a class="nav-item {{ request()->is('super/sold*') ? 'active' : '' }}"
       href="/super/sold">
        💰 Sotilganlar
    </a>

    <a class="nav-item {{ request()->is('super/users*') ? 'active' : '' }}"
       href="/super/users">
        👥 Foydalanuvchilar
    </a>

</div>
