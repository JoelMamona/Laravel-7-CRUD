<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $request;
    protected $repository;
    CONST IMAGE_PATH = 'imagens/productos/';

    public function __construct(Request $request, Product $product)
    {  
        $this->request = $request;
        $this->repository = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(3);
        return view('admin.pages.products.index',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductRequest $request)
    {
         $file = $request->file('image');
        if($file->isValid()){
            $fileName = time(). '.' .$request->image->extension();
            $file->move(self::IMAGE_PATH,$fileName);
        } 
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $fileName;

        if($product->save()){ 
            return redirect('products')->with('success','Produto registado com sucesso!');
       }
       return redirect('products')->with('error','Erro ao registar produto!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       if(!$product = Product::find($id)){
            return redirect()->back();
       }
        return view('admin.pages.products.show',[
            'products' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$product = Product::find($id)){
            return redirect()->back();
       }
        return view('admin.pages.products.edit',[
            'products' => $product
        ]);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {   
        if(!$product = Product::find($id)){
            return redirect()->back();
       }
        $image = $request->file('image');
        $updateRequest=[];
       if ($image && $image->isValid()) {
            $fileName = time(). '.' .$request->image->extension();
            $image->move(self::IMAGE_PATH,$fileName);
            $updateRequest['image'] = $fileName;
       }
        $updateRequest['name'] = $request->name;
        $updateRequest['price'] = $request->price;
        $updateRequest['description'] = $request->description;

       if($product->update($updateRequest)){
             return redirect('products')->with('success','Produto editado com sucesso!');
        }   
        return redirect('products')->with('error','Erro ao editar produto!');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(!$product = Product::find($id)){
            return redirect()->back();
         }
         
        if($product->delete()){
            if(file_exists(self::IMAGE_PATH.$product->image)) {
                @unlink(self::IMAGE_PATH.$product->image);
            }
            return redirect('products')->with('success','Produto excluido com sucesso!');
         }
         return redirect('products')->with('error','Erro ao excluir produto!');   
    }

    /**
     *Search products 
     */
    public function search(Request $request)
    {
        $products = $this->repository->search($request->filter);
        $filters = $request->except('_token');
        return view('admin.pages.products.index',[
            'products' => $products,
            'filters' => $filters
            ]);
    }
}
