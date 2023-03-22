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
                        <a href="/" class="nav_link {{ request()->is('dashboard/*') ? 'active' : '' }}">
                            <i class="bx bx-grid-alt nav_icon"></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                    </li>

                    @role('admin')
                    {{--  DATA MASTER  --}}
                    <li class="nav-item">
                        <span class="nav_link {{ request()->is('*/datamaster/*') ? 'active' : '' }}" id="toggleDropdown" >
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
                            <a href="{{ route('bahan') }}" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Bahan</span>
                            </a>
                        </li>
                    </div>

                    {{--  DATA PEMINJAMAN  --}}
                    <li class="nav-item ">
                        <span class="nav_link {{ request()->is('*/datapeminjaman/*') ? 'active' : '' }}"  id="toggleDropdown2">
                            <i class='bx bx-data nav_icon'></i>
                            <span class="nav_name">Data Peminjaman<i class='bx bxs-down-arrow dropdown_icon' id="dropdownIcon2"></i></span>
                        </span>
                    </li>

                    <div class="data_master-item" id="itemDropdown2">
                        <li class="nav-item">
                            <a href="{{ route('barangDipinjam') }}" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Barang Dipinjam</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('barangKembali') }}" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Barang Kembali</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('barangBatal') }}" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Barang Batal</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ruanganDipinjam') }}" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Ruangan Dipinjam</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ruanganKembali') }}" class="nav_link">
                                <i class='bx bxs-circle nav_icon'></i>
                                <span class="nav_name">Ruangan Kembali</span>
                            </a>
                        </li>
                    </div>
                    @endrole

                    @if(auth()->user()->hasAnyRole(['guru', 'user']))
                    {{--  PINJAM BARANG  --}}
                    <li class="nav-item">
                        <a href="{{ auth()->user()->hasRole('guru') ? route('pinjamBarangGuru') : route('pinjamBarangUser') }}" class="nav_link {{ request()->is('*/pinjambarang') ? 'active' : ''}} {{ request()->is('*/pinjambarang/*') ? 'active' : '' }}">
                            <i class="fa-solid fa-box-open nav_icon"></i>
                            <span class="nav_name">Pinjam Barang</span>
                        </a>
                    </li>

                    {{--  PINJAM RUANGAN  --}}
                    <li class="nav-item">
                        <a href="{{ auth()->user()->hasRole('guru') ? route('pinjamRuanganGuru') : route('pinjamRuanganUser') }}" class="nav_link {{ request()->is('*/pinjamruangan') ? 'active' : ''}} {{ request()->is('*/pinjamruangan/*') ? 'active' : '' }}">
                            <i class="bx bx-home-alt-2 nav_icon"></i>
                            <span class="nav_name">Pinjam Ruangan</span>
                        </a>
                    </li>
                    @endif

                    {{--  AMBIL BAHAN  --}}
                    @if(auth()->user()->hasAnyRole(['admin', 'guru']))
                    <li class="nav-item">
                        <a href="{{ auth()->user()->hasRole('admin') ? route('admin.ambilBahan') : route('guru.ambilBahan') }}" class="nav_link {{ request()->is('*/ambilbahan') ? 'active' : ''}} {{ request()->is('*/ambilbahan/*') ? 'active' : '' }}">
                            <i class='bx bxs-widget nav_icon'></i>
                            <span class="nav_name">Ambil Bahan</span>
                        </a>
                    </li>
                    @endif

                    {{--  PENGGUNA  --}}
                    @role('admin')
                    <li class="nav-item">
                        <a href="{{ route('pengguna') }}" class="nav_link {{ request()->is('*/users') ? 'active' : '' }}">
                            <i class='bx bxs-user nav_icon'></i>
                            <span class="nav_name">Pengguna</span>
                        </a>
                    </li>
                    @endrole

                    <li class="nav-item">
                        <form action="
                        @if(Auth::user()->hasRole('admin'))
                            {{ route('admin.logout') }}
                        @elseif(Auth::user()->hasRole('guru'))
                            {{ route('guru.logout') }}
                        @elseif(Auth::user()->hasRole('user'))
                            {{ route('user.logout') }}
                        @endif
                        " method="post">
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
