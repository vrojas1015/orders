<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', 'Order Id:') !!}
    {!! Form::number('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Instruction Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('instruction', 'Instruction:') !!}
    {!! Form::textarea('instruction', null, ['class' => 'form-control']) !!}
</div>