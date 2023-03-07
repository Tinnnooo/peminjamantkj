<div class="l-navbar show" id="nav-bar">
    <nav class="nav">
        <div>
            <span class="nav_logo">
                <i class="fa-solid fa-server text-white"></i>
                <span class="nav_logo-name">PinjamTKJ</span>
            </span>
            <div class="nav_list">
                <ul class="nav flex-column" id="nav_accordion">
                    <li class="nav-item">
                        <a href="/" class="nav_link active">
                            <i class="bx bx-grid-alt nav_icon"></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/" class="nav_link">
                            <i class="fa-solid fa-layer-group nav_icon"></i>
                            <span class="nav_name">Data Master</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/" class="nav_link">
                            <i class='bx bx-data nav_icon'></i>
                            <span class="nav_name">Data Peminjaman</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/" class="nav_link">
                            <i class='bx bxs-widget nav_icon'></i>
                            <span class="nav_name">Ambil Bahan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/" class="nav_link">
                            <i class='bx bxs-user nav_icon'></i>
                            <span class="nav_name">Pengguna</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="nav_link nav_link_logout">
                                <i class='bx bx-exit nav_icon'></i>
                                <span class="nav_name">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
