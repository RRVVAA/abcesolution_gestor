<?php

namespace App\Observers;

use App\Models\PlanoPreco;

class PlanoPrecobserver
{
    public function creating(PlanoPreco $plan)
    {
        
        $plan->preco_de = getFloat($plan->preco_de);
        $plan->preco    = getFloat($plan->preco);
        
    }
    
    
    public function updating(PlanoPreco $plan)
    {
        
        $plan->preco_de = getFloat($plan->preco_de);
        $plan->preco    = getFloat($plan->preco);
        
    }
}
