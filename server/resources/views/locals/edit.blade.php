@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Local
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($local, ['route' => ['locals.update', $local->id], 'method' => 'patch']) !!}

                        @include('locals.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection