<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Perfil extends Model
{
    use HasFactory;    
    protected $fillable = ['nome', 'descricao'];
    
    public function users(){
        return $this->belongsToMany(User::class);
    }
    
    public function planos()
    {
        return $this->belongsToMany(Plano::class);
    }
    
    public function permissoes() {
        return $this->belongsToMany(Permissao::class);
    }
    
    public  function permissoesNaoInseridas($filtro = null)
    {
        $permissoes = Permissao::whereNotIn('permissaos.id', function($query) {
            $query->select('perfil_permissao.permissao_id');
            $query->from('perfil_permissao');
            $query->whereRaw("perfil_permissao.perfil_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filtro) {
            if ($filtro)
                $queryFilter->where('permissaos.permissao', 'LIKE', "%{$filtro}%");
        })
        ->get();
        
        return $permissoes;
    }
    
    
    
    
    //adiciona uma permissão
    public function addPermissao( $permissao ) {
        //se foi enviada uma string
        if ( is_string( $permissao ) ) {
            $permissao = Permissao::where('permissao','=', $permissao)->firstOrFail();
            
        }
        //se foi enviado um objeto do tipo permissao
        if ( $this->permissaoExists($permissao) ) {
            return;
        }
        
        return $this->permissoes()->attach($permissao);
        
    }
    //remove uma permissão
    public function dropPermissao( $permissao ) {
        
        if ( is_string( $permissao ) ) {
            $permissao = Permissao::where('permissao','=', $permissao)->firstOrFail();
        }
        
        return $this->permissoes()->detach($permissao);
        
    }
    //verifica se uma permissão existe
    public function permissaoExists( $permissao ) {
        
        if ( is_string( $permissao ) ) {
            $permissao = Permissao::where('permissao','=', $permissao)->firstOrFail();
        }
        
        return ( boolean ) $this->permissoes()->find( $permissao->id );
    }
}
