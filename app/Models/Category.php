<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'id_category';
    protected $fillable = ['nama_category'];
    
    public function Wisata()
    {
     return $this->hasMany('App\Models\Wisata', 'id_category');  
    }
}

