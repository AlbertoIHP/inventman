<!-- Locals Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('locals_id', 'Locals Id:') !!}
    {!! Form::number('locals_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Products Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('products_id', 'Products Id:') !!}
    {!! Form::number('products_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Inventariestypes Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inventariestypes_id', 'Inventariestypes Id:') !!}
    {!! Form::number('inventariestypes_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inventaries.index') !!}" class="btn btn-default">Cancel</a>
</div>
