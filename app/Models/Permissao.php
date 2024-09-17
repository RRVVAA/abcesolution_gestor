<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    use HasFactory;
    protected $table = 'permissaos';
    protected $fillable = ['permissao', 'descricao'];
    
    public function perfis() {
        return $this->belongsToMany(Perfil::class);
    }
}
