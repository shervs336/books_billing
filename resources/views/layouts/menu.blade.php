<li class="{{ Request::is('dashboard') ? 'active' : '' }}">
    <a href="{!! route('dashboard') !!}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
</li>
<li class="{{ Request::is('sales*') ? 'active' : '' }}">
    <a href="{!! route('sales.index') !!}"><i class="fa fa-money"></i><span>Sales</span></a>
</li>
<li class="{{ Request::is('books*') ? 'active' : '' }}">
    <a href="{!! route('books.index') !!}"><i class="fa fa-book"></i><span>Books</span></a>
</li>
<li class="{{ Request::is('settings*') ? 'active' : '' }}">
    <a href="{!! route('settings.index') !!}"><i class="fa fa-gear"></i><span>Settings</span></a>
</li>
