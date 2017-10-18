@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Products Sale
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productsSale, ['route' => ['productsSales.update', $productsSale->id], 'method' => 'patch']) !!}

                        @include('products_sales.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection