<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SHOE STORE RN</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                {{-- <ul class="dropdown-menu">
                    <li class="{{ Request::is('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">General Dashboard</a>
                    </li>
                </ul> --}}
            </li>

            <li class="nav-item dropdown ">
                <a href="{{ route('category.index') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Category</span></a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Product</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('product.index') }}">All Produk</a>
                    </li>
                    <!-- Check If variabel $categories have done definition -->
                    @isset($categories)
                        @foreach ($categories as $category)
                            <li>
                                <a class="nav-link category-filter"
                                    href="{{ route('product.index', ['category' => $category->name]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    @endisset
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('user.index') }}">All Users</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('user.index', ['role' => 'ADMIN']) }}">Admin</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('user.index', ['role' => 'USER']) }}">User</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('user.index', ['role' => 'STAFF']) }}">Staff</a>
                    </li>
                </ul>
            </li>

    </aside>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var categoryDropdown = document.getElementById('category-dropdown');

        categoryDropdown.addEventListener('change', function() {
            var selectedCategory = categoryDropdown.value;
            // Send Request AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/products?category=' + selectedCategory, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('product-list').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    });
</script>
