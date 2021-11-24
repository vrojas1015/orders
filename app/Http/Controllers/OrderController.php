<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Facade\FlareClient\Http\Response;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
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
            'description' => 'required|string|max:255',
            'width' => 'required|numeric',
            'roof_length' => 'required|numeric',
            'frame_length' => 'required|numeric',
            'leg_height' => 'required|numeric',
            'gauge' => 'required|integer',
            'price' => 'required|numeric',
            'regular_frame' => 'required',
            'a_frame' => 'required',
            'vertical_roof' => 'required',
            'all_vertical' => 'required',
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

        //dd($request->all());
        //$order = $this->orderRepository->create($request->all());

        Flash::success('Order saved successfully.');
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
        //return redirect(route('orders.index'));
    }


    public function show($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('order', $order);
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
}
