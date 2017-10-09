@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Invetary
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($invetary, ['route' => ['invetaries.update', $invetary->id], 'method' => 'patch']) !!}

                        @include('invetaries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection