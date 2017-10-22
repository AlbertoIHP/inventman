@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventary Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inventaryType, ['route' => ['inventaryTypes.update', $inventaryType->id], 'method' => 'patch']) !!}

                        @include('inventary_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection