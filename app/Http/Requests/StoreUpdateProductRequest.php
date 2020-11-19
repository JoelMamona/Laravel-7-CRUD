<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(2);
        return [

            'name' => "required|max:20|unique:products,name,{$id},id",
            'price' => 'required',
            'description' => 'required|max:100',
            'image' => 'nullable|image'
        
        ];
    }
    public function message()
    {
        return [

            'name.required' => "O nome e obrigatório",
            'name.min' => 'O nome deve conter pelo menos 3 caracteres',
            'name.max' => 'O nome deve conter no máximo 5 caracteres',
            'image.required' => 'Ops! Precisa carregar uma imagem',
            'image.image' => 'Ops! Precisa carregar uma imagem',
            'description.required' => 'Precisa informar uma descrição',
            'description.min' => 'A descrição deve conter pelo menos 3 caracteres',
            'description.max' => 'A descrição deve conter no máximo 100 caracteres'
        ];
    }
}
