<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>@lang('site.title')</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.welcome') }}" class="{{(request()->is(app()->getLocale().'/dashboard'))?'bg-primary':''}}"><i
                        class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>

            @if (auth()->user()->hasPermission('read_categories'))
                <li><a href="{{ route('dashboard.categories.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/categories'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.categories')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_products'))
                <li><a href="{{ route('dashboard.products.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/products'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.products')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_stores'))
                <li><a href="{{ route('dashboard.stores.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/stores'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.stores')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_clients'))
                <li><a href="{{ route('dashboard.clients.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/clients'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.clients')</span></a></li>
            @endif


            @if (auth()->user()->hasPermission('read_suppliers'))
                <li><a href="{{ route('dashboard.suppliers.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/suppliers'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.suppliers')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_orders'))
                <li><a href="{{ route('dashboard.orders.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/orders'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.orders')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_orders_suppliers'))
                <li><a href="{{ route('dashboard.orders_suppliers.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/orders_suppliers'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.orders_suppliers')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_orders_return'))
                <li><a href="{{ route('dashboard.orders_return.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/orders_return'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.orders_return')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_orders_suppliers_return'))
                <li><a href="{{ route('dashboard.ordersuppliers_return.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/ordersuppliers_return'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.orders_suppliers_return')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_roles'))
                <li><a href="{{ route('dashboard.roles.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/roles'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.roles')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_users'))
                <li><a href="{{ route('dashboard.users.index') }}" class="{{(request()->is(app()->getLocale().'/dashboard/users'))?'bg-primary':''}}"><i
                            class="fa fa-th"></i><span>@lang('site.users')</span></a></li>
            @endif


        </ul>

    </section>

</aside>
