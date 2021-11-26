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
                                    {!! Form::number('invoice', old('invoice'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Order Date</span>
                                    </div>
                                    <input name="order_date" class="datepicker-default form-control" id="order_date"/>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Installed Date</span>
                                    </div>
                                    <input name="installed_date" class="datepicker-default form-control" id="installed_date"/>
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
                                            <input type="radio" class="form-check-input" name="status" id="status_quote" value="Quote">
                                            Quote
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="status_shop">
                                            <input type="radio" class="form-check-input" name="status" id="status_shop" value="In Shop">
                                            In Shop
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="status_installation">
                                            <input type="radio" class="form-check-input" name="status" id="status_installation" value="Installation">
                                            Installation
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="status_installed">
                                            <input type="radio" class="form-check-input" name="status" id="status_installed" value="Installed">
                                            Installed
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="status_cancel">
                                            <input type="radio" class="form-check-input" name="status" id="status_installed" value="Cancel">
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
                                    {!! Form::text('dealer', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Country:</strong></span>
                                    </div>
                                    {!! Form::text('dealer_country', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Phone:</strong></span>
                                    </div>
                                    {!! Form::number('dealer_phone', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Buyer Name(s):</strong></span>
                                    </div>
                                    {!! Form::text('buyer_name', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Buyer Address:</strong></span>
                                    </div>
                                    {!! Form::text('buyer_address', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>City:</strong></span>
                                    </div>
                                    {!! Form::text('city', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>State:</strong></span>
                                    </div>
                                    {!! Form::text('state', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Zip:</strong></span>
                                    </div>
                                    {!! Form::text('zip', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Phone(Day):</strong></span>
                                    </div>
                                    {!! Form::number('phone_day', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>(Evening):</strong></span>
                                    </div>
                                    {!! Form::number('phone_evening', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>(Cell):</strong></span>
                                    </div>
                                    {!! Form::number('phone_cell', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Installation Site:</strong></span>
                                    </div>
                                    {!! Form::text('installation_site', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:medium;"><strong>Email Address:</strong></span>
                                    </div>
                                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
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
                                                    {!! Form::number('total_sale', null, ['class' => 'form-control', 'id' => 'total_sale', 'readonly' => true]) !!}
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
                                                    {!! Form::number('tax', null, ['class' => 'form-control', 'id' => 'tax', 'onchange' => 'calculaTotal()' ]) !!}
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
                                                    {!! Form::number('tax_exempt', null, ['class' => 'form-control', 'id' => 'tax_exempt']) !!}
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
                                                    {!! Form::text('non_tax_contractor_fee', null, ['class' => 'form-control', 'id' => 'contractor_fee']) !!}
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
                                                    {!! Form::number('total', null, ['name' =>'total', 'class' => 'form-control', 'id' => 'total_order', 'readonly' => 'true']) !!}
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
                                                    {!! Form::number('dealer_deposit', null, ['class' => 'form-control', 'id' => 'dealer_deposit']) !!}
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
                                                    {!! Form::number('amount_paid', null, ['class' => 'form-control', 'id' => 'amount_paid']) !!}
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
                                                    {!! Form::number('balance_due', null, ['class' => 'form-control', 'id' => 'balance_due']) !!}
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
                                                    {!! Form::text('color_roof', null, ['class' => 'form-control']) !!}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>Sides:</strong></span>
                                                    </div>
                                                    {!! Form::text('color_sides', null, ['class' => 'form-control']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>Ends:</strong></span>
                                                    </div>
                                                    {!! Form::text('color_ends', null, ['class' => 'form-control']) !!}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><strong>Trim:</strong></span>
                                                    </div>
                                                    {!! Form::text('color_trim', null, ['class' => 'form-control']) !!}
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
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Ground"/>
                                                                Ground
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label for="check_cement" class="form-check-label" >
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Cement"/>
                                                                Cement
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label for="check_asphalt" class="form-check-label" >
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Asphalt"/>
                                                                Asphalt
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">

                                                            <div class="input-group input-group-sm mb-3">
                                                                <label for="check_other" class="form-check-label" >
                                                                    <input type="radio" class="form-check-input" name="installation" id="installation" value="Other"/>
                                                                    Other
                                                                </label>
                                                                {!! Form::text('installation_other', null, ['class' => 'form-control']) !!}
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
                                                                <input type="radio" class="form-check-input" name="land_level" id="land_level" value="1">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label for="check_land_no" class="form-check-label" >
                                                                <input type="radio" class="form-check-input" name="land_level" id="land_level" value="2">
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
                                                                <input type="radio" class="form-check-input" name="electricity" id="electricity" value="1">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label for="check_electricity_no" class="form-check-label" >
                                                                <input type="radio" class="form-check-input" name="electricity" id="electricity" value="2">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span>Payment:</span>
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <label for="check_cash" class="form-check-label" >
                                                                <input type="radio" class="form-check-input" name="payment" id="payment" value="1">
                                                                Cash
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label for="check_cash" class="form-check-label" >
                                                                <input type="radio" class="form-check-input" name="payment" id="payment" value="2">
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
                                                                <input type="radio" class="form-check-input" name="payment" id="payment" value="4">
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
                                    {!! Form::text('buyer_signature', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Date:</span>
                                    </div>
                                    {!! Form::text('buyer_signature_date', null, ['class' => 'datepicker-default form-control']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Contractor Name:</span>
                                    </div>
                                    {!! Form::text('contractor_signature', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Date:</span>
                                    </div>
                                    {!! Form::text('contractor_signature_date', null, ['class' => 'datepicker-default form-control']) !!}
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

@push('page_scripts')
<!-- <script src="{{ asset('assets/js/plugins-init/pickadate-init.js') }}"></script> -->
<!-- Pickdate -->
<script src="{{ asset('assets/vendor/pickadate/picker.js') }}"></script>
<script src="{{ asset('assets/vendor/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('assets/vendor/pickadate/picker.date.js') }}"></script>
<!-- Pickdate -->
<script src="{{ asset('assets/js/plugins-init/pickadate-init.js') }}"></script>
<script>
    let items = [];
    let valorId = 1;
    let totalSale = 0;
    $("#save").on('click', null, function (event) {
        //console.log($('#form_order').serialize());
        console.log($('#form_order').serialize() + '&' + $.param(items));
        console.log("items:");
        console.log(items);
        $.ajax({
            method: "POST",
            url: "{{route('orders.store')}}",
            data: $('#form_order').serialize() + '&items=' + JSON.stringify(items),
            dataType: 'json'
        }).done(function( response ) {
            window.location.href = "{{route('orders.index')}}";
        });
    });
//CLEAR MODAL
$('#exampleModalCenter').on('show.bs.modal', function (event) {
    $("#exampleModalCenter input").val("");
    $("#btn_create_item").show();
    $("#btn_edit_item").hide();
});

$(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        let borra = $(this)[0].id;

        for (const i in items) {
            if(items[i]['id'] === Number.parseInt(borra) ){
                totalSale = totalSale - Number.parseFloat(items[i]['price']);
                items.splice(i, 1);
            }

        }
        $("#total_sale").val(totalSale);

        $(this).closest('tr').remove();

    });

function addRow(tableID) {
    let item = $("#input_item").val();
    let description = $("#input_description").val();
    let price = $("#input_price").val();
    let amount = $("#input_amount").val();
    let total = $("#input_total_item").val();
    let measure = $("#input_measure").val();
    let tax = $("#tax").val();

    if (item === "" || description === "" || price <= 0 ){
        return;
    }

    if(items.length > 0){
        valorId = valorId+1
    }
    items.push({
        "id": valorId,
        "item": item,
        "description": description,
        "amount": amount,
        "price": price,
        "measure": measure,
        "total": total
    });

    // Obtiene una referencia a la tabla
    var tableRef = document.getElementById(tableID);
    // Inserta una fila en la tabla, en el índice 0
    var newRow   = tableRef.insertRow(items.length-1);
    // Inserta una celda en la fila, en el índice 0
    //var celdaCero  = newRow.insertCell(0);
    var celdaUno  = newRow.insertCell(0);
    var celdaDos  = newRow.insertCell(1);
    var celdaTres  = newRow.insertCell(2);
    var celdaCuatro  = newRow.insertCell(3);
    var celdaCinco  = newRow.insertCell(4);

    var celdaSeis  = newRow.insertCell(5);
    var celdaSiete  = newRow.insertCell(6);
    // Añade un nodo de texto a la celda


    var textCeldaUno  = document.createElement("LABEL");
    textCeldaUno.innerText = items[items.length-1]['item'];
    textCeldaUno.id="item_"+valorId;

    var textCeldaDos  = document.createElement("LABEL");
    textCeldaDos.innerText = items[items.length-1]['description'];
    textCeldaDos.id="description_"+valorId;

    var textCeldaTres  = document.createElement("LABEL");
    textCeldaTres.innerText = items[items.length-1]['price'];
    textCeldaTres.id="price_"+valorId;

    var textCeldaCuatro  = document.createElement("LABEL");
    textCeldaCuatro.innerText = items[items.length-1]['amount'];
    textCeldaCuatro.id="amount_"+valorId;

    var textCeldaCinco  = document.createElement("LABEL");
    textCeldaCinco.innerText = items[items.length-1]['total'];
    textCeldaCinco.id="total_"+valorId;

    var textCeldaSeis  = document.createElement("BUTTON");
    var textCeldaSiete = document.createElement("a");

    textCeldaSeis.className = "borrar btn btn-square btn-danger";
    textCeldaSeis.innerText = "Delete";
    textCeldaSeis.id=valorId;

    textCeldaSiete.className = "btn btn-square btn-primary";
    textCeldaSiete.innerText = "Edit";
    textCeldaSiete.id = "edit_"+valorId;

    textCeldaSiete.addEventListener('click', function(){
        $("#exampleModalCenter").modal("show");
        let editRow = $(this)[0].id;
        let arrayEdit = editRow.split("_");

        function valores(valor) {
            return valor.id === Number.parseInt(arrayEdit[1]);
        }

        let id = items.find(valores).id;
        $("#input_item").val(items.find(valores).item);
        $("#input_description").val(items.find(valores).description);
        $("#input_price").val(items.find(valores).price);
        $("#input_amount").val(items.find(valores).amount);
        $("#input_total_item").val(items.find(valores).total);
        $("#btn_create_item").hide();
        $("#btn_edit_item").show();
        let btnCreat = document.getElementById('btn_edit_item');
        //btnCreat.onclick = editItem(items.find(valores).id);
        btnCreat.setAttribute('onclick', "editItem("+id+")");
        //btnCreat.addEventListener('click', editItem(id));

    });

    celdaUno.appendChild(textCeldaUno);
    celdaDos.appendChild(textCeldaDos);
    celdaTres.appendChild(textCeldaTres);
    celdaCuatro.appendChild(textCeldaCuatro);
    celdaCinco.appendChild(textCeldaCinco);
    celdaSeis.appendChild(textCeldaSeis);
    celdaSiete.appendChild(textCeldaSiete);

    totalSale = totalSale + Number.parseFloat(items[items.length-1]['total']);
    //contractor_fee=totalSale +

    $("#total_sale").val(totalSale);
    $("#exampleModalCenter").modal('hide');

}

function editItem(id) {
    let elem = Number.parseInt(id);
    totalSale = 0;
    for (const i in items) {
        if(items[i]['id'] === Number.parseInt(id)){
            items[i]['item'] = $("#input_item").val();
            items[i]['description'] = $("#input_description").val();
            items[i]['price'] = $("#input_price").val();
            items[i]['total'] = $("#input_total_item").val();

            $("#item_"+elem).text(items[i]['item']);
            $("#description_"+elem).text(items[i]['description']);
            $("#price_"+elem).text(items[i]['price']);
            $("#amount_"+elem).val(items[i]['amount']);
            $("#total_"+elem).val(items[i]['total']);

        }
        console.log(items[i]['total']);
        totalSale = totalSale + Number.parseFloat(items[i]['total']);
    }
    $("#total_sale").val(totalSale);
    $("#exampleModalCenter").modal("hide");
}

function calculaTotal() {
    let tax = $("#tax").val();
    let totalSale = Number.parseFloat($("#total_sale").val());
    let porcentajeTax = (totalSale*tax)/100;
    porcentajeTax = Number.parseFloat(porcentajeTax);
    let totalOrder = totalSale + porcentajeTax;
    $("#total_order").val(totalOrder);
    //$("#total").val(totalOrder);
}

function precioTotalItems() {
    let amount = $("#input_amount").val();
    let price = $("#input_price").val();
    let sum = amount * price;

    $("#input_total_item").val(sum);
}
// Llama a addRow() con el ID de la tabla
</script>
@endpush

