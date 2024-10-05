<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProgramasController;
use App\Http\Controllers\NoArController;
use App\Http\Controllers\PedidosMusicaisController;
use App\Http\Controllers\ListaDeMusicasController;
use App\Http\Controllers\PodcastsController;
use App\Http\Controllers\TopDeMusicasController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\VideosDoYoutubeController;
use App\Http\Controllers\BatalhaDePlaylistController;
use App\Http\Controllers\OuvinteDoMesController;
use App\Http\Controllers\FormulariosController;
use App\Http\Controllers\TarefasController;
use App\Http\Controllers\AvisosParaEquipeController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\RepositorioDeArquivosController;


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
Route::prefix('autenticacao')->group(function () {
    Route::post('/logado', [AutenticacaoController::class, 'logado']);
    Route::post('/deslogar', [AutenticacaoController::class, 'deslogar']);
});

Route::get('usuarios', [UsuariosController::class, 'retornaTodosUsuarios']);
Route::get('usuarios/{slug}', [UsuariosController::class, 'retornaUsuarioEspecifico']);
Route::prefix('usuarios')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [UsuariosController::class, 'cadastrarUsuario']);
    Route::put('/update/{slug}', [UsuariosController::class, 'atualizaUsuarioEspecifico']);
    Route::delete('/delete/{id}', [UsuariosController::class, 'removerUsuarioEspecifico']);
});

Route::get('programas', [ProgramasController::class, 'retornaTodosProgramas']);
Route::get('programas/{slug}', [ProgramasController::class, 'retornaProgramaEspecifico']);
Route::prefix('programas')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [ProgramasController::class, 'cadastraPrograma']);
    Route::put('/update/{slug}', [ProgramasController::class, 'atualizaProgramaEspecifico']);
    Route::delete('/delete/{id}', [ProgramasController::class, 'removerProgramaEspecifico']);
});

Route::get('noar', [NoArController::class, 'retornaTodosOsRegistrosDoNoAr']);
Route::get('noar/{id}', [NoArController::class, 'retornaRegistroEspecificoDoNoAr']);
Route::prefix('noar')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [NoArController::class, 'cadastraRegistroDoNoAr']);
    Route::put('/update/{id}', [NoArController::class, 'atualizaRegistroEspecificoDoNoAr']);
    Route::delete('/delete/{id}', [NoArController::class, 'removerRegistroEspecificoDoNoAr']);
});

Route::get('pedidosmusicais', [PedidosMusicaisController::class, 'retornaTodosPedidosMusicais']);
Route::get('pedidosmusicais/{id}', [PedidosMusicaisController::class, 'retornaPedidoMusicalEspecifico']);
Route::prefix('pedidosmusicais')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [PedidosMusicaisController::class, 'cadastraPedidoMusical']);
    Route::put('/update/{id}', [PedidosMusicaisController::class, 'atualizaPedidoMusicalEspecifico']);
    Route::delete('/delete/{id}', [PedidosMusicaisController::class, 'removerPedidoMusicalEspecifico']);
});

Route::get('musicas', [ListaDeMusicasController::class, 'retornaTodasMusicas']);
Route::get('musicas/{id}', [ListaDeMusicasController::class, 'retornaMusicaEspecifica']);
Route::prefix('musicas')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [ListaDeMusicasController::class, 'cadastraMusica']);
    Route::put('/update/{id}', [ListaDeMusicasController::class, 'atualizaMusicaEspecifica']);
    Route::delete('/delete/{id}', [ListaDeMusicasController::class, 'removerMusicaEspecifica']);
});

Route::get('podcasts', [PodcastsController::class, 'retornaTodosPodcasts']);
Route::get('podcasts/{slug}', [PodcastsController::class, 'retornaPodcastEspecifico']);
Route::prefix('podcasts')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [PodcastsController::class, 'cadastraPodcast']);
    Route::put('/update/{slug}', [PodcastsController::class, 'atualizaPodcastEspecifico']);
    Route::delete('/delete/{id}', [PodcastsController::class, 'removerPodcastEspecifico']);
});

Route::get('topdemusicas', [TopDeMusicasController::class, 'retornaTodosTopDeMusicas']);
Route::get('topdemusicas/{id}', [TopDeMusicasController::class, 'retornaTopDeMusicaEspecifico']);
Route::prefix('topdemusicas')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [TopDeMusicasController::class, 'cadastraTopDeMusica']);
    Route::put('/update/{id}', [TopDeMusicasController::class, 'atualizaTopDeMusicaEspecifico']);
    Route::delete('/delete/{id}', [TopDeMusicasController::class, 'removerTopDeMusicaEspecifico']);
});

Route::get('materias', [MateriasController::class, 'retornaTodasMaterias']);
Route::get('materias/{slug}', [MateriasController::class, 'retornaMateriaEspecifica']);
Route::prefix('materias')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [MateriasController::class, 'cadastraMateria']);
    Route::put('/update/{slug}', [MateriasController::class, 'atualizaMateriaEspecifica']);
    Route::delete('/delete/{id}', [MateriasController::class, 'removerMateriaEspecifica']);
});

Route::get('reviews', [ReviewsController::class, 'retornaTodosReviews']);
Route::get('reviews/{slug}', [ReviewsController::class, 'retornaReviewEspecifico']);
Route::prefix('reviews')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [ReviewsController::class, 'cadastraReview']);
    Route::put('/update/{slug}', [ReviewsController::class, 'atualizaReviewEspecifico']);
    Route::delete('/delete/{id}', [ReviewsController::class, 'removerReviewEspecifico']);
});

Route::get('eventos', [EventosController::class, 'retornaTodosEventos']);
Route::get('eventos/{slug}', [EventosController::class, 'retornaEventoEspecifico']);
Route::prefix('eventos')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [EventosController::class, 'cadastraEvento']);
    Route::put('/update/{slug}', [EventosController::class, 'atualizaEventoEspecifico']);
    Route::delete('/delete/{id}', [EventosController::class, 'removerEventoEspecifico']);
});

Route::get('videosdoyoutube', [VideosDoYoutubeController::class, 'retornaTodosVideos']);
Route::get('videosdoyoutube/{id}', [VideosDoYoutubeController::class, 'retornaVideoEspecifico']);
Route::prefix('videosdoyoutube')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [VideosDoYoutubeController::class, 'cadastraVideo']);
    Route::put('/update/{id}', [VideosDoYoutubeController::class, 'atualizaVideoEspecifico']);
    Route::delete('/delete/{id}', [VideosDoYoutubeController::class, 'removerVideoEspecifico']);
});

Route::get('batalhadeplaylist', [BatalhaDePlaylistController::class, 'retornaBatalhaDePlaylistEspecifica']);
Route::prefix('batalhadeplaylist')->middleware('auth:sanctum')->group(function(){
    Route::put('/update', [BatalhaDePlaylistController::class, 'atualizaBatalhaDePlaylistEspecifica']);
});

Route::get('ouvintedomes', [OuvinteDoMesController::class, 'retornaOuvinteDoMesEspecifico']);
Route::prefix('ouvintedomes')->middleware('auth:sanctum')->group(function(){
    Route::put('/update', [OuvinteDoMesController::class, 'atualizaOuvinteDoMesEspecifico']);
});

Route::get('formularios', [FormulariosController::class, 'retornaTodosFormularios']);
Route::get('formularios/{id}', [FormulariosController::class, 'retornaFormularioEspecifico']);
Route::prefix('formularios')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [FormulariosController::class, 'cadastraFormulario']);
    Route::put('/update/{id}', [FormulariosController::class, 'atualizaFormularioEspecifico']);
    Route::delete('/delete/{id}', [FormulariosController::class, 'removerFormularioEspecifico']);
});

Route::get('tarefas', [TarefasController::class, 'retornaTodasTarefas']);
Route::get('tarefas/{id}', [TarefasController::class, 'retornaTarefaEspecifica']);
Route::prefix('tarefas')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [TarefasController::class, 'cadastraTarefa']);
    Route::put('/update/{id}', [TarefasController::class, 'atualizaTarefaEspecifica']);
    Route::delete('/delete/{id}', [TarefasController::class, 'removerTarefaEspecifica']);
});

Route::get('avisosparaequipe', [AvisosParaEquipeController::class, 'retornaTodosOsAvisosParaEquipe']);
Route::get('avisosparaequipe/{id}', [AvisosParaEquipeController::class, 'retornaAvisoParaEquipeEspecifico']);
Route::prefix('avisosparaequipe')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [AvisosParaEquipeController::class, 'cadastraAvisoParaEquipe']);
    Route::put('/update/{id}', [AvisosParaEquipeController::class, 'atualizaAvisoParaEquipeEspecifico']);
    Route::delete('/delete/{id}', [AvisosParaEquipeController::class, 'removerAvisoParaEquipeEspecifico']);
});

Route::get('calendario', [CalendarioController::class, 'retornaTodoCalendarioDeEventos']);
Route::get('calendario/{id}', [CalendarioController::class, 'retornaEventoDoCalendarioEspecifico']);
Route::prefix('calendario')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [CalendarioController::class, 'cadastraEventoNoCalendario']);
    Route::put('/update/{id}', [CalendarioController::class, 'atualizaEventoDoCalendarioEspecifico']);
    Route::delete('/delete/{id}', [CalendarioController::class, 'removerEventoDoCalendarioEspecifico']);
});

Route::get('repositoriodearquivos', [RepositorioDeArquivosController::class, 'retornaTodoRepositorio']);
Route::get('repositoriodearquivos/{id}', [RepositorioDeArquivosController::class, 'retornaArquivoDoRepositorioEspecifico']);
Route::prefix('repositoriodearquivos')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [RepositorioDeArquivosController::class, 'cadastraArquivoNoRepositorio']);
    Route::put('/update/{id}', [RepositorioDeArquivosController::class, 'atualizaArquivoDoRepositorioEspecifico']);
    Route::delete('/delete/{id}', [RepositorioDeArquivosController::class, 'removerArquivoDoRepositorioEspecifico']);
});