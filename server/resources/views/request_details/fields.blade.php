<!-- Requests Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('requests_id', 'Requests Id:') !!}
    {!! Form::number('requests_id', null, ['class' => 'form-control']) !!}
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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('requestDetails.index') !!}" class="btn btn-default">Cancel</a>
</div>
