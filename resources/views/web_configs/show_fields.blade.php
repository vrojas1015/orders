<!-- Logo Field -->
<div class="col-sm-12">
    {!! Form::label('logo', 'Logo:') !!}
    <p>{{ $webConfig->logo }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $webConfig->address }}</p>
</div>

<!-- Header-Image-Bg Field -->
<div class="col-sm-12">
    {!! Form::label('header-image-bg', 'Header-Image-Bg:') !!}
    <p>{{ $webConfig->header-image-bg }}</p>
</div>

<!-- Footer-Image-Bg Field -->
<div class="col-sm-12">
    {!! Form::label('footer-image-bg', 'Footer-Image-Bg:') !!}
    <p>{{ $webConfig->footer-image-bg }}</p>
</div>

