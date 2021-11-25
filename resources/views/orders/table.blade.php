<div class="table-responsive">
    <table class="table" id="orders-table">
        <thead>
        <tr>
            <th>Invoice</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Total</th>
            <th>Balance Due</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->invoice }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->balance_due }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['orders.destroy', $order->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('orders.show', [$order->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="flaticon-381-print"></i>
                        </a>
                        <a href="{{ route('orders.edit', [$order->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="flaticon-381-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
