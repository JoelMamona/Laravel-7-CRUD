
@extends('admin.layouts.app')

@section('title','Editar Produtos')

@section('content')

<h1>Editando Produto {{ $products->name }} <a href="{{route('products.index')}}">  <</a></h1>

   <br>
   <form action="{{route('products.update',$products->id)}}" method="Post" class="form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
 
    @include('admin.pages.products._partials.form')

</form>

@endsection
