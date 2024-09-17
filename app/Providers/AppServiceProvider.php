<?php

namespace App\Providers;

use App\Models\Plano;
use App\Observers\PlanoObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\PlanoPreco;
use App\Observers\PlanoPrecobserver;
use App\Models\GestaoPagar;
use App\Observers\ContaPagarObserver;
use App\Models\GestaoPagamento;
use App\Observers\PagamentoObserver;
use App\Models\GestaoReceber;
use App\Observers\RecebimentoObserver;
use App\Models\GestaoDespesa;
use App\Observers\DespesaObserver;
use App\Models\Empresa;
use App\Observers\EmpresaObserver;
use App\Models\GestaoFornecedor;
use App\Observers\FornecedorObserver;
use App\Models\GestaoRecebimento;
use App\Observers\ContaReceberObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plano::observe(PlanoObserver::class);
        PlanoPreco::observe(PlanoPrecobserver::class);
        GestaoPagar::observe(ContaPagarObserver::class);
        GestaoPagamento::observe(PagamentoObserver::class);
        GestaoReceber::observe(ContaReceberObserver::class);
        GestaoRecebimento::observe(RecebimentoObserver::class);
        GestaoDespesa::observe(DespesaObserver::class);
        Empresa::observe(EmpresaObserver::class);
        GestaoFornecedor::observe(FornecedorObserver::class);
        
    }
}
