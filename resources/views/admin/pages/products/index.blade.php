
@extends('admin.layouts.app')

@section('title','Gestão de Produtos')

@section('content')

    <h1>Exibindo produtos</h1>
<hr>


@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Search form -->

<form action="{{route('products.search')}}" method="post">
@csrf
<div class="md-form active-purple-2 mb-3">
<input class="form-control" type="text" name="filter" placeholder="Pesquisar" aria-label="Search" value="{{$filters['filter'] ?? ''}}">
</div>
</form>
<form action="{{route('products.create')}}" method="GET">
    @csrf
   
<button type="submit" class="btn btn-success" >Cadastrar</button>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Criado</th>
            <th>Actualizado</th>
            <th>Ação</th>
        </tr>
    </thead
    
    <tbody>
            @foreach ($products as $item)
                <tr>
                    <?php $path  ='imagens/productos/'; ?>

                    <td>
                    @if ($item->image == null)
                        <img height="100" width="100" src="{{asset('noAvaiable.jpg')}}"></td>
                    @else
                        <img height="100" width="100" src="{{asset($path)}}/{{$item->image}}"></td>
                    @endif
                       
                    <td>{{$item->name}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
                <td>
                    <form action="{{route('products.edit', $item->id )}}" method="GET">
                        @csrf
                       
                    <button type="submit" class="btn btn-primary" >Editar</button>
                    </form>

                    <form action="{{route('products.destroy', $item->id )}}" method="Post">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger" >Excluir</button>
                    </form>
                
                </td>
                </tr>
            @endforeach
    </tbody>
</table>

@if(isset($filters))
    {!! $products->appends($filters)->links() !!}
@else
    {!! $products->links() !!}
@endif
@endsection
