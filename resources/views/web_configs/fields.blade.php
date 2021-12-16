<!-- Logo Field -->
<div class="form-group col-sm-6">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><strong>Logo</strong></span>
        </div>
        <div class="custom-file">
            {!! Form::file('img', ['class'=>'custom-file-input', 'required'=>'required']) !!}
            <label class="custom-file-label">Choose file</label>
        </div>
    </div>
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" style="font-size: medium"><strong>Address</strong></span>
        </div>
        <input type="text" name="address" class="form-control" maxlength="255">
    </div>
</div>

<!-- Header-Image-Bg Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('header-image-bg', 'Header-Image-Bg:') !!}
    {!! Form::text('header-image-bg', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div> -->

<!-- Footer-Image-Bg Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('footer-image-bg', 'Footer-Image-Bg:') !!}
    {!! Form::text('footer-image-bg', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div> -->
