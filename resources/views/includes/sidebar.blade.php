<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item {{ Route::currentRouteName() == 'selected' || Route::currentRouteName() == 'add_product' ? 'selected' : '' }}">
                    <a class="sidebar-link sidebar-link {{ Route::currentRouteName() == 'admin_product_list' || Route::currentRouteName() == 'add_product' ? 'active' : '' }}"
                        href="#" aria-expanded="false">
                        <img src="{{ asset('src/product.png') }}" />
                        <span class="hide-menu">Products</span>
                    </a>
                    <ul class="sub-menu {{ Route::currentRouteName() == 'admin_product_list' ? 'in' : '' }}"">
                        <li class="sidebar-item {{ Route::currentRouteName() == 'admin_product_list' ? 'selected' : '' }}">
                            <a href="{{ route('admin_product_list') }}" class="sidebar-link sidebar-link {{ Route::currentRouteName() == 'admin_product_list' ? 'active' : '' }}">All Product</a>
                        </li>
                        <li class="sidebar-item {{ Route::currentRouteName() == 'add_product' ? 'selected' : '' }}">
                            <a href="{{ route('add_product') }}"  class="sidebar-link sidebar-link {{ Route::currentRouteName() == 'add_product' ? 'active' : '' }}">Add Product</a>
                        </li>
                        <li class="sidebar-item {{ Route::currentRouteName() == 'categories' ? 'selected' : '' }}"><a href="{{ route('categories') }}"  class="sidebar-link sidebar-link {{ Route::currentRouteName() == 'categories' ? 'active' : '' }}">Categories</a></li>
                    </ul>
                </li>
                <li class="list-divider"></li>
                <li class="sidebar-item  {{ Route::currentRouteName() == 'customize_product_list' ? 'selected' : '' }}"> <a
                        class="sidebar-link sidebar-link {{ Route::currentRouteName() == 'customize_product_list' ? 'active' : '' }}"
                        href="{{ route('customize_product_list') }}" aria-expanded="false">
                        <img src="{{ asset('src/print.png') }}" /><span class="hide-menu">Customize
                            Products</span></a></li>
                <li class="list-divider"></li>
                <li class="sidebar-item {{ Route::currentRouteName() == 'list_badges' ||  Route::currentRouteName() == 'view_badge' ||  Route::currentRouteName() == 'add_badge' ?  'selected' : '' }}"> <a
                        class="sidebar-link sidebar-link {{ Route::currentRouteName() == 'list_badges' ||  Route::currentRouteName() == 'view_badge' ||  Route::currentRouteName() == 'add_badge' ? 'active' : '' }}"
                        href="{{ route('badge_list') }}" aria-expanded="false"><img
                            src="{{ asset('src/badge.png') }}" /><span class="hide-menu">Badges</span></a></li>
                <li class="list-divider"></li>
                <li class="sidebar-item {{ Route::currentRouteName() == 'list_sticker' || Route::currentRouteName() == 'view_sticker' || Route::currentRouteName() == 'add_sticker' ? 'selected' : '' }}"> <a
                        class="sidebar-link sidebar-link {{ Route::currentRouteName() == 'list_sticker' || Route::currentRouteName() == 'view_sticker' || Route::currentRouteName() == 'add_sticker' ? 'active' : '' }}"
                        href="{{ route('list_sticker') }}" aria-expanded="false">
                        <img src="{{ asset('src/happy.png') }}" /><span class="hide-menu">Stickers</span></a>
                </li>
                <li class="list-divider"></li>
                <li class="sidebar-item {{ Route::currentRouteName() == 'shops' ? 'selected' : '' }}"> <a
                    class="sidebar-link sidebar-link {{ Route::currentRouteName() == 'shops' ? 'active' : '' }}"
                    href="{{ route('shops') }}" aria-expanded="false">
                    <img src="{{ asset('src/shop_icon.png') }}" /><span class="hide-menu">Shops</span></a>
                 </li>
            <li class="list-divider"></li>
                <li class="sidebar-item"> <a
                        class="sidebar-link sidebar-link  {{ Route::currentRouteName() == 'logout' ? 'active' : '' }}"
                        href="{{ route('logout') }}" aria-expanded="false">
                        <img src="{{ asset('src/logout.png') }}" /><span class="hide-menu">Logout</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<style>
    a.sidebar-link.sidebar-link img {
        width: 16%;
        margin: 0 8px 0 0px;
    }

    ul.navbar-nav.float-right {
        display: block !important;
        float: right !important;
        width: 17%;
    }

    div#navbarSupportedContent {
        display: block !important;
        text-align: right;
    }

    span.ml-2.d-none.d-lg-inline-block svg {
        float: none !important;
    }

    a.sidebar-link.sidebar-link {
        text-decoration: none;
    }

    a.sidebar-link.sidebar-link span {
        color: #000;
    }

    a.sidebar-link.sidebar-link.active {
        background: #b3bffb !important
    }

    a.sidebar-link.sidebar-link:hover {
        background: #b3bffb !important;
        border-radius: 0 60px 60px 0;
        color: #fff !important;
        box-shadow: 0 7px 12px 0 rgb(95 118 232 / 21%);
        opacity: 1;
    }

    a.sidebar-link.sidebar-link:hover span {
        color: #000;
    }
    .page-wrapper>.container-fluid {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}
</style>
