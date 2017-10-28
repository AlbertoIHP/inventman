<!-- Functionalities Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('functionalities_id', 'Functionalities Id:') !!}
    {!! Form::number('functionalities_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Userstypes Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('userstypes_id', 'Userstypes Id:') !!}
    {!! Form::number('userstypes_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Write Field -->
<div class="form-group col-sm-6">
    {!! Form::label('write', 'Write:') !!}
    {!! Form::text('write', null, ['class' => 'form-control']) !!}
</div>

<!-- Delete Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delete', 'Delete:') !!}
    {!! Form::text('delete', null, ['class' => 'form-control']) !!}
</div>

<!-- Read Field -->
<div class="form-group col-sm-6">
    {!! Form::label('read', 'Read:') !!}
    {!! Form::text('read', null, ['class' => 'form-control']) !!}
</div>

<!-- Edit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('edit', 'Edit:') !!}
    {!! Form::text('edit', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('permises.index') !!}" class="btn btn-default">Cancel</a>
</div>
