<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mb-4">
            <img src="{{asset ('assets/img/logo.png') }}" alt="">
            <a href="#">Nursery</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm mb-4">
            <a href="#">NK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ Route::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Klasifikasi</li>
            <li class="dropdown {{ Route::is('cek') ? 'active' : ''}}">
                <a href="{{ route('cek') }}" class="nav-link"><i class="fas fa-file-alt"></i><span>Klasifikasi</span></a>
            </li>
            <li class="menu-header">Manajement</li>
            <li class="dropdown {{ Route::is('settingotomatis') ? 'active' : ''}}">
                <a href="{{ route('settingotomatis') }}" class="nav-link"><i class="fas fa-file-alt"></i><span>Setting Pompa</span></a>
            </li>
            <li class="dropdown {{ Route::is('rekam-data') ? 'active' : ''}}">
                <a href="{{ route('rekam-data') }}" class="nav-link"><i class="fas fa-file-alt"></i><span>Rekam Data</span></a>
            </li>
            @if (Auth::user()->role == 'admin')
            <li class="dropdown {{ Route::is('karyawan') ? 'active' : ''}}">
                <a href="{{ route('karyawan') }}" class="nav-link"><i class="fas fa-id-badge"></i><span>Data Karyawan</span></a>
            </li>
            @endif

            <li class="dropdown {{ Route::is('blog') ? 'active' : '' }}">
                <a href="{{ route('blog') }}" class="nav-link"><i class="fas fa-share-alt"></i><span>Blog</span></a>
            </li>
        </ul>
    </aside>
</div>
