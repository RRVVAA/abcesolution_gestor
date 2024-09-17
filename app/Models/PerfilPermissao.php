<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilPermissao extends Model
{
    use HasFactory;
    protected $table = "perfil_permissao";
    public $fillable = ['perfil_id','permissao_id'];
    public function perfil(){
        return $this->belongsTo(Perfil::class,"perfil_id",'id',"perfil_permissao");
    }
    
    public function permissao(){
        return $this->belongsTo(Permissao::class,"permissao_id","id","perfil_permissao");
    }
}
