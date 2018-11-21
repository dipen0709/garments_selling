<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">       
        <ul class="sidebar-menu" data-widget="tree">
            <li class="@if(isset($route_group) && $route_group == 'dashboard') {{'active'}} @endif">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="@if(isset($route_group) && $route_group == 'sizewithprice') {{'active'}} @endif">
                <a href="{{route('sizewithprice')}}">
                    <i class="fa fa-book"></i> <span>Average</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="@if(isset($route_group) && $route_group == 'stock') {{'active'}} @endif">
                <a href="{{route('stock')}}">
                    <i class="fa fa-bank"></i> <span>Stock</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="@if(isset($route_group) && $route_group == 'customer') {{'active'}} @endif">
                <a href="{{route('customer')}}">
                    <i class="fa fa-user"></i> <span>Customers</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="@if(isset($route_group) && $route_group == 'bill') {{'active'}} @endif">
                <a href="{{route('bill')}}">
                    <i class="fa fa-book"></i> <span>Billing</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>