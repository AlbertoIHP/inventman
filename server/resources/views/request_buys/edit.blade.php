@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Request Buy
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($requestBuy, ['route' => ['requestBuys.update', $requestBuy->id], 'method' => 'patch']) !!}

                        @include('request_buys.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection