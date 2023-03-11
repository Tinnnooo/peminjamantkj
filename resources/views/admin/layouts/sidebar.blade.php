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
                        <a href="/" class="nav_link {{ request()->is('dashboard/admin') ? 'active' : '' }}">
                            <i class="bx bx-grid-alt nav_icon"></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <span class="nav_link {{ request()->is('dashboard/admin/datamaster/*') ? 'active' : '' }}" id="toggleDropdown" >
                            <i class="fa-solid fa-layer-group nav_icon"></i>
                            <span class="nav_name">Data Master <i class='bx bxs-down-arrow dropdown_icon' id="dropdownIcon"></i></span>
                        </span>
                    </li>

                    <div class="data_master-item" id="itemDropdown">
                        <li class="nav-item">
                            <a href="{{ route('barang') }}" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Barang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ruangan') }}" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Ruangan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('barang') }}" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Bahan</span>
                            </a>
                        </li>
                    </div>

                    <li class="nav-item">
                        <span class="nav_link"  id="toggleDropdown2">
                            <i class='bx bx-data nav_icon'></i>
                            <span class="nav_name">Data Peminjaman<i class='bx bxs-down-arrow dropdown_icon' id="dropdownIcon2"></i></span>
                        </span>
                    </li>

                    <div class="data_master-item" id="itemDropdown2">
                        <li class="nav-item">
                            <a href="/" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Barang Dipinjam</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Barang Kembali</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Barang Batal</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Ruangan Dipinjam</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Ruangan Kembali</span>
                            </a>
                        </li>
                    </div>

                    <li class="nav-item">
                        <a href="/" class="nav_link">
                            <i class='bx bxs-widget nav_icon'></i>
                            <span class="nav_name">Ambil Bahan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pengguna') }}" class="nav_link {{ request()->is('dashboard/admin/users') ? 'active' : '' }}">
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
