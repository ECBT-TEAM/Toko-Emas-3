<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-header">MENU ADMIN</li>
<li class="nav-item {{ Route::is('produk.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Route::is('produk*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-box-open"></i>
        <p>
            Produk
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('produk.index') }}" class="nav-link {{ Route::is('produk.index*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('produk.tambah') }}" class="nav-link {{ Route::is('produk.tambah') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ Route::is('master-data.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Route::is('master-data*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-database"></i>
        <p>
            Master Data
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('master-data.user.index') }}"
                class="nav-link {{ Route::is('master-data.user.*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('master-data.supplier.index') }}"
                class="nav-link {{ Route::is('master-data.supplier.*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Supplier</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('master-data.member.index') }}"
                class="nav-link {{ Route::is('master-data.member.*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Member</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('master-data.cabang.index') }}"
                class="nav-link {{ Route::is('master-data.cabang.*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Cabang</p>
            </a>
        </li>
        <li class="nav-item {{ Route::is('master-data.barang*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('master-data.barang*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Barang
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('master-data.barang.blok.index') }}"
                        class="nav-link {{ Route::is('master-data.barang.blok.*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Blok</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master-data.barang.kategori.index') }}"
                        class="nav-link {{ Route::is('master-data.barang.kategori.*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master-data.barang.kotak.index') }}"
                        class="nav-link {{ Route::is('master-data.barang.kotak.*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Kotak</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master-data.barang.karat.index') }}"
                        class="nav-link {{ Route::is('master-data.barang.karat.*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Karat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master-data.barang.kondisi.index') }}"
                        class="nav-link {{ Route::is('master-data.barang.kondisi.*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Kondisi</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="nav-header">MENU MANAGER</li>
<li class="nav-item {{ Route::is('laporan.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Route::is('laporan*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Laporan
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item {{ Route::is('laporan.jual*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('laporan.jual*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Penjualan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('laporan.jual.index') }}"
                        class="nav-link {{ Route::is('laporan.jual.index*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Semua</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.jual.kategori') }}"
                        class="nav-link {{ Route::is('laporan.jual.kategori*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Per Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.jual.model') }}"
                        class="nav-link {{ Route::is('laporan.jual.model*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Per Model</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.jual.supplier') }}"
                        class="nav-link {{ Route::is('laporan.jual.supplier') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Per Supplier</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.jual.konsumen') }}"
                        class="nav-link {{ Route::is('laporan.jual.konsumen*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Per Konsumen</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item {{ Route::is('laporan.beli*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('laporan.beli*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Balen
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('laporan.beli.index') }}"
                        class="nav-link {{ Route::is('laporan.beli.index*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Semua</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.beli.kategori') }}"
                        class="nav-link {{ Route::is('laporan.beli.kategori*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Per Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.beli.model') }}"
                        class="nav-link {{ Route::is('laporan.beli.model*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Per Model</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.beli.supplier') }}"
                        class="nav-link {{ Route::is('laporan.beli.supplier') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Per Supplier</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.beli.konsumen') }}"
                        class="nav-link {{ Route::is('laporan.beli.konsumen*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Per Konsumen</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="nav-header">MENU KASIR</li>
<li class="nav-item {{ Route::is('kasir.jual.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Route::is('kasir.jual*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-shopping-basket"></i>
        <p>
            Jual
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('kasir.jual.index') }}"
                class="nav-link {{ Route::is('kasir.jual.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('kasir.jual.histori') }}"
                class="nav-link {{ Route::is('kasir.jual.histori') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Histori</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ Route::is('kasir.beli.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Route::is('kasir.beli*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cart-arrow-down"></i>
        <p>
            Balen
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('kasir.beli.index') }}"
                class="nav-link {{ Route::is('kasir.beli.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('kasir.beli.histori') }}"
                class="nav-link {{ Route::is('kasir.beli.histori') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Histori</p>
            </a>
        </li>
    </ul>
</li>
{{-- <li class="nav-item {{ Route::is('produk.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Route::is('produk*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-retweet"></i>
        <p>
            Tukar Tambah
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('produk.tambah') }}"
                class="nav-link {{ Route::is('produk.tambah') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('produk.tambah') }}"
                class="nav-link {{ Route::is('produk.tambah') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Histori</p>
            </a>
        </li>
    </ul>
</li> --}}
<li class="nav-header">SISTEM</li>
<li class="nav-item">
    <a href="{{ route('auth.logout') }}" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
    </a>
</li>
