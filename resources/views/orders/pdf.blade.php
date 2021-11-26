<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
<!-- <title>{{ config('app.name') }}</title> -->
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/AAMBS/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist.min.css' )}}">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="http://orders.test/assets/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .btn-danger{
            background-color: red !important;
            color: white !important;
        }
    </style>
</head>
<body>
<div class="container-fluid">
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
                                        {{env('APP_URL') }}}}
                                        <img class="logo-abbr mr-2" src="{{ public_path('images/logo.png') }}" alt="">
                                        <img class="logo-compact" src="./public/assets/images/logo-text.png" alt="">
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
                                {!! Form::number('invoice', $data['order']['invoice'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Order Date</span>
                                </div>
                                <input name="order_date" class="datepicker-default form-control" id="order_date" value="{{$data['order']['order_date']}}" disabled/>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Installed Date</span>
                                </div>
                                <input name="installed_date" class="datepicker-default form-control" id="installed_date" value="{{$data['order']['installed_date']}}" disabled/>
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
                                        @if ($data['order']['status'] == "Quote")
                                            <input type="radio" class="form-check-input" name="status" id="status_quote" value="Quote" checked disabled>
                                        @else
                                            <input type="radio" class="form-check-input" name="status" id="status_quote" value="Quote" disabled>
                                        @endif
                                        Quote
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="status_shop">
                                        @if ($data['order']['status'] == "In Shop")
                                            <input type="radio" class="form-check-input" name="status" id="status_shop" value="In Shop" checked disabled>
                                        @else
                                            <input type="radio" class="form-check-input" name="status" id="status_shop" value="In Shop" disabled>
                                        @endif
                                        In Shop
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="status_installation">
                                        @if ($data['order']['status'] == "Installation")
                                            <input type="radio" class="form-check-input" name="status" id="status_installation" value="Installation" checked disabled>
                                        @else
                                            <input type="radio" class="form-check-input" name="status" id="status_installation" value="Installation" disabled>
                                        @endif
                                        Installation
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="status_installed">
                                        @if ($data['order']['status'] == "Installed")
                                            <input type="radio" class="form-check-input" name="status" id="status_installed" value="Installed" checked disabled>
                                        @else
                                            <input type="radio" class="form-check-input" name="status" id="status_installed" value="Installed" disabled>
                                        @endif
                                        Installed
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="status_cancel">
                                        @if ($data['order']['status'] == "Cancel")
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
                                {!! Form::text('dealer', $data['order']['dealer'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>Country:</strong></span>
                                </div>
                                {!! Form::text('dealer_country', $data['order']['dealer_country'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>Phone:</strong></span>
                                </div>
                                {!! Form::number('dealer_phone', $data['order']['dealer_phone'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>Buyer Name(s):</strong></span>
                                </div>
                                {!! Form::text('buyer_name', $data['order']['buyer_name'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>Buyer Address:</strong></span>
                                </div>
                                {!! Form::text('buyer_address', $data['order']['buyer_address'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>City:</strong></span>
                                </div>
                                {!! Form::text('city', $data['order']['city'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>State:</strong></span>
                                </div>
                                {!! Form::text('state', $data['order']['state'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>Zip:</strong></span>
                                </div>
                                {!! Form::text('zip', $data['order']['zip'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>Phone(Day):</strong></span>
                                </div>
                                {!! Form::number('phone_day', $data['order']['phone_day'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>(Evening):</strong></span>
                                </div>
                                {!! Form::number('phone_evening', $data['order']['phone_evening'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>(Cell):</strong></span>
                                </div>
                                {!! Form::number('phone_cell', $data['order']['phone_cell'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>Installation Site:</strong></span>
                                </div>
                                {!! Form::text('installation_site', $data['order']['installation_site'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size:medium;"><strong>Email Address:</strong></span>
                                </div>
                                {!! Form::text('email', $data['order']['email'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>
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
                                    @foreach($data['items'] as $item)
                                        <tr>
                                            <td>{{$item['item']}}</td>
                                            <td>{{$item['description']}}</td>
                                            <td>{{$item['price']}}</td>
                                            <td>{{$item['amount']}}</td>
                                            <td>{{$item['price']*$item['amount']}}</td>
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
                                                {!! Form::number('total_sale', $data['order']['total_sale'], ['class' => 'form-control', 'id' => 'total_sale', 'readonly' => true]) !!}
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
                                                {!! Form::number('tax', $data['order']['tax'], ['class' => 'form-control', 'id' => 'tax', 'onchange' => 'calculaTotal()', 'disabled'=>true ]) !!}
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
                                                {!! Form::number('tax_exempt', $data['order']['tax_exempt'], ['class' => 'form-control', 'id' => 'tax_exempt', 'disabled'=>true]) !!}
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
                                                {!! Form::text('non_tax_contractor_fee', $data['order']['non_tax_contractor_fee'], ['class' => 'form-control', 'id' => 'contractor_fee', 'disabled'=>true]) !!}
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
                                                {!! Form::number('total', $data['order']['total'], ['name' =>'total', 'class' => 'form-control', 'id' => 'total_order', 'readonly' => 'true']) !!}
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
                                                {!! Form::number('dealer_deposit', $data['order']['dealer_deposit'], ['class' => 'form-control', 'id' => 'dealer_deposit', 'disabled'=>true]) !!}
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
                                                {!! Form::number('amount_paid', $data['order']['amount_paid'], ['class' => 'form-control', 'id' => 'amount_paid', 'disabled'=>true]) !!}
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
                                                {!! Form::number('balance_due', $data['order']['balance_due'], ['class' => 'form-control', 'id' => 'balance_due', 'disabled'=>true]) !!}
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
                                                {!! Form::text('color_roof', $data['order']['color_roof'], ['class' => 'form-control', 'disabled'=>true]) !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><strong>Sides:</strong></span>
                                                </div>
                                                {!! Form::text('color_sides', $data['order']['color_sides'], ['class' => 'form-control', 'disabled'=>true]) !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><strong>Ends:</strong></span>
                                                </div>
                                                {!! Form::text('color_ends', $data['order']['color_ends'], ['class' => 'form-control', 'disabled'=>true]) !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><strong>Trim:</strong></span>
                                                </div>
                                                {!! Form::text('color_trim', $data['order']['color_trim'], ['class' => 'form-control', 'disabled'=>true]) !!}
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
                                                        @if ($data['order']['installation'] == "Ground")
                                                            <input type="radio" class="form-check-input" name="installation" id="installation" value="Ground" checked disabled/>
                                                        @else
                                                            <input type="radio" class="form-check-input" name="installation" id="installation" value="Ground" disabled/>
                                                        @endif
                                                        Ground
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label for="check_cement" class="form-check-label" >
                                                        @if ($data['order']['installation'] == "Cement")
                                                            <input type="radio" class="form-check-input" name="installation" id="installation" value="Cement" checked disabled/>
                                                        @else
                                                            <input type="radio" class="form-check-input" name="installation" id="installation" value="Cement" disabled/>
                                                        @endif
                                                        Cement
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label for="check_asphalt" class="form-check-label" >
                                                        @if ($data['order']['installation'] == "Asphalt")
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
                                                            @if ($data['order']['installation'] == "Other")
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Other" checked disabled/>
                                                            @else
                                                                <input type="radio" class="form-check-input" name="installation" id="installation" value="Other" disabled/>
                                                            @endif
                                                            Other
                                                        </label>
                                                        {!! Form::text('installation_other', $data['order']['installation_other'], ['class' => 'form-control', 'disabled'=>true]) !!}
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
                                                        @if ($data['order']['land_level'] == 1)
                                                            <input type="radio" class="form-check-input" name="land_level" id="land_level" value="1" checked disabled>
                                                        @else
                                                            <input type="radio" class="form-check-input" name="land_level" id="land_level" value="1"  disabled>
                                                        @endif
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label for="check_land_no" class="form-check-label" >
                                                        @if ($data['order']['land_level'] == 2)
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
                                                        @if ($data['order']['land_level'] == 1)
                                                            <input type="radio" class="form-check-input" name="electricity" id="electricity" value="1" checked disabled>
                                                        @else
                                                            <input type="radio" class="form-check-input" name="electricity" id="electricity" value="1" disabled>
                                                        @endif
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label for="check_electricity_no" class="form-check-label" >
                                                        @if ($data['order']['land_level'] == 2)
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
                                                        @if ($data['order']['payment'] == "Cash")
                                                            <input type="radio" class="form-check-input" name="payment" id="payment" value="1" checked disabled>
                                                        @else
                                                            <input type="radio" class="form-check-input" name="payment" id="payment" value="1" disabled>
                                                        @endif
                                                        Cash
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label for="check_cash" class="form-check-label" >
                                                        @if ($data['order']['payment'] == "Check")
                                                            <input type="radio" class="form-check-input" name="payment" id="payment" value="2" checked disabled>
                                                        @else
                                                            <input type="radio" class="form-check-input" name="payment" id="payment" value="2" disabled>
                                                        @endif
                                                        Check
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label for="check_cash" class="form-check-label" >
                                                        @if ($data['order']['payment'] == "P.O.")
                                                            <input type="radio" class="form-check-input" name="payment" id="payment" value="3" checked disabled>
                                                        @else
                                                            <input type="radio" class="form-check-input" name="payment" id="payment" value="3" disabled>
                                                        @endif
                                                        CC
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label for="check_cash" class="form-check-label" >
                                                        @if ($data['order']['payment'] == "P.O.")
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
                                {!! Form::text('buyer_signature', $data['order']['buyer_signature'], ['class' => 'form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Date:</span>
                                </div>
                                {!! Form::text('buyer_signature_date', $data['order']['buyer_signature_date'], ['class' => 'datepicker-default form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Contractor Name:</span>
                                </div>
                                {!! Form::text('contractor_signature', $data['order']['contractor_signature'], ['class' => 'form-control' ,'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Date:</span>
                                </div>
                                {!! Form::text('contractor_signature_date', $data['order']['contractor_signature_date'], ['class' => 'datepicker-default form-control', 'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {!! Form::button('Imprimir', ['class' => 'btn btn-primary', 'id' => 'save']) !!}
                    <a href="{{ route('orders.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<!--**********************************
Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/js/deznav-init.js') }}"></script>
</body>
</html>


