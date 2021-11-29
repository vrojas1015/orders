<!-- Logo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('logo', 'Logo:') !!}
    {!! Form::file('logo', ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Header-Image-Bg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('header-image-bg', 'Header-Image-Bg:') !!}
    {!! Form::text('header-image-bg', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Footer-Image-Bg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('footer-image-bg', 'Footer-Image-Bg:') !!}
    {!! Form::text('footer-image-bg', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>
