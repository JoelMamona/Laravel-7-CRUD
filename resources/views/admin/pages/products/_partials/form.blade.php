@csrf

<session class="content">
<div class="content">
   <div class="form-group">
      <input type="text" required name="name" class="form-control" placeholder="Nome" value="{{$products->name ?? old('name')}}">
   </div>
   <div class="form-group">
      <input type="text" required name="price" class="form-control" placeholder="Preço" value="{{$products->price ?? old('price')}}">
   </div>
   <div class="form-group">
      <input type="text" required class="form-control" name="description" placeholder="Descrição" value="{{$products->description ?? old('description')}}">
   </div>
   <div class="form-group">
   
      @if($products->image ?? '')
            <?php $path  ='imagens/productos/'; ?>
            <img height="100" width="100" src="{{asset($path)}}/{{$products->image}}">
            <input type="file"  class="form-control" name="image">
      @else
            <input type="file"   class="form-control" name="image">
      @endif

   </div>
   <div class="form-group">
      <button type="submit" class="btn btn-success">Enviar</button>
   </div>

</div>
</session>