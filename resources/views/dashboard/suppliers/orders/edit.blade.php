@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.edit_order')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.suppliers.index') }}">@lang('site.suppliers')</a></li>
                <li class="active">@lang('site.edit_order')</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">


                    <div class="box box-primary">

                        <div class="box-header">

                            <!-- <h3 class="box-title" style="margin-bottom: 10px">@lang('site.categories')</h3>
                                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-success ">@lang('site.addcateg')<i class="fa fa-plus"></i></a>
                                        <br> -->
                            <br>
                            <form>
                                <div class="row">
                                    <div class="col-md-8">
                                        <button class="btn btn-primary btn-sm order-prods" id="order-prods"
                                            data-url="{{ route('dashboard.orders.get_pro1', [$name ?? '']) }}"
                                            data-method="get">

                                            <i class="fa fa-search"></i> @lang('site.load_prods')

                                        </button>
                                        @if (auth()->user()->hasPermission('create_products'))
                                            <a href="{{ route('dashboard.products.create') }}"
                                                class="btn btn-success ">@lang('site.addprod')<i class="fa fa-plus"></i></a>
                                        @endif
                                    </div>

                                </div>
                            </form><!-- end of form -->


                        </div><!-- end of box header -->

                        <div class="box-body">
                            <div id="order-prod-list">

                            </div><!-- end of order product list -->



                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title">@lang('site.orders_suppliers')</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            @include('partials._errors')

                            <form
                                action="{{ route('dashboard.suppliers.orders.update', ['order' => $order->id, 'supplier' => $supplier->id]) }}"
                                method="post">

                                {{ csrf_field() }}
                                {{ method_field('put') }}

                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <select name="store_id" class="form-control">
                                                <option value="">@lang('site.all_stores')</option>
                                                @foreach ($stores as $store)
                                                    <option value="{{ $store->id }}"
                                                        {{ $order->store_id == $store->id ? 'selected' : '' }}>
                                                        {{ $store->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <select name="mony_stock_id" class="form-control">
                                                <option value="">@lang('site.all_mony_stocks')</option>
                                                @foreach ($mony_stocks as $mony_stock)
                                                    <option value="{{ $mony_stock->id }}"
                                                        {{ $order->mony_stock_id == $mony_stock->id ? 'selected' : '' }}>
                                                        {{ $mony_stock->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('site.order_date')</label>
                                            <input type="date" name="order_date" class="form-control"
                                                value="{{ $order->order_date }}">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('site.disc1')</label>
                                            <input type="double" name="disc1" step="1" min="0" class="form-control disc1"
                                                value="{{ $order->disc1 }}">

                                        </div>

                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('site.disc2')</label>
                                            <input type="double" name="disc2" step="1" min="0" class="form-control disc2"
                                                value="{{ $order->disc2 }}">

                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('site.disc3')</label>
                                            <input type="double" name="disc3" step="1" min="0" class="form-control disc3"
                                                value="{{ $order->disc3 }}">

                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('site.adds1')</label>
                                            <input type="double" name="adds1" step="1" min="0" class="form-control adds1"
                                                value="{{ $order->adds1 }}">

                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('site.adds2')</label>
                                            <input type="double" name="adds2" step="1" min="0" class="form-control adds2"
                                                value="{{ $order->adds2 }}">

                                        </div>

                                    </div>

                                </div>


                                <br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.product')</th>
                                            <th>@lang('site.quantity')</th>
                                            <th>@lang('site.price')</th>
                                            <th>@lang('site.transport')</th>

                                            <th>@lang('site.total')</th>
                                        </tr>
                                    </thead>

                                    <tbody class="order-list">

                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td><input type="double" name="products[{{ $product->id }}][quantity]"
                                                        data-price="{{ number_format($product->sale_price, 2) }}"
                                                        class="form-control input-sm product-quantity" min="1"
                                                        value="{{ $product->pivot->quantity }}"></td>
                                                <td><input type="double" name="products[{{ $product->id }}][price]"
                                                        class="form-control input-sm product-price1" min="1"
                                                        value="{{ $product->pivot->price }}"></td>
                                                <td><input type="double" name="products[{{ $product->id }}][transport]"
                                                        class="form-control input-sm product-transport" min="1"
                                                        value="{{ $product->pivot->transport }}"></td>

                                                <td class="product-price">
                                                    {{ number_format($product->pivot->price * $product->pivot->quantity + $product->pivot->transport, 2) }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm remove-product-btn"
                                                        data-id="{{ $product->id }}"><span
                                                            class="fa fa-trash"></span></button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table><!-- end of table -->

                                <h4>@lang('site.total') : <span
                                        class="total-price">{{ number_format($order->total_price, 2) }}</span></h4>

                                <button class="btn btn-primary btn-block" id="form-btn"><i class="fa fa-edit"></i>
                                    @lang('site.edit_order')</button>

                            </form><!-- end of form -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                    @if ($supplier->orders->count() > 0)
                        <div class="box box-primary">

                            <div class="box-header">

                                <h3 class="box-title" style="margin-bottom: 10px">@lang('site.previous_orders')
                                    <small>{{ $orders->total() }}</small>
                                </h3>

                            </div><!-- end of box header -->

                            <div class="box-body">

                                @foreach ($orders as $order)
                                    <div class="panel-group">

                                        <div class="panel panel-success">

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse"
                                                        href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                                </h4>
                                            </div>

                                            <div id="{{ $order->created_at->format('d-m-Y-s') }}"
                                                class="panel-collapse collapse">

                                                <div class="panel-body">

                                                    <ul class="list-group">
                                                        @foreach ($order->products as $product)
                                                            <li class="list-group-item">{{ $product->name }}</li>
                                                        @endforeach
                                                    </ul>

                                                </div><!-- end of panel body -->

                                            </div><!-- end of panel collapse -->

                                        </div><!-- end of panel primary -->

                                    </div><!-- end of panel group -->
                                @endforeach

                                {{ $orders->links() }}

                            </div><!-- end of box body -->

                        </div><!-- end of box -->
                    @endif

                </div><!-- end of col -->

            </div>
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
