<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graf extends Model
{
    use HasFactory;
    protected $table = 'graf';
    protected $primaryKey = 'id_graf';
    protected $fillable = ['jalur','id_node','jarak','id_wisata'];
    
    public function Nodes()
    {
     return $this->belongsTo('App\Models\Nodes', 'id_node', 'id_node');  
    }
    
    public function Wisata()
    {
     return $this->belongsTo('App\Models\Wisata', 'id_wisata', 'id_wisata');  
    }
    
}

