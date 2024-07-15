<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AutenticacaoController;
use App\Http\Controllers\Api\UsuariosController;
use App\Http\Controllers\Api\ProgramasController;
use App\Http\Controllers\Api\NoArController;
use App\Http\Controllers\Api\PedidosMusicaisController;
use App\Http\Controllers\Api\ListaDeMusicasController;
use App\Http\Controllers\Api\PodcastsController;
use App\Http\Controllers\Api\TopDeMusicasController;
use App\Http\Controllers\Api\MateriasController;
use App\Http\Controllers\Api\ReviewsController;
use App\Http\Controllers\Api\EventosController;
use App\Http\Controllers\Api\VideosDoYoutubeController;
use App\Http\Controllers\Api\BatalhaDePlaylistController;
use App\Http\Controllers\Api\OuvinteDoMesController;
use App\Http\Controllers\Api\FormulariosController;
use App\Http\Controllers\Api\TarefasController;
use App\Http\Controllers\Api\AvisosParaEquipeController;
use App\Http\Controllers\Api\CalendarioController;
use App\Http\Controllers\Api\RepositorioDeArquivosController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('autenticacao/login', [AutenticacaoController::class, 'login']);
Route::prefix('autenticacao')->middleware('auth:sanctum')->group(function () {
    Route::get('/logged', [AutenticacaoController::class, 'logado']);
    Route::post('/logout', [AutenticacaoController::class, 'deslogar']);
});

Route::get('usuarios', [UsuariosController::class, 'retornaTodosUsuarios']);
Route::get('usuarios/{slug}', [UsuariosController::class, 'retornaUsuarioEspecifico']);
Route::prefix('usuarios')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [UsuariosController::class, 'cadastrarUsuario']);
    Route::patch('/update/{slug}', [UsuariosController::class, 'atualizaUsuarioEspecifico']);
    Route::delete('/delete/{id}', [UsuariosController::class, 'removerUsuarioEspecifico']);
});

Route::get('programas', [ProgramasController::class, 'retornaTodosProgramas']);
Route::get('programas/{slug}', [ProgramasController::class, 'retornaProgramaEspecifico']);
Route::prefix('programas')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [ProgramasController::class, 'cadastraPrograma']);
    Route::patch('/update/{slug}', [ProgramasController::class, 'atualizaProgramaEspecifico']);
    Route::delete('/delete/{id}', [ProgramasController::class, 'removerProgramaEspecifico']);
});

Route::get('noar', [NoArController::class, 'retornaTodosOsRegistrosDoNoAr']);
Route::get('noar/{id}', [NoArController::class, 'retornaRegistroEspecificoDoNoAr']);
Route::prefix('noar')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [NoArController::class, 'cadastraRegistroDoNoAr']);
    Route::patch('/update/{id}', [NoArController::class, 'atualizaRegistroEspecificoDoNoAr']);
    Route::delete('/delete/{id}', [NoArController::class, 'removerRegistroEspecificoDoNoAr']);
});

Route::get('pedidosmusicais', [PedidosMusicaisController::class, 'retornaTodosPedidosMusicais']);
Route::get('pedidosmusicais/{id}', [PedidosMusicaisController::class, 'retornaPedidoMusicalEspecifico']);
Route::prefix('pedidosmusicais')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [PedidosMusicaisController::class, 'cadastraPedidoMusical']);
    Route::patch('/update/{id}', [PedidosMusicaisController::class, 'atualizaPedidoMusicalEspecifico']);
    Route::delete('/delete/{id}', [PedidosMusicaisController::class, 'removerPedidoMusicalEspecifico']);
});

Route::get('musicas', [ListaDeMusicasController::class, 'retornaTodasMusicas']);
Route::get('musicas/{id}', [ListaDeMusicasController::class, 'retornaMusicaEspecifica']);
Route::prefix('musicas')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [ListaDeMusicasController::class, 'cadastraMusica']);
    Route::patch('/update/{id}', [ListaDeMusicasController::class, 'atualizaMusicaEspecifica']);
    Route::delete('/delete/{id}', [ListaDeMusicasController::class, 'removerMusicaEspecifica']);
});

Route::get('podcasts', [PodcastsController::class, 'retornaTodosPodcasts']);
Route::get('podcasts/{slug}', [PodcastsController::class, 'retornaPodcastEspecifico']);
Route::prefix('podcasts')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [PodcastsController::class, 'cadastraPodcast']);
    Route::patch('/update/{slug}', [PodcastsController::class, 'atualizaPodcastEspecifico']);
    Route::delete('/delete/{id}', [PodcastsController::class, 'removerPodcastEspecifico']);
});

Route::get('topdemusicas', [TopDeMusicasController::class, 'retornaTodosTopDeMusicas']);
Route::get('topdemusicas/{id}', [TopDeMusicasController::class, 'retornaTopDeMusicaEspecifico']);
Route::prefix('topdemusicas')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [TopDeMusicasController::class, 'cadastraTopDeMusica']);
    Route::patch('/update/{id}', [TopDeMusicasController::class, 'atualizaTopDeMusicaEspecifico']);
    Route::delete('/delete/{id}', [TopDeMusicasController::class, 'removerTopDeMusicaEspecifico']);
});

Route::get('materias', [MateriasController::class, 'retornaTodasMaterias']);
Route::get('materias/{slug}', [MateriasController::class, 'retornaMateriaEspecifica']);
Route::prefix('materias')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [MateriasController::class, 'cadastraMateria']);
    Route::patch('/update/{slug}', [MateriasController::class, 'atualizaMateriaEspecifica']);
    Route::delete('/delete/{id}', [MateriasController::class, 'removerMateriaEspecifica']);
});

Route::get('reviews', [ReviewsController::class, 'retornaTodosReviews']);
Route::get('reviews/{slug}', [ReviewsController::class, 'retornaReviewEspecifico']);
Route::prefix('reviews')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [ReviewsController::class, 'cadastraReview']);
    Route::patch('/update/{slug}', [ReviewsController::class, 'atualizaReviewEspecifico']);
    Route::delete('/delete/{id}', [ReviewsController::class, 'removerReviewEspecifico']);
});

Route::get('eventos', [EventosController::class, 'retornaTodosEventos']);
Route::get('eventos/{slug}', [EventosController::class, 'retornaEventoEspecifico']);
Route::prefix('eventos')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [EventosController::class, 'cadastraEvento']);
    Route::patch('/update/{slug}', [EventosController::class, 'atualizaEventoEspecifico']);
    Route::delete('/delete/{id}', [EventosController::class, 'removerEventoEspecifico']);
});

Route::get('videos', [VideosDoYoutubeController::class, 'retornaTodosVideos']);
Route::get('videos/{id}', [VideosDoYoutubeController::class, 'retornaVideoEspecifico']);
Route::prefix('videos')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [VideosDoYoutubeController::class, 'cadastraVideo']);
    Route::patch('/update/{id}', [VideosDoYoutubeController::class, 'atualizaVideoEspecifico']);
    Route::delete('/delete/{id}', [VideosDoYoutubeController::class, 'removerVideoEspecifico']);
});

Route::get('batalhadoplaylist', [BatalhaDePlaylistController::class, 'retornaBatalhaDePlaylistEspecifica']);
Route::prefix('batalhadoplaylist')->middleware('auth:sanctum')->group(function(){
    Route::patch('/update', [BatalhaDePlaylistController::class, 'atualizaBatalhaDePlaylistEspecifica']);
});

Route::get('ouvintesdomes', [OuvinteDoMesController::class, 'retornaOuvinteDoMesEspecifico']);
Route::prefix('videos')->middleware('auth:sanctum')->group(function(){
    Route::patch('/update', [OuvinteDoMesController::class, 'atualizaOuvinteDoMesEspecifico']);
});

Route::get('formularios', [FormulariosController::class, 'retornaTodosFormularios']);
Route::get('formularios/{id}', [FormulariosController::class, 'retornaFormularioEspecifico']);
Route::prefix('formularios')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [FormulariosController::class, 'cadastraFormulario']);
    Route::patch('/update/{id}', [FormulariosController::class, 'atualizaFormularioEspecifico']);
    Route::delete('/delete/{id}', [FormulariosController::class, 'removerFormularioEspecifico']);
});

Route::get('tarefas', [TarefasController::class, 'retornaTodasTarefas']);
Route::get('tarefas/{id}', [TarefasController::class, 'retornaTarefaEspecifica']);
Route::prefix('tarefas')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [TarefasController::class, 'cadastraTarefa']);
    Route::patch('/update/{id}', [TarefasController::class, 'atualizaTarefaEspecifica']);
    Route::delete('/delete/{id}', [TarefasController::class, 'removerTarefaEspecifica']);
});

Route::get('avisos', [AvisosParaEquipeController::class, 'retornaTodosOsAvisosParaEquipe']);
Route::get('avisos/{id}', [AvisosParaEquipeController::class, 'retornaAvisoParaEquipeEspecifico']);
Route::prefix('avisos')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [AvisosParaEquipeController::class, 'cadastraAvisoParaEquipe']);
    Route::patch('/update/{id}', [AvisosParaEquipeController::class, 'atualizaAvisoParaEquipeEspecifico']);
    Route::delete('/delete/{id}', [AvisosParaEquipeController::class, 'removerAvisoParaEquipeEspecifico']);
});

Route::get('calendario', [CalendarioController::class, 'retornaTodoCalendarioDeEventos']);
Route::get('calendario/{id}', [CalendarioController::class, 'retornaEventoDoCalendarioEspecifico']);
Route::prefix('calendario')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [CalendarioController::class, 'cadastraEventoNoCalendario']);
    Route::patch('/update/{id}', [CalendarioController::class, 'atualizaEventoDoCalendarioEspecifico']);
    Route::delete('/delete/{id}', [CalendarioController::class, 'removerEventoDoCalendarioEspecifico']);
});

Route::get('repositorio', [RepositorioDeArquivosController::class, 'retornaTodoRepositorio']);
Route::get('repositorio/{id}', [RepositorioDeArquivosController::class, 'retornaArquivoDoRepositorioEspecifico']);
Route::prefix('repositorio')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [RepositorioDeArquivosController::class, 'cadastraArquivoNoRepositorio']);
    Route::patch('/update/{id}', [RepositorioDeArquivosController::class, 'atualizaArquivoDoRepositorioEspecifico']);
    Route::delete('/delete/{id}', [RepositorioDeArquivosController::class, 'removerArquivoDoRepositorioEspecifico']);
});