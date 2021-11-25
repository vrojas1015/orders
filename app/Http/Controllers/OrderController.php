<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;
use App\Repositories\ItemRepository;
use App\Http\Controllers\AppBaseController;
use PDF;
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

    public function pdf($id){
        $order = $this->orderRepository->find($id);
        $items = $this->itemRepository->detalle($order['id']);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }
        $array_list=[];
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

        $pdf = PDF::loadView('orders.pdf', ['data'=>$data])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream('invoice.pdf');
    }
}
