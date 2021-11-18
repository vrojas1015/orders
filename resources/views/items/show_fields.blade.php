<!-- Order Id Field -->
<div class="col-sm-12">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{{ $item->order_id }}</p>
</div>

<!-- Item Field -->
<div class="col-sm-12">
    {!! Form::label('item', 'Item:') !!}
    <p>{{ $item->item }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $item->price }}</p>
</div>

