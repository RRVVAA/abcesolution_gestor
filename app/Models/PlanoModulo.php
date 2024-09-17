<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanoModulo extends Model
{
    use HasFactory;
    protected $table = "plano_modulos";
    protected $fillable =["plano_id", "modulo_id"];
    
    public function plano(){
        return $this->belongsTo(Plano::class,"plano_id","id");
    }
    
    public function modulo(){
        return $this->belongsTo(Modulo::class,"modulo_id","id");
    }    
}
