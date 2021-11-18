<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Invoice Field -->
<div class="form-group col-sm-6">
    {!! Form::label('invoice', 'Invoice:') !!}
    {!! Form::number('invoice', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_date', 'Order Date:') !!}
    {!! Form::text('order_date', null, ['class' => 'form-control','id'=>'order_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#order_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Installed Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('installed_date', 'Installed Date:') !!}
    {!! Form::text('installed_date', null, ['class' => 'form-control','id'=>'installed_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#installed_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Dealer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dealer', 'Dealer:') !!}
    {!! Form::text('dealer', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Dealer Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dealer_country', 'Dealer Country:') !!}
    {!! Form::text('dealer_country', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Dealer Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dealer_phone', 'Dealer Phone:') !!}
    {!! Form::number('dealer_phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Buyer Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('buyer_name', 'Buyer Name:') !!}
    {!! Form::text('buyer_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Buyer Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('buyer_address', 'Buyer Address:') !!}
    {!! Form::text('buyer_address', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'State:') !!}
    {!! Form::text('state', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Zip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('zip', 'Zip:') !!}
    {!! Form::number('zip', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Day Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_day', 'Phone Day:') !!}
    {!! Form::number('phone_day', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Evening Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_evening', 'Phone Evening:') !!}
    {!! Form::number('phone_evening', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Cell Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_cell', 'Phone Cell:') !!}
    {!! Form::number('phone_cell', null, ['class' => 'form-control']) !!}
</div>

<!-- Installation Site Field -->
<div class="form-group col-sm-6">
    {!! Form::label('installation_site', 'Installation Site:') !!}
    {!! Form::text('installation_site', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Width Field -->
<div class="form-group col-sm-6">
    {!! Form::label('width', 'Width:') !!}
    {!! Form::number('width', null, ['class' => 'form-control']) !!}
</div>

<!-- Roof Length Field -->
<div class="form-group col-sm-6">
    {!! Form::label('roof_length', 'Roof Length:') !!}
    {!! Form::number('roof_length', null, ['class' => 'form-control']) !!}
</div>

<!-- Frame Length Field -->
<div class="form-group col-sm-6">
    {!! Form::label('frame_length', 'Frame Length:') !!}
    {!! Form::number('frame_length', null, ['class' => 'form-control']) !!}
</div>

<!-- Leg Height Field -->
<div class="form-group col-sm-6">
    {!! Form::label('leg_height', 'Leg Height:') !!}
    {!! Form::number('leg_height', null, ['class' => 'form-control']) !!}
</div>

<!-- Gauge Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gauge', 'Gauge:') !!}
    {!! Form::number('gauge', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Regular Frame Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('regular_frame', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('regular_frame', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('regular_frame', 'Regular Frame', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- A Frame Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('a_frame', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('a_frame', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('a_frame', 'A Frame', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Vertical Roof Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('vertical_roof', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('vertical_roof', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('vertical_roof', 'Vertical Roof', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- All Vertical Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('all_vertical', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('all_vertical', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('all_vertical', 'All Vertical', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Color Roof Field -->
<div class="form-group col-sm-6">
    {!! Form::label('color_roof', 'Color Roof:') !!}
    {!! Form::text('color_roof', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Color Ends Field -->
<div class="form-group col-sm-6">
    {!! Form::label('color_ends', 'Color Ends:') !!}
    {!! Form::text('color_ends', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Color Sides Field -->
<div class="form-group col-sm-6">
    {!! Form::label('color_sides', 'Color Sides:') !!}
    {!! Form::text('color_sides', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Color Trim Field -->
<div class="form-group col-sm-6">
    {!! Form::label('color_trim', 'Color Trim:') !!}
    {!! Form::text('color_trim', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Installation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('installation', 'Installation:') !!}
    {!! Form::text('installation', null, ['class' => 'form-control']) !!}
</div>

<!-- Installation Other Field -->
<div class="form-group col-sm-6">
    {!! Form::label('installation_other', 'Installation Other:') !!}
    {!! Form::text('installation_other', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Land Level Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('land_level', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('land_level', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('land_level', 'Land Level', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Electricity Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('electricity', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('electricity', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('electricity', 'Electricity', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Payment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment', 'Payment:') !!}
    {!! Form::text('payment', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Sale Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_sale', 'Total Sale:') !!}
    {!! Form::number('total_sale', null, ['class' => 'form-control']) !!}
</div>

<!-- Tax Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax', 'Tax:') !!}
    {!! Form::number('tax', null, ['class' => 'form-control']) !!}
</div>

<!-- Tax Exempt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax_exempt', 'Tax Exempt:') !!}
    {!! Form::number('tax_exempt', null, ['class' => 'form-control']) !!}
</div>

<!-- Non Tax Contractor Fee Field -->
<div class="form-group col-sm-6">
    {!! Form::label('non_tax_contractor_fee', 'Non Tax Contractor Fee:') !!}
    {!! Form::number('non_tax_contractor_fee', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::number('total', null, ['class' => 'form-control']) !!}
</div>

<!-- Dealer Deposit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dealer_deposit', 'Dealer Deposit:') !!}
    {!! Form::number('dealer_deposit', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Paid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount_paid', 'Amount Paid:') !!}
    {!! Form::number('amount_paid', null, ['class' => 'form-control']) !!}
</div>

<!-- Balance Due Field -->
<div class="form-group col-sm-6">
    {!! Form::label('balance_due', 'Balance Due:') !!}
    {!! Form::number('balance_due', null, ['class' => 'form-control']) !!}
</div>

<!-- Buyer Signature Field -->
<div class="form-group col-sm-6">
    {!! Form::label('buyer_signature', 'Buyer Signature:') !!}
    {!! Form::text('buyer_signature', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Buyer Signature Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('buyer_signature_date', 'Buyer Signature Date:') !!}
    {!! Form::text('buyer_signature_date', null, ['class' => 'form-control','id'=>'buyer_signature_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#buyer_signature_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Contractor Signature Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contractor_signature', 'Contractor Signature:') !!}
    {!! Form::text('contractor_signature', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Contractor Signature Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contractor_signature_date', 'Contractor Signature Date:') !!}
    {!! Form::text('contractor_signature_date', null, ['class' => 'form-control','id'=>'contractor_signature_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#contractor_signature_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush