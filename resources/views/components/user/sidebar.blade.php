<style>
    .sidebar {
        width: 240px;
        background: #1a1a1a;
        color: #fff;
        height: 100vh;
        padding-top: 20px;
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
        <h2>EGS User</h2>
    </div>

    <a class="nav-item {{ request()->is('user/dashboard') ? 'active' : '' }}"
       href="{{ route('userDashboard') }}">
        📊 Dashboard
    </a>

    <a class="nav-item {{ request()->is('user/products*') ? 'active' : '' }}"
       href="/user/products">
        📦 Mahsulotlar
    </a>

    <a class="nav-item {{ request()->is('user/sold*') ? 'active' : '' }}"
       href="/user/sold">
        💰 Sotilganlar
    </a>
  

</div>
