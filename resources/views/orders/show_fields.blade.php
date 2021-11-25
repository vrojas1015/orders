@extends('layouts.app')

@push('page_css')
    <link href="{{ asset('assets/vendor/pickadate/themes/default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/pickadate/themes/default.date.css') }}" rel="stylesheet">

@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Orders</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Order</a></li>
            </ol>
        </div>
        {!! Form::open(['id' => 'form_order']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-4">
                                <div class="row align-items-center">
                                    <div class="col-sm-9 mt-5">
                                        <div class="brand-logo mb-3">
                                            <img class="logo-abbr mr-2" src="{{asset('assets/images/logo.png')}}"
                                                 alt="">
                                            <img class="logo-compact" src="{{asset('assets/images/logo-text.png')}}"
                                                 alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row align-items-center">
                                    <div class="col-sm-9">
                                        <span>Please send exact amount: <strong class="d-block">0.15050000 BTC</strong>
                                                    <strong>1DonateWffyhwAjskoEwXt83pHZxhLTr8H</strong></span><br>
                                        <small class="text-muted">Current exchange rate 1BTC = $6590 USD</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <!-- User Id Field -->
                                {!! Form::hidden('user_id',  Auth::user()->id , ['class' => 'form-control']) !!}
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Invoice</span>
                                    </div>
                                    {!! Form::number('invoice', $order->invoice, ['class' => 'form-control', 'disabled'=>true]) !!}

                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Order Date</span>
                                    </div>
                                    <input name="order_date" class="datepicker-default form-control" id="order_date" value="{{$order->order_date}}" disabled/>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Installed Date</span>
                                    </div>
                                    <input name="installed_date" class="datepicker-default form-control" id="installed_date" value="{{$order->installed_date}}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <span><strong>Status:</strong></span>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="status_quote">
                                            @if ($order->status == "Quote")
                                                <input type="radio" class="form-check-input" name="status" id="status_quote" value="Quote" checked disabled>
                                            @else
                                                <input type="radio" class="form-check-input" name="status" id="status_quote" value="Quote" disabled>
                                            @endif
                                            Quote
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="status_shop">
                                            @if ($order->status == "In Shop")
                                                <input type="radio" class="form-check-input" name="status" id="status_shop" value="In Shop" checked disabled>
                                            @else
                                                <input type="radio" class="form-check-input" name="status" id="status_shop" value="In Shop" disabled>
                                            @endif
                                            In Shop
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="status_installation">
                                            @if ($order->status == "Installation")
                                                <input type="radio" class="form-check-input" name="status" id="status_installation" value="Installation" checked disabled>
                                            @else
                                                <input type="radio" class="form-check-input" name="status" id="status_installation" value="Installation" disabled>
                                            @endif
                                            Installation
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="status_installed">
                                            @if ($order->status == "Installed")
                                                <input type="radio" class="form-check-input" name="status" id="status_installed" value="Installed" checked disabled>
                                            @else
                                                <input type="radio" class="form-check-input" name="status" id="status_installed" value="Installed" disabled>
                                            @endif
                                            Installed
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="status_cancel">
                                            @if ($order->status == "Cancel")
                                                <input type="radio" class="form-check-input" name="status" id="status_installed" value="Cancel" checked disabled>
                                            @else
                                                <input type="radio" class="form-check-input" name="status" id="status_installed" value="Cancel" disabled>
                                            @endif
                                            Cancel
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Dealer:</strong></span>
                                    </div>
                                    {!! Form::text('dealer', $order->dealer, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Country:</strong></span>
                                    </div>
                                    {!! Form::text('dealer_country', $order->dealer_country, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Phone:</strong></span>
                                    </div>
                                    {!! Form::number('dealer_phone', $order->dealer_phone, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Buyer Name(s):</strong></span>
                                    </div>
                                    {!! Form::text('buyer_name', $order->buyer_name, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Buyer Address:</strong></span>
                                    </div>
                                    {!! Form::text('buyer_address', $order->buyer_address, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>City:</strong></span>
                                    </div>
                                    {!! Form::text('city', $order->city, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>State:</strong></span>
                                    </div>
                                    {!! Form::text('state', $order->state, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Zip:</strong></span>
                                    </div>
                                    {!! Form::text('zip', $order->zip, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Phone(Day):</strong></span>
                                    </div>
                                    {!! Form::number('phone_day', $order->phone_day, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>(Evening):</strong></span>
                                    </div>
                                    {!! Form::number('phone_evening', $order->phone_evening, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>(Cell):</strong></span>
                                    </div>
                                    {!! Form::number('phone_cell', $order->phone_cell, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Installation Site:</strong></span>
                                    </div>
                                    {!! Form::text('installation_site', $order->installation_site, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Email Address:</strong></span>
                                    </div>
                                    {!! Form::text('email', $order->email, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                    <!--
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-responsive-sm">
                                    <tbody>
                                        <tr>
                                            <td colspan="6">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>Description:</strong></span>
                                                    </div>
                                                    {!! Form::text('description', null, ['class' => 'form-control']) !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Width:</strong></span>
                            </div>
{!! Form::number('width', null, ['class' => 'form-control']) !!}
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Roof Length:</strong></span>
                            </div>
{!! Form::number('roof_length', null, ['class' => 'form-control']) !!}
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Frame Length:</strong></span>
                            </div>
{!! Form::number('frame_length', null, ['class' => 'form-control']) !!}
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Leg Height:</strong></span>
                            </div>
{!! Form::number('leg_height', null, ['class' => 'form-control']) !!}
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Gauge:</strong></span>
                            </div>
{!! Form::number('gauge', null, ['class' => 'form-control']) !!}
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Price:</strong></span>
                            </div>
{!! Form::number('price', null, ['class' => 'form-control']) !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><strong>Options:</strong></td>
                    <td>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="regular_frame" id="regular_frame" value="false">
                                Regular Frame
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="a_frame" id="a_frame">
                                A-Frame
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="vertical_roof" id="vertical_roof">
                                Vertical Roof
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="all_vertical" id="all_vertical">
                                ALL Vertical
                            </label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
-->

                        <div class="row">
                            <div class="card-body">
                                <button type="button" class="btn btn-square btn-success" data-toggle="modal" data-target="#exampleModalCenter">Create Item</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="table-responsive">
                                    <table class="table table-striped" >
                                        <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_item">
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->item}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->price*$item->amount}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <h4>ALL ORDERS C.O.D</h4>
                                    <table class="table table-clear">
                                        <tbody>
                                        <tr>
                                            <td class="left"><strong>Total Sale</strong></td>
                                            <td class="right">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>$</strong></span>
                                                    </div>
                                                    {!! Form::number('total_sale', $order->total_sale, ['class' => 'form-control', 'id' => 'total_sale', 'readonly' => true]) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Tax</strong></td>
                                            <td class="right">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>%</strong></span>
                                                    </div>
                                                    {!! Form::number('tax', $order->tax, ['class' => 'form-control', 'id' => 'tax', 'onchange' => 'calculaTotal()', 'disabled'=>true ]) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Tax Exempt</strong></td>
                                            <td class="right">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>$</strong></span>
                                                    </div>
                                                    {!! Form::number('tax_exempt', $order->tax_exempt, ['class' => 'form-control', 'id' => 'tax_exempt', 'disabled'=>true]) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Non-Tax<br>
                                                    Contractor Fee</strong></td>
                                            <td class="right">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>$</strong></span>
                                                    </div>
                                                    {!! Form::text('non_tax_contractor_fee', $order->non_tax_contractor_fee, ['class' => 'form-control', 'id' => 'contractor_fee', 'disabled'=>true]) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Total</strong> </td>
                                            <td class="right">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>$</strong></span>
                                                    </div>
                                                    {!! Form::number('total', $order->total, ['name' =>'total', 'class' => 'form-control', 'id' => 'total_order', 'readonly' => 'true']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Dealer Deposit</strong> </td>
                                            <td class="right">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>$</strong></span>
                                                    </div>
                                                    {!! Form::number('dealer_deposit', $order->dealer_deposit, ['class' => 'form-control', 'id' => 'dealer_deposit', 'disabled'=>true]) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Amount Paid</strong> </td>
                                            <td class="right">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>$</strong></span>
                                                    </div>
                                                    {!! Form::number('amount_paid', $order->amount_paid, ['class' => 'form-control', 'id' => 'amount_paid', 'disabled'=>true]) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Balance Due</strong> </td>
                                            <td class="right">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>$</strong></span>
                                                    </div>
                                                    {!! Form::number('balance_due', $order->balance_due, ['class' => 'form-control', 'id' => 'balance_due', 'disabled'=>true]) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Special Instructions</h5>
                                {!!  Form::textarea('special_instruction', null, [
                                    'class'      => 'form-control',
                                    'rows'       => 4,
                                    'id'         => 'special_instruction',
                                ])!!}
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td rowspan="4"><strong>Colors</strong></td>
                                            <td>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>Roof:</strong></span>
                                                    </div>
                                                    {!! Form::text('color_roof', $order->color_roof, ['class' => 'form-control', 'disabled'=>true]) !!}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>Sides:</strong></span>
                                                    </div>
                                                    {!! Form::text('color_sides', $order->color_sides, ['class' => 'form-control', 'disabled'=>true]) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>Ends:</strong></span>
                                                    </div>
                                                    {!! Form::text('color_ends', $order->color_ends, ['class' => 'form-control', 'disabled'=>true]) !!}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>Trim:</strong></span>
                                                    </div>
                                                    {!! Form::text('color_trim', $order->color_trim, ['class' => 'form-control', 'disabled'=>true]) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td><strong>Installation</strong></td>
                                            <td colspan="2">
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_ground" class="form-check-label" >
                                                            @if ($order->installation == "Ground")
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Ground" checked disabled/>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Ground" disabled/>
                                                            @endif
                                                            Ground
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_cement" class="form-check-label" >
                                                            @if ($order->installation == "Cement")
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Cement" checked disabled/>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Cement" disabled/>
                                                            @endif
                                                            Cement
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_asphalt" class="form-check-label" >
                                                            @if ($order->installation == "Asphalt")
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Asphalt" checked disabled/>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Asphalt" disabled/>
                                                            @endif
                                                            Asphalt
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <div class="input-group input-group-sm mb-3">
                                                            <label for="check_other" class="form-check-label" >
                                                                @if ($order->installation == "Other")
                                                                    <input type="radio" class="form-check-input" name="installation" id="installation" value="Other" checked disabled/>
                                                                @else
                                                                    <input type="radio" class="form-check-input" name="installation" id="installation" value="Other" disabled/>
                                                                @endif
                                                                Other
                                                            </label>
                                                            {!! Form::text('installation_other', $order->installation_other, ['class' => 'form-control', 'disabled'=>true]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Land Level</strong></td>
                                            <td colspan="2">
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_land_yes" class="form-check-label text-sm-left" >
                                                            @if ($order->land_level == 1)
                                                                <input type="radio" class="form-check-input" name="land_level" id="land_level" value="1" checked disabled>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="land_level" id="land_level" value="1"  disabled>
                                                            @endif
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_land_no" class="form-check-label" >
                                                            @if ($order->land_level == 2)
                                                                <input type="radio" class="form-check-input" name="land_level" id="land_level" value="2" checked disabled>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="land_level" id="land_level" value="2" disabled>
                                                            @endif
                                                            No (Building will be installed "as is")
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Electricity</strong></td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_electricity_yes" class="form-check-label" >
                                                            @if ($order->electricity == 1)
                                                                <input type="radio" class="form-check-input" name="electricity" id="electricity" value="1" checked disabled>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="electricity" id="electricity" value="1" disabled>
                                                            @endif
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_electricity_no" class="form-check-label" >
                                                            @if ($order->electricity == 2)
                                                                <input type="radio" class="form-check-input" name="electricity" id="electricity" value="2" checked disabled>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="electricity" id="electricity" value="2" disabled>
                                                            @endif
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>Payment:</span>
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_cash" class="form-check-label" >
                                                            @if ($order->payment == "Cash")
                                                                <input type="radio" class="form-check-input" name="payment" id="payment" value="1" checked disabled>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="payment" id="payment" value="1" disabled>
                                                            @endif
                                                            Cash
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_cash" class="form-check-label" >
                                                            @if ($order->payment == "Check")
                                                                <input type="radio" class="form-check-input" name="payment" id="payment" value="2" checked disabled>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="payment" id="payment" value="2" disabled>
                                                            @endif
                                                            Check
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_cash" class="form-check-label" >
                                                            <input type="radio" class="form-check-input" name="payment" id="payment" value="3">
                                                            CC
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label for="check_cash" class="form-check-label" >
                                                            @if ($order->payment == "P.O.")
                                                                <input type="radio" class="form-check-input" name="payment" id="payment" value="4" checked disabled>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="payment" id="payment" value="4" disabled>
                                                            @endif
                                                            P.O.
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Buyer:</span>
                                    </div>
                                    {!! Form::text('buyer_signature', $order->buyer_signature, ['class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Date:</span>
                                    </div>
                                    {!! Form::text('buyer_signature_date', $order->buyer_signature_date, ['class' => 'datepicker-default form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Contractor Name:</span>
                                    </div>
                                    {!! Form::text('contractor_signature', $order->contractor_signature, ['class' => 'form-control' ,'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Date:</span>
                                    </div>
                                    {!! Form::text('contractor_signature_date', $order->contractor_signature_date, ['class' => 'datepicker-default form-control', 'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::button('Save', ['class' => 'btn btn-primary', 'id' => 'save']) !!}
                        <a href="{{ route('orders.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Item</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Item:</strong></span>
                            </div>
                            {!! Form::text('input_item', null, ['class' => 'form-control', 'id' => 'input_item', 'required'=>'required']) !!}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Description:</strong></span>
                            </div>
                            {!! Form::text('input_description', null, ['class' => 'form-control', 'id' => 'input_description', 'required'=>'required']) !!}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Amount:</strong></span>
                            </div>
                            {!! Form::number('amount', null, ['class' => 'form-control', 'id'=>'input_amount', 'required'=>'required']) !!}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Price:</strong></span>
                            </div>
                            {!! Form::number('input_price', null, ['class' => 'form-control', 'id' => 'input_price', 'required'=>'required', 'onchange'=>'precioTotalItems()']) !!}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Measure:</strong></span>
                            </div>
                            {!! Form::select('measure', ['Mile'=>'Mile', 'Unit'=>'Unit', 'foot'=>'foot', 'Inch'=>'Inch', 'Pounds'=>'Pounds', 'Others'=>'Others'], null, ['class' => 'form-control', 'id' => 'input_measure', 'required'=>'required']); !!}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Total:</strong></span>
                            </div>
                            {!! Form::number('total_item', null, ['class' => 'form-control', 'id' => 'input_total_item', 'readonly'=>true]); !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_create_item" class="btn btn-success light" onclick="addRow('table_item')">Create</button>
                    <button type="button" id="btn_edit_item" class="btn btn-success light" style="display:none">Editar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

    </div>
@endsection

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $order->user_id }}</p>
</div>


<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $order->status }}</p>
</div>

<!-- Dealer Field -->
<div class="col-sm-12">
    {!! Form::label('dealer', 'Dealer:') !!}
    <p>{{ $order->dealer }}</p>
</div>

<!-- Dealer Country Field -->
<div class="col-sm-12">
    {!! Form::label('dealer_country', 'Dealer Country:') !!}
    <p>{{ $order->dealer_country }}</p>
</div>

<!-- Dealer Phone Field -->
<div class="col-sm-12">
    {!! Form::label('dealer_phone', 'Dealer Phone:') !!}
    <p>{{ $order->dealer_phone }}</p>
</div>

<!-- Buyer Name Field -->
<div class="col-sm-12">
    {!! Form::label('buyer_name', 'Buyer Name:') !!}
    <p>{{ $order->buyer_name }}</p>
</div>

<!-- Buyer Address Field -->
<div class="col-sm-12">
    {!! Form::label('buyer_address', 'Buyer Address:') !!}
    <p>{{ $order->buyer_address }}</p>
</div>

<!-- City Field -->
<div class="col-sm-12">
    {!! Form::label('city', 'City:') !!}
    <p>{{ $order->city }}</p>
</div>

<!-- State Field -->
<div class="col-sm-12">
    {!! Form::label('state', 'State:') !!}
    <p>{{ $order->state }}</p>
</div>

<!-- Zip Field -->
<div class="col-sm-12">
    {!! Form::label('zip', 'Zip:') !!}
    <p>{{ $order->zip }}</p>
</div>

<!-- Phone Day Field -->
<div class="col-sm-12">
    {!! Form::label('phone_day', 'Phone Day:') !!}
    <p>{{ $order->phone_day }}</p>
</div>

<!-- Phone Evening Field -->
<div class="col-sm-12">
    {!! Form::label('phone_evening', 'Phone Evening:') !!}
    <p>{{ $order->phone_evening }}</p>
</div>

<!-- Phone Cell Field -->
<div class="col-sm-12">
    {!! Form::label('phone_cell', 'Phone Cell:') !!}
    <p>{{ $order->phone_cell }}</p>
</div>

<!-- Installation Site Field -->
<div class="col-sm-12">
    {!! Form::label('installation_site', 'Installation Site:') !!}
    <p>{{ $order->installation_site }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $order->email }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $order->description }}</p>
</div>

<!-- Width Field -->
<div class="col-sm-12">
    {!! Form::label('width', 'Width:') !!}
    <p>{{ $order->width }}</p>
</div>

<!-- Roof Length Field -->
<div class="col-sm-12">
    {!! Form::label('roof_length', 'Roof Length:') !!}
    <p>{{ $order->roof_length }}</p>
</div>

<!-- Frame Length Field -->
<div class="col-sm-12">
    {!! Form::label('frame_length', 'Frame Length:') !!}
    <p>{{ $order->frame_length }}</p>
</div>

<!-- Leg Height Field -->
<div class="col-sm-12">
    {!! Form::label('leg_height', 'Leg Height:') !!}
    <p>{{ $order->leg_height }}</p>
</div>

<!-- Gauge Field -->
<div class="col-sm-12">
    {!! Form::label('gauge', 'Gauge:') !!}
    <p>{{ $order->gauge }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $order->price }}</p>
</div>

<!-- Regular Frame Field -->
<div class="col-sm-12">
    {!! Form::label('regular_frame', 'Regular Frame:') !!}
    <p>{{ $order->regular_frame }}</p>
</div>

<!-- A Frame Field -->
<div class="col-sm-12">
    {!! Form::label('a_frame', 'A Frame:') !!}
    <p>{{ $order->a_frame }}</p>
</div>

<!-- Vertical Roof Field -->
<div class="col-sm-12">
    {!! Form::label('vertical_roof', 'Vertical Roof:') !!}
    <p>{{ $order->vertical_roof }}</p>
</div>

<!-- All Vertical Field -->
<div class="col-sm-12">
    {!! Form::label('all_vertical', 'All Vertical:') !!}
    <p>{{ $order->all_vertical }}</p>
</div>

<!-- Color Roof Field -->
<div class="col-sm-12">
    {!! Form::label('color_roof', 'Color Roof:') !!}
    <p>{{ $order->color_roof }}</p>
</div>

<!-- Color Ends Field -->
<div class="col-sm-12">
    {!! Form::label('color_ends', 'Color Ends:') !!}
    <p>{{ $order->color_ends }}</p>
</div>

<!-- Color Sides Field -->
<div class="col-sm-12">
    {!! Form::label('color_sides', 'Color Sides:') !!}
    <p>{{ $order->color_sides }}</p>
</div>

<!-- Color Trim Field -->
<div class="col-sm-12">
    {!! Form::label('color_trim', 'Color Trim:') !!}
    <p>{{ $order->color_trim }}</p>
</div>

<!-- Installation Field -->
<div class="col-sm-12">
    {!! Form::label('installation', 'Installation:') !!}
    <p>{{ $order->installation }}</p>
</div>

<!-- Installation Other Field -->
<div class="col-sm-12">
    {!! Form::label('installation_other', 'Installation Other:') !!}
    <p>{{ $order->installation_other }}</p>
</div>

<!-- Land Level Field -->
<div class="col-sm-12">
    {!! Form::label('land_level', 'Land Level:') !!}
    <p>{{ $order->land_level }}</p>
</div>

<!-- Electricity Field -->
<div class="col-sm-12">
    {!! Form::label('electricity', 'Electricity:') !!}
    <p>{{ $order->electricity }}</p>
</div>

<!-- Payment Field -->
<div class="col-sm-12">
    {!! Form::label('payment', 'Payment:') !!}
    <p>{{ $order->payment }}</p>
</div>

<!-- Total Sale Field -->
<div class="col-sm-12">
    {!! Form::label('total_sale', 'Total Sale:') !!}
    <p>{{ $order->total_sale }}</p>
</div>

<!-- Tax Field -->
<div class="col-sm-12">
    {!! Form::label('tax', 'Tax:') !!}
    <p>{{ $order->tax }}</p>
</div>

<!-- Tax Exempt Field -->
<div class="col-sm-12">
    {!! Form::label('tax_exempt', 'Tax Exempt:') !!}
    <p>{{ $order->tax_exempt }}</p>
</div>

<!-- Non Tax Contractor Fee Field -->
<div class="col-sm-12">
    {!! Form::label('non_tax_contractor_fee', 'Non Tax Contractor Fee:') !!}
    <p>{{ $order->non_tax_contractor_fee }}</p>
</div>

<!-- Total Field -->
<div class="col-sm-12">
    {!! Form::label('total', 'Total:') !!}
    <p>{{ $order->total }}</p>
</div>

<!-- Dealer Deposit Field -->
<div class="col-sm-12">
    {!! Form::label('dealer_deposit', 'Dealer Deposit:') !!}
    <p>{{ $order->dealer_deposit }}</p>
</div>

<!-- Amount Paid Field -->
<div class="col-sm-12">
    {!! Form::label('amount_paid', 'Amount Paid:') !!}
    <p>{{ $order->amount_paid }}</p>
</div>

<!-- Balance Due Field -->
<div class="col-sm-12">
    {!! Form::label('balance_due', 'Balance Due:') !!}
    <p>{{ $order->balance_due }}</p>
</div>

<!-- Buyer Signature Field -->
<div class="col-sm-12">
    {!! Form::label('buyer_signature', 'Buyer Signature:') !!}
    <p>{{ $order->buyer_signature }}</p>
</div>

<!-- Buyer Signature Date Field -->
<div class="col-sm-12">
    {!! Form::label('buyer_signature_date', 'Buyer Signature Date:') !!}
    <p>{{ $order->buyer_signature_date }}</p>
</div>

<!-- Contractor Signature Field -->
<div class="col-sm-12">
    {!! Form::label('contractor_signature', 'Contractor Signature:') !!}
    <p>{{ $order->contractor_signature }}</p>
</div>

<!-- Contractor Signature Date Field -->
<div class="col-sm-12">
    {!! Form::label('contractor_signature_date', 'Contractor Signature Date:') !!}
    <p>{{ $order->contractor_signature_date }}</p>
</div>

