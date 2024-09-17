<?php

use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\ComprovanteController;
use App\Http\Controllers\GestaoDespesaController;
use App\Http\Controllers\GestaoEmpresaController;
use App\Http\Controllers\GestaoFaturaController;
use App\Http\Controllers\GestaoFornecedorController;
use App\Http\Controllers\GestaoPagamentoController;
use App\Http\Controllers\GestaoPagarController;
use App\Http\Controllers\GestaoReceberController;
use App\Http\Controllers\GestaoRecebimentoController;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\IbptController;
use App\Http\Controllers\MeuPerfilController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\PlanoEmpresaController;
use App\Http\Controllers\PlanoModuloController;
use App\Http\Controllers\PlanoPrecoController;
use App\Http\Controllers\TipoDespesaController;
use App\Http\Controllers\Acl\LoginController;
use App\Http\Controllers\Acl\PerfilController;
use App\Http\Controllers\Acl\PerfilPermissaoController;
use App\Http\Controllers\Acl\PermissaoController;
use App\Http\Controllers\Acl\PlanoPerfilController;
use App\Http\Controllers\Acl\UserController;
use App\Http\Controllers\Acl\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssinaturaController;

/********* Rotas de Autenticacao  ********/

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login/enter', [LoginController::class,'login'])->name('login.in');
Route::get('/login/out', [LoginController::class,'logout'])->name('login.out');

//Rota principal geral
Route::get('/', function() {
    return redirect('login');
});;

Route::group(['middleware' => 'auth'], function () { 
    Route::get('/',[GestorController::class, 'index'])->name('index');
    Route::get('resumoContas/{tipo}',[GestorController::class, 'resumoContas'])->name('resumoContas');
    Route::get('/configuracao',[GestorController::class, 'configuracao'])->name('configuracao');
    Route::get('/buscarCNPJ/{cnpj}',[GestorController::class,'buscarCNPJ'])->name('buscarCNPJ');
    Route::post('/salvar',[GestorController::class, 'salvar'])->name('salvar');
    
    Route::resource('/meuperfil',MeuPerfilController::class);
    
    Route::get('/empresa/pagamento/{id}',[GestaoEmpresaController::class,'pagamento'])->name('empresa.pagamento');
    Route::get('/empresa/fatura/{id}',[GestaoEmpresaController::class,'fatura'])->name('empresa.fatura');
    Route::get('/empresa/planos/{id}',[GestaoEmpresaController::class,'planos'])->name('empresa.planos');
    Route::get('/empresa/criarPlano/{id}',[GestaoEmpresaController::class,'criarplano'])->name('empresa.criarplano');
    Route::get('/empresa/criarfatura/{id}',[GestaoEmpresaController::class,'criarfatura'])->name('empresa.criarfatura');    
    Route::post('/empresa/gerarFatura',[GestaoEmpresaController::class, 'gerarFatura'])->name('gerarFatura');  
    Route::post('/empresa/alterarDias',[GestaoEmpresaController::class, 'alterarDias'])->name('alterarDias'); 
    
    Route::resource('/ibpt',IbptController::class);
    
    Route::get('assinantes',[GestaoEmpresaController::class, 'assinantes'])->name('assinantes'); 
    
    
    Route::get('/assinatura/bloquear/{id}',[AssinaturaController::class,'bloquear'])->name('assinatura.bloquear');
    Route::get('/assinatura/cancelar/{id}',[AssinaturaController::class,'cancelar'])->name('assinatura.cancelar');
    Route::get('/assinatura/liberar/{id}',[AssinaturaController::class,'liberar'])->name('assinatura.liberar');
    Route::post('/assinatura/criarAssinatura',[AssinaturaController::class, 'criarAssinatura'])->name('assinatura.criarAssinatura');
    Route::get('assinatura/confirmaAssinaturaPeloComprovante/{id}',[AssinaturaController::class, 'confirmaAssinaturaPeloComprovante'])->name('assinatura.confirmaAssinaturaPeloComprovante');
    Route::resource('assinatura', AssinaturaController::class);
    
    Route::get('prospectos',[GestaoEmpresaController::class, 'prospectos'])->name('prospectos'); 
    Route::resource('/empresa', GestaoEmpresaController::class);
    
    Route::resource('chamado', ChamadoController::class);
    
    Route::get('/comprovante/confirmarPagamento/{id}',[ComprovanteController::class,'confirmarPagamento'])->name('comprovante.confirmarPagamento');
    Route::post('/comprovante/confirmarAssinaturaPeloComprovante',[ComprovanteController::class,'confirmarAssinaturaPeloComprovante'])->name('comprovante.confirmarAssinaturaPeloComprovante');
    Route::resource('comprovante', ComprovanteController::class);
    
    Route::get('fornecedor/buscarCNPJ/{cnpj}',[GestaoFornecedorController::class,'buscarCNPJ'])->name('buscarCNPJ');
    Route::resource('/fornecedor', GestaoFornecedorController::class);
    
    
    Route::get('/plano/{id}/perfis',[PlanoPerfilController::class,'perfil'])->name('plano.perfis');
    Route::any('plano/{id}/vincular',[PlanoPerfilController::class,'vincular'])->name('planoperfil.vincular');
    Route::post('/plano/{id}/perfil',[PlanoPerfilController::class,'vincularPerfil'])->name('plano.vincularPerfil');
    Route::resource("/planoperfil",PlanoPerfilController::class);
    
    
    Route::get('/plano/modulos/{id}',[PlanoController::class,'modulos'])->name('plano.modulos');
    Route::any('plano/{id}/vincular',[PlanoController::class,'vincular'])->name('plano.vincular');
    Route::get('/plano/precos/{id}',[PlanoController::class,'precos'])->name('plano.precos');    
    Route::get('/plano/editarPreco/{planopreco_id}',[PlanoController::class,'editarPreco'])->name('plano.editarPreco'); 
    Route::resource('/plano', PlanoController::class);
       
    Route::post('/plano/{id}/modulos',[PlanoModuloController::class,'vincularModulo'])->name('plano.vinculaModulo');
    Route::resource('/planomodulo', PlanoModuloController::class);
    
    
    Route::resource('/planoempresa', PlanoEmpresaController::class);
    
    Route::resource('/modulo', ModuloController::class);
    
    Route::post('/planopreco/buscarPlano/{plano_id}/{recorrencia_id}',[PlanoPrecoController::class,'buscarPlano'])->name('planopreco.buscarPlano'); 
    Route::resource('/planopreco', PlanoPrecoController::class);
    
    
    //Conta a Receber
    Route::get("/receber/filtro",[GestaoReceberController::class,"filtro"])->name("receber.filtro");
    Route::get("/receber/pormes",[GestaoReceberController::class,"pormes"])->name("receber.pormes");
    Route::get('/receber/detalhe/{id}',[GestaoReceberController::class,'detalhe'])->name('receber.detalhe');
    Route::get('/receber/faturar/{id}',[GestaoReceberController::class,'faturar'])->name('receber.faturar');
    Route::post('receber/receber',[GestaoReceberController::class,'receber'])->name('receber.receber');    
    Route::resource('/receber', GestaoReceberController::class);
    
    
    //Conta a Pagar
    Route::get("/pagar/filtro",[GestaoPagarController::class,"filtro"])->name("pagar.filtro");
    Route::get("/pagar/pormes",[GestaoPagarController::class,"pormes"])->name("pagar.pormes");
    Route::get('/pagar/detalhe/{id}',[GestaoPagarController::class,'detalhe'])->name('pagar.detalhe');
    Route::get('/pagar/faturar/{id}',[GestaoPagarController::class,'faturar'])->name('pagar.faturar');
    Route::post('pagar/pagar',[GestaoPagarController::class,'pagar'])->name('pagar.pagar');
    Route::resource('/pagar', GestaoPagarController::class);
    
    //Fatrua
    Route::get('fatura/confirmaFaturaPeloComprovante/{id}',[GestaoFaturaController::class, 'confirmaFaturaPeloComprovante'])->name('fatura.confirmaFaturaPeloComprovante');  
    Route::post('fatura/baixarPeloComprovante',[GestaoFaturaController::class, 'baixarPeloComprovante'])->name('fatura.baixarPeloComprovante');
    Route::get("/fatura/filtro",[GestaoFaturaController::class,"filtro"])->name("fatura.filtro");
    Route::get("/fatura/pormes",[GestaoFaturaController::class,"pormes"])->name("fatura.pormes");
    Route::get('/fatura/detalhe/{id}',[GestaoFaturaController::class,'detalhe'])->name('fatura.detalhe');    
    Route::get('/fatura/listaPorEmpresa/{id}',[GestaoFaturaController::class,'listaPorEmpresa'])->name('fatura.listaPorEmpresa');
    Route::get('/fatura/listaPorAssinatura/{id}',[GestaoFaturaController::class,'listaPorAssinatura'])->name('fatura.listaPorAssinatura');
    Route::get('/fatura/faturar/{id}',[GestaoFaturaController::class,'faturar'])->name('fatura.faturar');
    Route::post('fatura/pagar',[GestaoFaturaController::class,'pagar'])->name('fatura.pagar');
    Route::resource('/fatura', GestaoFaturaController::class);
    
    //Conta a Pagar
    Route::get("/despesa/filtro",[GestaoDespesaController::class,"filtro"])->name("despesa.filtro");
    Route::get("/despesa/pormes",[GestaoDespesaController::class,"pormes"])->name("despesa.pormes");
    Route::get('/despesa/detalhe/{id}',[GestaoDespesaController::class,'detalhe'])->name('despesa.detalhe');
    Route::get('/despesa/faturar/{id}',[GestaoDespesaController::class,'faturar'])->name('despesa.faturar');
    Route::post('despesa/pagar',[GestaoDespesaController::class,'pagar'])->name('despesa.pagar');
    Route::resource('/despesa', GestaoDespesaController::class);    
    
    Route::resource('/tipodespesa', TipoDespesaController::class);
    
    Route::get("/pagamento/filtro",[GestaoPagamentoController::class,"filtro"])->name("pagamento.filtro");
    Route::get("/pagamento/pormes",[GestaoPagamentoController::class,"pormes"])->name("pagamento.pormes");
    Route::resource("/pagamento",GestaoPagamentoController::class);
    
    Route::get("/recebimento/filtro",[GestaoRecebimentoController::class,"filtro"])->name("recebimento.filtro");
    Route::get("/recebimento/pormes",[GestaoRecebimentoController::class,"pormes"])->name("recebimento.pormes");
    Route::resource("/recebimento",GestaoRecebimentoController::class);
    
    
    Route::resource('/permissao', PermissaoController::class);
    Route::get('/perfil/permissao/{id}',[PerfilController::class,'permissao'])->name('perfil.permissao');
    
    Route::any('perfil/{id}/vincular',[PerfilController::class,'vincular'])->name('perfil.vincular');
    Route::resource('/perfil', PerfilController::class);
    
    Route::post('/perfil/{id}/permissao',[PerfilPermissaoController::class,'vincularPermissao'])->name('perfil.vincularPermissao');
    Route::resource("/perfilpermissao",PerfilPermissaoController::class);    
    Route::resource('/perfilusuario', PerfilUsuarioController::class);    
    
    Route::get('/usuario/perfis/{id}', [UsuarioController::class,'perfis'])->name('usuario.perfis');   
    Route::resource("/usuario", UserController::class);
});
