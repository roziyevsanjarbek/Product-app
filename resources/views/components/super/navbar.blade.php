<style>
    /* Navbar */
        .navbar {
            width: 100%;
            height: 60px;
            background-color: var(--primary);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .nav-left .logo {
            color: var(--accent);
            font-size: 20px;
            font-weight: 600;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-user span {
            font-size: 15px;
            color: var(--text-primary);
        }

        .logout-btn {
            background-color: var(--danger);
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background-color: #dc2626;
        }

        /* Fix for layout */
        .container {
            margin-top: 60px;
        }
        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            background-color: var(--secondary);
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            color: var(--text-primary);
            border: 1px solid var(--border);
            transition: 0.3s;
        }

        .user-btn:hover {
            border-color: var(--accent);
        }

        .user-btn .arrow {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .dropdown-menu {
            position: absolute;
            top: 45px;
            right: 0;
            width: 160px;
            background-color: var(--primary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 8px 0;
            display: none;
            z-index: 200;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            padding: 10px 14px;
            color: var(--text-primary);
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
        }

        .dropdown-item:hover {
            background-color: var(--secondary);
        }

        .logout-item {
            color: var(--danger) !important;
        }

</style>
<nav class="navbar">
    <div class="nav-left">
        <h2 class="logo">My Dashboard</h2>
    </div>

    <div class="nav-right">

        <!-- User Dropdown -->
        <div class="user-dropdown">
            <div class="user-btn" onclick="toggleDropdown()">
                <span id="navbarUser">Loading...</span>
                <span class="arrow">▼</span>
            </div>

            <div class="dropdown-menu" id="dropdownMenu">
                  <a class="nav-item {{ request()->is('super/profile*') ? 'active' : '' }}"
                    href="/super/profile">
                        👤 Profile
                    </a>
                    <a class="nav-item {{ request()->is('super/logout*') ? 'active' : '' }}"
                    href="{{ route('logout') }}">
                        🔚 Chiqish
                    </a>
            </div>
        </div>

    </div>
</nav>
<script>
    function toggleDropdown() {
        document.getElementById("dropdownMenu").classList.toggle("show");
    }

    // Tashqariga bosilsa dropdown yopilsin
    document.addEventListener("click", function (e) {
        const menu = document.getElementById("dropdownMenu");
        const btn = document.querySelector(".user-btn");

        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.remove("show");
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
    const name = localStorage.getItem("userName") || "Admin";
    document.getElementById("navbarUser").textContent = name;
});

</script>
