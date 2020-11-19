
@extends('admin.layouts.app')

@section('title','Detalhes de Produtos')

@section('content')

<h1><center>{{$products->name}}</center></h1>
<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Criado em</th>
            <th>Actualizado em </th>
            <th>Ação</th>
        </tr>
    </thead
    
    <tbody>

                <tr>

                    <td>{{$products->price}}</td>
                    <td>{{$products->description}}</td>
                    <td>{{$products->created_at}}</td>
                    <td>{{$products->updated_at}}</td>
                 
                <td>
                    <form action="{{route('products.destroy', $products->id )}}" method="Post">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir {{$products->name}}</button>
                    </form>
                
                </td>
                
                </tr>

    </tbody>
    
</table>

