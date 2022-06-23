@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.orders_suppliers_return')
                <small>({{ $orders_suppliers->total() }})</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active">@lang('site.orders_suppliers_return')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-8">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.orders_suppliers_return')
                            </h3>

                            <form action="{{ route('dashboard.ordersuppliers_return.index') }}" method="get">

                                <div class="row">

                                    <div class="col-md-8">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="@lang('site.search')" value="{{ request()->search }}">
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                            @lang('site.search')</button>
                                    </div>

                                </div><!-- end of row -->

                            </form><!-- end of form -->

                        </div><!-- end of box header -->

                        @if ($orders_suppliers->count() > 0)
                            <div class="box-body table-responsive">

                                <table class="table table-hover">
                                    <tr>
                                        <th>@lang('site.supp_name')</th>

                                        <th>@lang('site.price')</th>
                                        <!-- <th>@lang('site.status')</th> -->

                                        <th>@lang('site.created_at')</th>
                                        @if (auth()->user()->hasPermission('update_orders_suppliers', 'delete_orders_suppliers'))
                                            <th>@lang('site.action')</th>
                                        @endif
                                    </tr>

                                    @foreach ($orders_suppliers as $order)
                                        <tr>
                                            <td>{{ $order->supplier->name }}</td>
                                            <td>{{ number_format($order->total_price, 2) }}</td>
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm order-products"
                                                    data-url="{{ route('dashboard.ordersuppliers_return.products', $order->id) }}"
                                                    data-method="get">
                                                    <i class="fa fa-list"></i>
                                                    @lang('site.show')
                                                </button>
                                                @if (auth()->user()->hasPermission('update_orders_suppliers'))
                                                    <a href="{{ route('dashboard.suppliers.orders_return.edit', ['supplier' => $order->supplier->id,'orders_return' => $order->id]) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>
                                                        @lang('site.edit')</a>
                                                @endif

                                                @if (auth()->user()->hasPermission('delete_orders_suppliers'))
                                                    <form
                                                        action="{{ route('dashboard.ordersuppliers_return.destroy', $order->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                                class="fa fa-trash"></i> @lang('site.delete')</button>
                                                    </form>
                                                @else
                                                    <a href="#" class="btn btn-danger btn-sm" disabled><i
                                                            class="fa fa-trash"></i> @lang('site.delete')</a>
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach

                                </table><!-- end of table -->

                                {{ $orders_suppliers->appends(request()->query())->links() }}

                            </div>
                        @else
                            <div class="box-body">
                                <h3>@lang('site.no_records')</h3>
                            </div>
                        @endif

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.show_products')</h3>
                        </div><!-- end of box header -->

                        <div class="box-body">

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px">@lang('site.loading')</p>
                            </div>

                            <div id="order-product-list">

                            </div><!-- end of order product list -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content section -->

    </div><!-- end of content wrapper -->

@endsection
