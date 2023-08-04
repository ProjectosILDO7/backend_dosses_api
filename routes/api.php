<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\funcionarioController;
use App\Http\Controllers\ImagemController;
use App\Http\Controllers\MensagemExternaController;
use App\Http\Controllers\MostrarContactoAoClienteController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\RegisterControllerUser;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\ImagensClienteCarrosselController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);

});
Route::post('/forget-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');

Route::post('/registerUser', [RegisterControllerUser::class, 'crear']);
Route::put('/updateuser', [RegisterControllerUser::class, 'updateUser'])->middleware('api');

Route::get('/categorias', [CategoriaController::class, 'index'])->middleware('api');
Route::post('/filter', [CategoriaController::class, 'filter'])->middleware('api');
Route::post('/registerCategoria', [CategoriaController::class, 'store'])->middleware('api');
Route::get('/getCategoria/{id}', [CategoriaController::class, 'edit'])->middleware('api');
Route::put('/updateCategoria/{id}', [CategoriaController::class, 'update'])->middleware('api');
Route::get('/apagarCategoria/{id}', [CategoriaController::class, 'destroy'])->middleware('api');
Route::get('/detalhesCategoria/{id}', [CategoriaController::class, 'show'])->middleware('api');

Route::get('/produtos', [ProdutoController::class, 'index'])->middleware('api');
Route::get('/produtosClientes', [ProdutoController::class, 'produtosClientes'])->middleware('api');
Route::post('/filter', [ProdutoController::class, 'filter'])->middleware('api');

Route::post('/registerProduto', [ProdutoController::class, 'store'])->middleware('api');
Route::get('/getProduto/{id}', [ProdutoController::class, 'edit'])->middleware('api');
Route::put('/updateProduto/{id}', [ProdutoController::class, 'update'])->middleware('api');
Route::get('/apagarProduto/{id}', [ProdutoController::class, 'destroy'])->middleware('api');
Route::put('/inativar/{id}', [ProdutoController::class, 'inativar'])->middleware('api');
Route::put('/activo/{id}', [ProdutoController::class, 'activo'])->middleware('api');

Route::get('/getFuncionario/{id}', [funcionarioController::class, 'edit'])->middleware('api');
Route::put('/updateFuncionario/{id}', [funcionarioController::class, 'update'])->middleware('api');
Route::put('/updateCliente2/{id}', [funcionarioController::class, 'update2'])->middleware('api');
Route::get('/apagarFuncionario/{id}', [funcionarioController::class, 'destroy'])->middleware('api');
Route::get('/detalhesFuncionario/{id}', [funcionarioController::class, 'detalhesClientes'])->middleware('api');

Route::get('/clientes', [funcionarioController::class, 'getClientes'])->middleware('api');
Route::get('/getClientePeloAdmin/{id}', [funcionarioController::class, 'getClientePeloAdmin']);
Route::get('/reservas', [funcionarioController::class, 'getReservas'])->middleware('api');
Route::get('/minhas_reservas', [funcionarioController::class, 'getMinhas_Reservas'])->middleware('api');
Route::get('/criar_reserva/{id}', [funcionarioController::class, 'criar_reserva'])->middleware('api');

//Route::put('/imageLoading', [ProdutoController::class, 'activo'])->middleware('api');

Route::get('/detalhesProdutoRF/{id}', [ProdutoController::class, 'show'])->middleware('api');
Route::get('/detalhesProduto/{id}', [ProdutoController::class, 'detalhesClientes'])->middleware('api');
Route::get('/pedirProduto/{id}', [ProdutoController::class, 'pedirProduto'])->middleware('api');

Route::get('/getProdutosPagamento/{id}', [ProdutoController::class, 'show'])->middleware('api');
Route::get('/ExportToExcelListaPagamento/{user}', [ExportExcelController::class, 'exportListaPagamento'])->middleware('api');

Route::post('/registerImage', [ImagemController::class, 'createImage'])->middleware('api');
Route::get('/Images', [ImagemController::class, 'Images'])->middleware('api');
Route::get('/detalhesImage/{id}', [ImagemController::class, 'detalhes'])->middleware('api');
Route::get('/apagarImage/{id}', [ImagemController::class, 'apagarImagem'])->middleware('api');

Route::get('/pageContacto', [ContactoController::class, 'pageContacto'])->middleware('api');
Route::get('/getContactoEmpresa', [MostrarContactoAoClienteController::class, 'getContactoEmpresa']);

Route::post('/createContacto', [ContactoController::class, 'createContacto'])->middleware('api');
Route::get('/updatePageContacto/{id}', [ContactoController::class, 'updatePageContacto'])->middleware('api');
Route::put('/updatePageContactoForm/{contacto}', [ContactoController::class, 'updatePageContactoForm'])->middleware('api');

Route::get('/getConteudoSobre', [SobreController::class, 'getConteudoSobre'])->middleware('api');
Route::post('/savePageSobre', [SobreController::class, 'savePageSobre'])->middleware('api');
Route::get('/updateSavePageSobre/{id}', [SobreController::class, 'updateSavePageSobre'])->middleware('api');
Route::put('/updateSobreConteudoForm/{contacto}', [SobreController::class, 'updateSobreConteudoForm'])->middleware('api');
Route::put('/updateSobreConteudo/{contacto}', [SobreController::class, 'updateSobreConteudo'])->middleware('api');

Route::post('/sendMessage', [MensagemExternaController::class, 'create']);

Route::get('/meus_pedidos', [PedidosController::class, 'index'])->middleware('api');

Route::get('/buscar_meu_pedido/{id}', [PedidosController::class, 'buscar_meu_pedido'])->middleware('api');
Route::get('/desfazerPedido/{id}', [PedidosController::class, 'desfazerPedido'])->middleware('api');
Route::get('/pedidos', [PedidosController::class, 'pedidos'])->middleware('api');
Route::get('/mensagens', [PedidosController::class, 'mensagem'])->middleware('api');
Route::get('/marcarLida/{id}', [PedidosController::class, 'marcarLida'])->middleware('api');

Route::get('/notifys', [PedidosController::class, 'index'])->middleware('api');
Route::get('/marcarLidaNotify/{id}', [PedidosController::class, 'marcarLidaNotify'])->middleware('api');
Route::get('/detalhes_pedido/{id}', [PedidosController::class, 'detalhes_pedido'])->middleware('api');
Route::get('/marcarLidaNotify/{id}', [PedidosController::class, 'marcarLidaNotify'])->middleware('api');

Route::get('/loadingImagensCliente', [ImagensClienteCarrosselController::class, 'index'])->middleware('api');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
