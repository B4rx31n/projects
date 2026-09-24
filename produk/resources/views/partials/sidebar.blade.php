<!-- Sidebar -->
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search" class="form-group">
        <input type="text" class="form-control" placeholder="Search">
    </form>
    <ul class="nav menu">
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <span class="glyphicon glyphicon-dashboard"></span> Dashboard
            </a>
        </li>
        <li class="{{ request()->routeIs('produk.*') ? 'active' : '' }}">
            <a href="{{ route('produk.index') }}">
                <span class="glyphicon glyphicon-tags"></span> Produk
            </a>
        </li>
        <li class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <a href="{{ route('kategori.index') }}">
                <span class="glyphicon glyphicon-list"></span> Kategori
            </a>
        </li>
        <li class="{{ request()->routeIs('supplier.*') ? 'active' : '' }}">
            <a href="{{ route('supplier.index') }}">
                <span class="glyphicon glyphicon-briefcase"></span> Supplier
            </a>
        </li>
        <li class="{{ request()->routeIs('charts') ? 'active' : '' }}">
            <a href="{{ route('charts') }}">
                <span class="glyphicon glyphicon-stats"></span> Charts
            </a>
        </li>
        <li class="{{ request()->routeIs('tables') ? 'active' : '' }}">
            <a href="{{ route('tables') }}">
                <span class="glyphicon glyphicon-list-alt"></span> Tables
            </a>
        </li>
        <li class="{{ request()->routeIs('forms') ? 'active' : '' }}">
            <a href="{{ route('forms') }}">
                <span class="glyphicon glyphicon-pencil"></span> Forms
            </a>
        </li>
        <li class="{{ request()->routeIs('panels') ? 'active' : '' }}">
            <a href="{{ route('panels') }}">
                <span class="glyphicon glyphicon-info-sign"></span> Panels
            </a>
        </li>
        <li class="{{ request()->routeIs('widgets') ? 'active' : '' }}">
            <a href="{{ route('widgets') }}">
                <span class="glyphicon glyphicon-th"></span> Widgets
            </a>
        </li>
    </ul>
</div>
