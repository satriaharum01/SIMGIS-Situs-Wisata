<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nodes extends Model
{
    use HasFactory;
    protected $table = 'node';
    protected $primaryKey = 'id_node';
    protected $fillable = ['nama_jalan','lat','long'];
    
    public function Graf()
    {
     return $this->hasMany('App\Models\Graf', 'id_node');  
    }
}

