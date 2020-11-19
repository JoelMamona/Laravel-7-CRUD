<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'description','image',
    ];

    public function search( $filter = null){
        
        
        $results = $this->where(function($query) use ($filter){
                if($filter){
                    $query->where('name','LIKE',"%{$filter}%");
                }
        })->paginate();

        return $results;

    }
}
