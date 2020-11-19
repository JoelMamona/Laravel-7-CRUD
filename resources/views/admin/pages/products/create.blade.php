
@extends('admin.layouts.app')

@section('title','Criar Produtos')

@section('content')

    <h1>Cadastrar Novo Produto <a href="{{route('products.index')}}">  <</a></h1>

@include('admin.includes.alerts')

   <br>

<form action="{{route('products.store')}}" method="Post" class="form" enctype="multipart/form-data">
    
 @include('admin.pages.products._partials.form')


</form>

@endsection
