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
