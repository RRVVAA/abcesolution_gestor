<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilUser extends Model
{
    use HasFactory;
    protected $table = 'perfil_user';
    public $fillable = ['perfil_id','user_id'];
    
    public function perfil(){
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }
    
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'user_id');
    }
    
}
