<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;
    protected $table = 'wisata';
    protected $primaryKey = 'id_wisata';
    protected $fillable = ['nama','alamat','lokasi', 'lat', 'long','id_category','foto', 'deskripsi'];
    
    public function Category()
    {
     return $this->belongsTo('App\Models\Category', 'id_category', 'id_category');  
    }
    
    public function Graf()
    {
     return $this->hasMany('App\Models\Graf', 'id_wisata');  
    }
}

