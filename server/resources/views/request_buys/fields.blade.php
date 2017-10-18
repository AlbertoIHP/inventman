<!-- Locals Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('locals_id', 'Locals Id:') !!}
    {!! Form::number('locals_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Providers Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('providers_id', 'Providers Id:') !!}
    {!! Form::number('providers_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::number('total', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('requestBuys.index') !!}" class="btn btn-default">Cancel</a>
</div>
