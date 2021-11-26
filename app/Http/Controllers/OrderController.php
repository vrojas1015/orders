<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;
use App\Repositories\ItemRepository;
use App\Http\Controllers\AppBaseController;
use PDF;
use Mpdf\Mpdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Facade\FlareClient\Http\Response;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;
    private $itemRepository;

    public function __construct(OrderRepository $orderRepo, ItemRepository  $itemRepository)
    {
        $this->orderRepository = $orderRepo;
        $this->itemRepository = $itemRepository;
    }

    public function index(Request $request)
    {
        $orders = $this->orderRepository->all();

        return view('orders.index')
            ->with('orders', $orders);
    }


    public function create()
    {
        return view('orders.create');
    }


    public function store(Request $request)
    {
        $items = json_decode($request->items);

        if(isset($request->regular_frame)){
            if( $request->regular_frame === "on"){
                $request->regular_frame = true;
            }else{
                //array_push($request, 'regular_frame');
                $request->regular_frame = false;
            }
        }else{
            $request->request->regular_frame = false;
        }

        if (isset($request->a_frame)) {
            if($request->a_frame == "on"){
                $request->a_frame = true;
            }else{
                $request->a_frame = false;
            }
        }else {
            $request->a_frame = false;
        }

        if($request->vertical_roof == "on"){
            $request->vertical_roof = true;
        }else{
            $request->vertical_roof = false;
        }
        if($request->all_vertical == "on"){
            $request->all_vertical = true;
        }else{
            $request->all_vertical = false;
        }
        if($request->installation == "Other"){
            $ruleInstallationOther = 'required|string|max:255';
        }else{
            $ruleInstallationOther = '';
        }

        $rules = $request->validate([
            'user_id' => 'required',
            'invoice' => 'required|integer',
            'order_date' => 'required',
            'installed_date' => 'required',
            'status' => 'required|string',
            'dealer' => 'required|string|max:255',
            'dealer_country' => 'required|string|max:255',
            'dealer_phone' => 'required|integer',
            'buyer_name' => 'required|string|max:255',
            'buyer_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|integer',
            'phone_day' => 'required|integer',
            'phone_evening' => 'required|integer',
            'phone_cell' => 'required|integer',
            'installation_site' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            //'description' => 'required|string|max:255',
            //'width' => 'required|numeric',
            //'roof_length' => 'required|numeric',
            //'frame_length' => 'required|numeric',
            //'leg_height' => 'required|numeric',
            //'gauge' => 'required|integer',
            //'price' => 'required|numeric',
            //'regular_frame' => 'required',
            //'a_frame' => 'required',
            //'vertical_roof' => 'required',
            //'all_vertical' => 'required',
            'color_roof' => 'required|string|max:255',
            'color_ends' => 'required|string|max:255',
            'color_sides' => 'required|string|max:255',
            'color_trim' => 'required|string|max:255',
            'installation' => 'required|string',
            'installation_other' => $ruleInstallationOther,
            'land_level' => 'required',
            'electricity' => 'required',
            'payment' => 'required|string',
            'total_sale' => 'required|numeric',
            'tax' => 'required|numeric',
            'tax_exempt' => 'required|numeric',
            'non_tax_contractor_fee' => 'required|numeric',
            'total' => 'required|numeric',
            'dealer_deposit' => 'required|numeric',
            'amount_paid' => 'required|numeric',
            'balance_due' => 'required|numeric',
            'buyer_signature' => 'required|string|max:255',
            'buyer_signature_date' => 'required',
            'contractor_signature' => 'required|string|max:255',
            'contractor_signature_date' => 'required',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
            'deleted_at' => 'nullable'
        ]);

        $order = $this->orderRepository->create($request->all());
        foreach ($items as $item) {
            $arrayItem = ['order_id'=>2/*$order['id']*/, 'item'=>$item->item, 'description'=>$item->description, 'price'=>$item->price, 'amount'=>$item->amount, 'measure'=>$item->measure];
            $row = $this->itemRepository->create($arrayItem);
        }

        Flash::success('Order saved successfully.');
        return response()->json([
            'msg' => 'Order saved successfully.',
            'error' => false,
        ]);
        //return redirect(route('orders.index'));
    }


    public function show($id)
    {
        $order = $this->orderRepository->find($id);
        $items = $this->itemRepository->detalle($order['id']);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with(['order'=>$order, 'items'=>$items]);
    }


    public function edit($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.edit')->with('order', $order);
    }

    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $order = $this->orderRepository->update($request->all(), $id);

        Flash::success('Order updated successfully.');

        return redirect(route('orders.index'));
    }

    public function destroy($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }

    public function pdf($id)
    {
        $order = $this->orderRepository->find($id);
        $items = $this->itemRepository->detalle($order['id']);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }
        $array_list = [];
        foreach ($items as $item) {
            $array = [
                'item' => $item->item,
                'description' => $item->description,
                'measure' => $item->measure,
                'amount' => $item->amount,
                'price' => $item->price
            ];
            $array_list[] = $array;
        }


        $data = [
            'order' => [
                "id" => $order->id,
                "user_id" => $order->user_id,
                "invoice" => $order->invoice,
                "order_date" => $order->order_date->isoFormat('LL'),
                "installed_date" => $order->installed_date->isoFormat('LL'),
                "status" => $order->status,
                "dealer" => $order->dealer,
                "dealer_country" => $order->dealer_country,
                "dealer_phone" => $order->dealer_phone,
                "buyer_name" => $order->buyer_name,
                "buyer_address" => $order->buyer_address,
                "city" => $order->city,
                "state" => $order->state,
                "zip" => $order->zip,
                "phone_day" => $order->phone_day,
                "phone_evening" => $order->phone_evening,
                "phone_cell" => $order->phone_cell,
                "installation_site" => $order->installation_site,
                "email" => $order->email,
                "color_roof" => $order->color_roof,
                "color_ends" => $order->color_ends,
                "color_sides" => $order->color_sides,
                "color_trim" => $order->color_trim,
                "installation" => $order->installation,
                "installation_other" => $order->installation_other,
                "land_level" => $order->land_level,
                "electricity" => $order->electricity,
                "payment" => $order->payment,
                "total_sale" => $order->total_sale,
                "tax" => $order->tax,
                "tax_exempt" => $order->tax_exempt,
                "non_tax_contractor_fee" => $order->non_tax_contractor_fee,
                "total" => $order->total,
                "dealer_deposit" => $order->dealer_deposit,
                "amount_paid" => $order->amount_paid,
                "balance_due" => $order->balance_due,
                "buyer_signature" => $order->buyer_signature,
                "buyer_signature_date" => $order->buyer_signature_date->isoFormat('LL'),
                "contractor_signature" => $order->contractor_signature,
                "contractor_signature_date" => $order->contractor_signature_date->isoFormat('LL')
            ],
            'items' => $array_list
        ];

        /* $test ='
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
     <style>
         .btn-danger{
             background-color: red !important;
             color: white !important;
         }
     </style>

 </head>
 <body>
 <div class="container-fluid">
     <form method="POST" action="http://orders.test/pdf/5" accept-charset="UTF-8" id="form_order"><input name="_token" type="hidden" value="Hf19TOby9QYSzt4nHDQcc ▶
     <div class="row">
         <div class="col-lg-12">
             <div class="card">
                 <div class="card-body">
                     <div class="row mb-5">
                         <div class="col-4">
                             <div class="row align-items-center">
                                 <div class="col-sm-9 mt-5">
                                     <div class="brand-logo mb-3">
         http://orders.test}}
                                         <img class="logo-abbr mr-2" src="C:\laragon\www\orders\public\images/logo.png" alt="">
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
                             <input class="form-control" name="user_id" type="hidden" value="1">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text">Invoice</span>
                                 </div>
                                 <input class="form-control" disabled name="invoice" type="number" value="6">
                             </div>
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text">Order Date</span>
                                 </div>
                                 <input name="order_date" class="datepicker-default form-control" id="order_date" value="November 6, 2021" disabled/>
                             </div>
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text">Installed Date</span>
                                 </div>
                                 <input name="installed_date" class="datepicker-default form-control" id="installed_date" value="November 13, 2021" disabled/>
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
                                                                                     <input type="radio" class="form-check-input" name="status" id="status_quote" ▶
                                                                                 Quote
                                                                                 </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                     <label class="form-check-label" for="status_shop">
                                                                                     <input type="radio" class="form-check-input" name="status" id="status_shop"  ▶
                                                                                 In Shop
         </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                     <label class="form-check-label" for="status_installation">
                                                                                     <input type="radio" class="form-check-input" name="status" id="status_instal ▶
                                                                                 Installation
                                     </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                     <label class="form-check-label" for="status_installed">
                                                                                     <input type="radio" class="form-check-input" name="status" id="status_instal ▶
                                                                                 Installed
                                                                                 </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                     <label class="form-check-label" for="status_cancel">
                                                                                     <input type="radio" class="form-check-input" name="status" id="status_instal ▶
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
                                 <input class="form-control" disabled name="dealer" type="text" value="asd">
                             </div>
                         </div>
                         <div class="col-3">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>Country:</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="dealer_country" type="text" value="asd">
                             </div>
                         </div>
                         <div class="col-3">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>Phone:</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="dealer_phone" type="number" value="234">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-12">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>Buyer Name(s):</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="buyer_name" type="text" value="asd">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-4">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>Buyer Address:</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="buyer_address" type="text" value="asd">
                             </div>
                         </div>
                         <div class="col-4">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>City:</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="city" type="text" value="asd">
                             </div>
                         </div>
                         <div class="col-2">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>State:</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="state" type="text" value="asd">
                             </div>
                         </div>
                         <div class="col-2">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>Zip:</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="zip" type="text" value="1223">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-4">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>Phone(Day):</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="phone_day" type="number" value="23">
                             </div>
                         </div>
                         <div class="col-4">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>(Evening):</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="phone_evening" type="number" value="23">
                             </div>
                         </div>
                         <div class="col-4">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>(Cell):</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="phone_cell" type="number" value="23">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-12">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>Installation Site:</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="installation_site" type="text" value="asd">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-12">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" style="font-size:medium;"><strong>Email Address:</strong></span>
                                 </div>
                                 <input class="form-control" disabled name="email" type="text" value="asd">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="card-body">
                             <button type="button" class="btn btn-square btn-success" data-toggle="modal" data-target="#exampleModalCenter">Create Item</button>\ ▶
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
                                                 <input class="form-control" id="total_sale" readonly name="total_sale" type="number" value="1156.00">
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
                                                 <input class="form-control" id="tax" onchange="calculaTotal()" disabled name="tax" type="number" value="34.00">\ ▶
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
                                                 <input class="form-control" id="tax_exempt" disabled name="tax_exempt" type="number" value="43.00">
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
                                                 <input class="form-control" id="contractor_fee" disabled name="non_tax_contractor_fee" type="text" value="43.00" ▶
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
                                                 <input name="total" class="form-control" id="total_order" readonly="true" type="number" value="1549.04">
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
                                                 <input class="form-control" id="dealer_deposit" disabled name="dealer_deposit" type="number" value="34.00">
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
                                                 <input class="form-control" id="amount_paid" disabled name="amount_paid" type="number" value="34.00">
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
                                                 <input class="form-control" id="balance_due" disabled name="balance_due" type="number" value="324.00">
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
                             <textarea class="form-control" rows="4" id="special_instruction" name="special_instruction" cols="50"></textarea>
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
                                                 <input class="form-control" disabled name="color_roof" type="text" value="sdf">
                                             </div>
                                         </td>
                                         <td>
                                             <div class="input-group input-group-sm mb-3">
                                                 <div class="input-group-prepend">
                                                     <span class="input-group-text"><strong>Sides:</strong></span>
                                                 </div>
                                                 <input class="form-control" disabled name="color_sides" type="text" value="wer">
                                             </div>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <div class="input-group input-group-sm mb-3">
                                                 <div class="input-group-prepend">
                                                     <span class="input-group-text"><strong>Ends:</strong></span>
                                                 </div>
                                                 <input class="form-control" disabled name="color_ends" type="text" value="wer">
                                             </div>
                                         </td>
                                         <td>
                                             <div class="input-group input-group-sm mb-3">
                                                 <div class="input-group-prepend">
                                                     <span class="input-group-text"><strong>Trim:</strong></span>
                                                 </div>
                                                 <input class="form-control" disabled name="color_trim" type="text" value="sdf">
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
                                                                                                                     <input type="radio" class="form-check-input" ▶
                                                                                                                 Ground
                                                                                                                 </label>
                                                 </div>
                                                 <div class="form-check form-check-inline">
                                                     <label for="check_cement" class="form-check-label" >
                                                                                                                     <input type="radio" class="form-check-input" ▶
                                                                                                                 Cement
                                                                                                                 </label>
                                                 </div>
                                                 <div class="form-check form-check-inline">
                                                     <label for="check_asphalt" class="form-check-label" >
                                                                                                                     <input type="radio" class="form-check-input" ▶
                                                                                                                 Asphalt
                                                                                                                 </label>
                                                 </div>
                                                 <div class="form-check form-check-inline">
                                                     <div class="input-group input-group-sm mb-3">
                                                         <label for="check_other" class="form-check-label" >
                                                                                                                             <input type="radio" class="form-chec ▶
                                                                                                                         Other
                                                         </label>
                                                         <input class="form-control" disabled name="installation_other" type="text">
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
                                                                                                                     <input type="radio" class="form-check-input" ▶
                                                                                                                 Yes
                                                     </label>
                                                 </div>
                                                 <div class="form-check form-check-inline">
                                                     <label for="check_land_no" class="form-check-label" >
                                                                                                                     <input type="radio" class="form-check-input" ▶
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
                                                                                                                     <input type="radio" class="form-check-input" ▶
                                                                                                                 Yes
                                                     </label>
                                                 </div>
                                                 <div class="form-check form-check-inline">
                                                     <label for="check_electricity_no" class="form-check-label" >
                                                                                                                     <input type="radio" class="form-check-input" ▶
                                                                                                                 No
                                                     </label>
                                                 </div>
                                             </div>
                                         </td>
                                         <td><span>Payment:</span>
                                             <div class="form-group">
                                                 <div class="form-check form-check-inline">
                                                     <label for="check_cash" class="form-check-label" >
                                                                                                                     <input type="radio" class="form-check-input" ▶
                                                                                                                 Cash
                                                     </label>
                                                 </div>
                                                 <div class="form-check form-check-inline">
                                                     <label for="check_cash" class="form-check-label" >
                                                                                                                     <input type="radio" class="form-check-input" ▶
                                                                                                                 Check
                                                     </label>
                                                 </div>
                                                 <div class="form-check form-check-inline">
                                                     <label for="check_cash" class="form-check-label" >
                                                                                                                     <input type="radio" class="form-check-input" ▶
                                                                                                                 CC
                                                     </label>
                                                 </div>
                                                 <div class="form-check form-check-inline">
                                                     <label for="check_cash" class="form-check-label" >
                                                                                                                     <input type="radio" class="form-check-input" ▶
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
                                 <input class="form-control" disabled name="buyer_signature" type="text" value="sdf">
                             </div>
                         </div>
                         <div class="col-3">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text">Date:</span>
                                 </div>
                                 <input class="datepicker-default form-control" disabled name="buyer_signature_date" type="text" value="November 11, 2021">
                             </div>
                         </div>
                         <div class="col-3">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text">Contractor Name:</span>
                                 </div>
                                 <input class="form-control" disabled name="contractor_signature" type="text" value="sdf">
                             </div>
                         </div>
                         <div class="col-3">
                             <div class="input-group input-group-sm mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text">Date:</span>
                                 </div>
                                 <input class="datepicker-default form-control" disabled name="contractor_signature_date" type="text" value="November 12, 2021">\ ▶
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card-footer">
                     <button class="btn btn-primary" id="save" type="button">Imprimir</button>
                     <a href="http://orders.test/orders" class="btn btn-default">Cancel</a>
                 </div>
             </div>
         </div>
     </div>
     </form>
 </div>
 </body>
 </html>';
        */

        $imgUno = url('assets/images/logo.png');
        $url = public_path() . "/assets/images/logo.png";
        //dd($url)
        $test = "";

        $test =
            "<!DOCTYPE html>
 <html lang='en'>
 <head>
 <style>
 @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
*{
  margin: 0;
  box-sizing: border-box;
}
body{
  background: #FFF;
  font-family: 'Roboto', sans-serif;
  background-repeat: repeat-y;
  background-size: 100%;
}
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}

#invoiceholder{
  width:100%;
  hieght: 100%;
  padding-top: 20px;
}
#invoice{
position: relative;
top: -290px;
margin: 0 auto;
width: 800px;
background: #FFF;
}

[id*='invoice-'']{ /* Targets all id with 'col-'' */
    border-bottom: 1px solid #EEE;
  padding: 30px;
}
#invoice-top{min-height: 120px;}
#invoice-mid{min-height: 120px;}
#invoice-bot{ min-height: 250px;}

.logo{
    margin-top: 80px;
    margin-left: 20px;
    margin-right: 10px;
    float: left;
    height: 120px;
	width: 120px;
	background: url(assets/images/logo.png) no-repeat;
        background-size: 150px 150px;
}
.clientlogo{
    height: 260px;
	width: 260px;
	background: url(assets/images/logo-text.png) no-repeat;
        background-size: 166px 88px;
}
.info{
    float: left;
    margin-left: 20px;
}
.title{
    float: right;
    margin-left: 20px;
}
.title p{text-align: right;}
#project{margin-left: 52%;}
table{
    width: 100%;
    border-collapse: collapse;
}
td{
    padding: 5px 0 5px 15px;
  border: 1px solid #EEE
}
.tabletitle{
  padding: 5px;
  background: #EEE;
}
.tabletitle2{
  padding: 130px;
  background: #EEE;
}
.service{border: 1px solid #EEE;}
.item{width: 30%;}
.itemtext{font-size: 10px;}
.itemTable{width: 70%;}

#legalcopy{
  margin-top: 30px;
}
form{
    float:right;
    margin-top: 30px;
  text-align: right;
}

.effect2{
    position: relative;
}
.effect2:before, .effect2:after{
    z-index: -1;
  position: absolute;
  content: '';
  bottom: 15px;
  left: 10px;
  width: 50%;
  top: 80%;
  max-width:300px;
  background: #777;
  -webkit-box-shadow: 0 15px 10px #777;
-moz-box-shadow: 0 15px 10px #777;
  box-shadow: 0 15px 10px #777;
-webkit-transform: rotate(-3deg);
  -moz-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}
.effect2:after{
    -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
}
.legal{
    width:70%;
}
</style>
 </head>
 <body>
 <div id='invoiceholder'>
  <div id='headerimage'></div>
  <div id='invoice' class='effect2'>
    <div id='invoice-top'>
       <table class='tabletitle2'>
            <tr>
                <td class='logo'></td>
                <td class='info'>
                    <p>Please send exact amount:</p>
                    <p >Current exchange rate 1BTC </p>
                </td>
                <td>
                    <span>Invoice: </span>
                    <input type='number' value='$order->invoice'/>
                    <br>
                    <span >Order Date: </span>
                    <input name='order_date' value='$order->order_date'/>
                    <br>
                    <span >Installed Date: </span>
                    <input name='installed_date' value='$order->installed_date'/>
                </td>
            </tr>
        </table>
        <br>
        <table class='tabletitle2'>
           <tr>
                <td><stron>Status:</stron></td>
                <td>";
        if ($order->status == "Quote") {
            $test .= "<input type='radio' class='form-check-input' name='status' id='status_quote' value='Quote' checked='checked'>";
        } else {
            $test .= "<input type='radio' class='form-check-input' name='status' id='status_quote' value='Quote' disabled>";
        }
        $test .= " Quote
                </td>
                <td>";
        if ($order->status == "In Shop") {
            $test .= "<input type='radio' class='form-check-input' name='status' id='status_shop' value='In Shop' checked='checked'>";
        } else {
            $test .= "<input type='radio' class='form-check-input' name='status' id='status_shop' value='In Shop' disabled>";
        }
        $test .= " In Shop
                </td>
                <td>";
        if ($order->status == "Installation") {
            $test .= "<input type='radio' class='form-check-input' name='status' id='status_installation' checked='checked'>";
        } else {
            $test .= "<input type='radio' class='form-check-input' name='status' id='status_installation' disabled >";
        }
        $test .= " Installation
                </td>
                <td>";
        if ($order->status == "Installed") {
            $test .= "<input type='radio' class='form-check-input' name='status' id='status_installed' checked='checked'>";
        } else {
            $test .= "<input type='radio' class='form-check-input' name='status' id='status_installed'>";
        }
        $test .= " Installed
                </td>
                <td>";
        if ($order->status == "Cancel") {
            $test .= "<input type='radio' class='form-check-input' name='status' id='status_installed' checked='checked'>";
        } else {
            $test .= "<input type='radio' class='form-check-input' name='status' id='status_installed' disabled>";
        }
        $test .= " Cancel
                </td>
           </tr>
        </table>
        <table class='tabletitle2'>
            <tr>
                <td colspan='2'>
                    <span class='input-group-text' style='font-size:medium;'><strong>Dealer:</strong></span>
                    " . $order->dealer . "
                </td>
                <td>
                    <span class='input-group-text' style='font-size:medium;'><strong>Country:</strong></span>
                    " . $order->dealer_country . "
                </td>
                <td>
                    <span class='input-group-text' style='font-size:medium;'><strong>Phone:</strong></span>
                    " . $order->dealer_phone . "
                </td>
            </tr>
            <tr>
                <td colspan='4'>
                    <span class='input-group-text' style='font-size:medium;'><strong>Buyer Name(s):</strong></span>
                    " . $order->buyer_name . "
                </td>
            </tr>
            <tr>
                <td>
                    <span class='input-group-text' style='font-size:medium;'><strong>Buyer Address:</strong></span>
                    " . $order->buyer_address . "
                </td>
                <td>
                    <span class='input-group-text' style='font-size:medium;'><strong>City:</strong></span>
                    " . $order->city . "
                </td>
                <td>
                    <span class='input-group-text' style='font-size:medium;'><strong>State:</strong></span>
                    " . $order->state . "
                </td>
                <td>
                    <span class='input-group-text' style='font-size:medium;'><strong>Zip:</strong></span>
                    " . $order->zip . "
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <span class='input-group-text' style='font-size:medium;'><strong>Phone(Day):</strong></span>
                    " . $order->phone_day . "
                </td>
                <td>
                    <span class='input-group-text' style='font-size:medium;'><strong>(Evening):</strong></span>
                    " . $order->phone_evening . "
                </td>
                <td>
                    <span class='input-group-text' style='font-size:medium;'><strong>(Cell):</strong></span>
                    " . $order->phone_cell . "
                </td>
            </tr>
            <tr>
                <td colspan='4'>
                    <span class='input-group-text' style='font-size:medium;'><strong>Installation Site:</strong></span>
                    " . $order->installation_site . "
                </td>
            </tr>
            <tr>
                <td colspan='4'>
                    <span class='input-group-text' style='font-size:medium;'><strong>Email Address:</strong></span>
                    " . $order->email . "
                </td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td class='itemTable'>
                    <table >
                        <thead>
                            <tr>
                                <th class='item'>Item</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>";
        foreach ($items as $item) {
            $test .= "<tr>
                                    <td class='item itemtext'>" . $item->item . "</td>
                                    <td class='item itemtext'>" . $item->description . "</td>
                                    <td class='itemtext'>" . $item->price . "</td>
                                    <td class='itemtext'>" . $item->amount . "</td>
                                    <td class='itemtext'>" . $item->price * $item->amount . "</td>
                                </tr>";
        }
        $test .= "</tbody>
                    </table>
                </td>
                <td>
                    <table>
                        <caption style='align: center'><strong>ALL ORDERS C.O.D</strong></caption>
                            <tr>
                                <td class='itemtext'>Total Sale</td>
                                <td class='itemtext'>$ " . $order->total_sale . "</td>
                            </tr>
                            <tr>
                                <td class='itemtext'>Tax</td>
                                <td class='itemtext'>$ " . $order->tax . "</td>
                            </tr>
                            <tr>
                                <td class='itemtext'>Tax Exempt</td>
                                <td class='itemtext'>$ " . $order->tax_exempt . "</td>
                            </tr>
                            <tr>
                                <td class='itemtext'>Non-Tax Contractor Fee</td>
                                <td class='itemtext'>$ " . $order->tax_exempt . "</td>
                            </tr>
                            <tr>
                                <td class='itemtext'>Total</td>
                                <td class='itemtext'>$ " . $order->total . "</td>
                            </tr>
                            <tr>
                                <td class='itemtext'>Dealer Deposit</td>
                                <td class='itemtext'>$ " . $order->dealer_deposit . "</td>
                            </tr>
                            <tr>
                                <td class='itemtext'>Amount Paid</td>
                                <td class='itemtext'>$ " . $order->amount_paid . "</td>
                            </tr>
                            <tr>
                                <td class='itemtext'>Balance Due</td>
                                <td class='itemtext'>$ " . $order->balance_due . "</td>
                            </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table>
            <TR>
                <TH>
                    <strong>Special Instructions:</strong>
                </TH>
            </TR>
            <TR>
                <TD>
                    <textarea name='text' id='text'>dsfsdf</textarea>
                </TD>
                <td ROWSPAN='2'>
                    <table>
                        <tr>
                            <td>
                                Installation
                            </td>
                            <td colspan='2'>";
                            if ($order->installation == "Ground") {
                                $test .= "<input type ='radio' checked='checked'/>";
                            } else{
                                $test .= "<input type ='radio'/>";
                            }
                               $test .= " Ground ";
                            if ($order->installation == "Cement") {
                                $test .= "<input type ='radio' checked='checked'/>";
                            } else{
                                $test .= "<input type ='radio'/>";
                            }
                                $test .= " Cement  <br>";
                            if ($order->installation == "Asphalt") {
                                $test .= "<input type ='radio' checked='checked'/>";
                            } else{
                                $test .= "<input type ='radio'/>";
                            }
                            $test .= " Asphalt ";
                            if ($order->installation == "Other") {
                                $test .= "<input type ='radio' checked='checked'/>";
                                $test .= " Other : ".$order->installation_other;
                            } else{
                                $test .= "<input type ='radio'/>";
                                $test .= " Other";
                            }

                            $test .= "</td>
                        </tr>
                        <tr>
                            <td>
                                Land Level
                            </td>
                            <td colspan='2'>";
                            if ($order->land_level == 1){
                                $test .="<input type='radio' checked='checked'>Yes <br>";
                                $test .="<input type='radio' >No (Building will be installed 'as is')";
                            }else{
                                $test .="<input type='radio' >Yes <br>";
                                $test .="<input type='radio' checked='checked'>No (Building will be installed 'as is')";
                            }
                            $test .="</td>
                        </tr>
                        <tr>
                            <td>
                                Electricity
                            </td>
                            <td>";
                            if ($order->electricity == 1){
                               $test .="<input type='radio' checked='checked'>Yes <br>";
                                $test .="<input type='radio' >No";
                            }else{
                                $test .="<input type='radio' >Yes <br>";
                                $test .="<input type='radio' checked='checked'>No";
                            }
                            $test .="</td>
                            <td>Payment: <br>";
                                switch ($order->payment) {
                                    case "Cash":
                                        $test .= "<input type='radio' checked='checked'> Cash  ";
                                        $test .= "<input type='radio' > Check <br>";
                                        $test .= "<input type='radio' > CC  ";
                                        $test .= "<input type='radio' > P.O.";
                                        break;
                                    case "Check":
                                        $test .= "<input type='radio' > Cash  ";
                                        $test .= "<input type='radio' checked='checked'> Check <br>";
                                        $test .= "<input type='radio' > CC  ";
                                        $test .= "<input type='radio' > P.O.";
                                        break;
                                    case "CC":
                                        $test .= "<input type='radio' > Cash  ";
                                        $test .= "<input type='radio' > Check <br>";
                                        $test .= "<input type='radio' checked='checked'> CC";
                                        $test .= "<input type='radio' > P.O.";
                                        break;
                                    case "P.O.":
                                        $test .= "<input type='radio' > Cash  ";
                                        $test .= "<input type='radio' > Check <br>";
                                        $test .= "<input type='radio' > CC  ";
                                        $test .= "<input type='radio' checked='checked'> P.O.";
                                        break;

                                    default:
                                        break;
                                }
                            $test .="</td>
                        </tr>
                    </table>
                </td>
            </TR>
            <TR>
              <TD>
                <table>
                    <tr>
                        <td rowspan='2'>
                            Colors
                        </td>
                        <td>Roof: ".$order->color_roof."</td>
                        <td>Sides: ".$order->color_sides."</td>
                    </tr>
                    <tr>
                        <td>Ends: ".$order->color_ends."</td>
                        <td>Trim: ".$order->color_trim."</td>
                    </tr>
                </table>
              </TD>
            </TR>
        </table>
        <table>
            <tr>
                <td>Buyer: ".$order->buyer_signature."</td>
                <td>Date: ".$order->buyer_signature_date."</td>
                <td>Contractor Name: ".$order->contractor_signature."</td>
                <td>Date: ".$order->contractor_signature_date."</td>
            </tr>
        </table>
      </div><!--End Title-->
    </div><!--End InvoiceTop-->
    </div><!--End Invoice-->

    <div id='invoice-mid'>

    </div><!--End Invoice Mid-->

    <div id='invoice-bot'>

      <div id='legalcopy'>
        <p class='legal'><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices.
        </p>
      </div>
    </div><!--End InvoiceBot-->

  </div>
</div><!-- End Invoice Holder-->

</body>
</html>";


        //$pdf = PDF::loadView('orders.pdf', ['data'=>$data])->setOptions(['defaultFont' => 'sans-serif']);
        $html = view('orders.pdf',['data'=>$data])->render();
        //dd($html);
        $mpdf = new Mpdf([
            'default_font' => 'arial',
            // "format" => "A4",
            //"format" => [264.8,188.9],
        ]);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($test);
        // dd($mpdf);
        /*if($accion=='ver'){
            $mpdf->Output($namefile,"I");
        }elseif($accion=='descargar'){
            $mpdf->Output($namefile,"D");
        } */
        return $mpdf->Output('invoice.pdf',"D");
    }

    public function test() {
        return view('orders.test');
    }
}
