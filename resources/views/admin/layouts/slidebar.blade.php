<div class="app-brand demo admin-logo">
    <a href="{{ route('home.') }}" class="app-brand-link">
        <span class="app-brand-logo demo">
            <img src="{{asset('uploads/logo/logo.png')}}" alt="" style="width:100%;">
        </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm"></i>
    </a>
</div>

<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
        <a href="{{ route('adminindex') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i>
            <div data-i18n="Layouts">Quản lý danh mục</div>
        </a>

        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{ route('admincategory.create') }}" class="menu-link">
                    <div data-i18n="Without menu">Thêm danh mục</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admincategory.index') }}" class="menu-link">
                    <div data-i18n="Without navbar">Danh sách danh mục</div>
                </a>
            </li>

        </ul>
    </li>


    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-dock-top"></i>
            <div data-i18n="Account Settings">Quản lý phim</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{ route('adminfilm.create') }}" class="menu-link">
                    <div data-i18n="Account">Thêm phim</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('adminfilm.index') }}" class="menu-link">
                    <div data-i18n="Notifications">Danh sách phim</div>
                </a>
            </li>
        </ul>
    </li>

</ul>
