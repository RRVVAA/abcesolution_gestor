<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'limite_usuario','limite_nfe','limite_nfce','limite_pdv', 'destaque', 'acesso_nfe','acesso_nfce','valor_setup'];
    
    public function modulos() {
        return $this->belongsToMany(Modulo::class,"plano_modulos");
    }
    
  /*  public function modulos() {
        return $this->hasMany(PlanoModulo::class);
    }
    */
    public function perfis()
    {
        return $this->belongsToMany(Perfil::class);
    }
    
    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }
    
    
    public function search($filtro = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filtro}%")
        ->get();
        
        return $results;
    }
    
    public function modulosNaoInseridos($filter = null)
    {
        $perfis = Modulo::whereNotIn('modulos.id', function($query) {
            $query->select('plano_modulos.modulo_id');
            $query->from('plano_modulos');
            $query->whereRaw("plano_modulos.plano_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('modulos.nome', 'LIKE', "%{$filter}%");
        })
        ->get();
        
        return $perfis;
    }
    
    public function perfisNaoInseridos($filter = null)
    {
        $perfis = Perfil::whereNotIn('perfils.id', function($query) {
            $query->select('perfil_plano.perfil_id');
            $query->from('perfil_plano');
            $query->whereRaw("perfil_plano.plano_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('perfil.nome', 'LIKE', "%{$filter}%");
        })
        ->get();
        
        return $perfis;
    }
    
}
