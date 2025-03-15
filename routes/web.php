<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\TorniquetesController;
use App\Http\Controllers\AccesosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'mostrarFormularioLogin'])->name('iniciar_sesion');
Route::post('/iniciar-sesion', [AuthController::class, 'iniciarSesion'])->name('iniciar_sesion.post');
Route::post('/logout', [AuthController::class, 'cerrarSesion'])->name('cerrar_sesion');

Route::get('/registrarse', [AuthController::class, 'mostrarFormularioRegistro'])->name('registrarse');
Route::post('/registrarse', [AuthController::class, 'registrarse'])->name('registrarse.post');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/visitante/dashboard', function () {
    return view('visitante.dashboard');
})->name('visitante.dashboard');

Route::get('/alumno/dashboard', function () {
    return view('alumno.dashboard');
})->name('alumno.dashboard');

Route::view('/about', 'about')->name('about');
Route::view('/contactanos', 'contactanos')->name('contactanos');
Route::view('/codigo', 'codigo')->name('codigo');



Route::get('/usuarios', [UsuariosController::class, 'getData'])->name('usuarios');
Route::get('/usuarios/{id}', [UsuariosController::class, 'getData2'])->name('detalle_usuario');
Route::get('/admin/usuarios/crear', [UsuariosController::class, 'create'])->name('crear_usuario');
Route::post('/usuarios', [UsuariosController::class, 'postData'])->name('guardar_usuario');
Route::get('/usuarios/{id}/editar', [UsuariosController::class, 'editData'])->name('editar_usuario');
Route::put('/usuarios/{id}', [UsuariosController::class, 'updateData'])->name('actualizar_usuario');
Route::delete('/usuarios/{id}', [UsuariosController::class, 'deleteData'])->name('eliminar_usuario');



Route::get('/torniquetes', [TorniquetesController::class, 'getData'])->name('torniquetes');
Route::get('/torniquetes/{id}', [TorniquetesController::class, 'getData2'])->name('detalle_torniquete');
Route::get('/crear', [TorniquetesController::class, 'create'])->name('torniquetes_crear');
Route::post('/torniquetes', [TorniquetesController::class, 'postData'])->name('guardar_torniquete');
Route::get('/torniquetes/{id}/editar', [TorniquetesController::class, 'editData'])->name('editar_torniquete');
Route::put('/torniquetes/{id}', [TorniquetesController::class, 'updateData'])->name('actualizar_torniquete');
Route::delete('/torniquetes/{id}', [TorniquetesController::class, 'deleteData'])->name('eliminar_torniquete');


Route::prefix('accesos')->group(function () {
    Route::get('/', [AccesosController::class, 'index'])->name('accesos');
    Route::get('/crear', [AccesosController::class, 'create'])->name('accesos_crear');
    Route::post('/', [AccesosController::class, 'store'])->name('accesos.store');
    Route::get('/{id}', [AccesosController::class, 'show'])->name('accesos.show');
    Route::get('/{id}/editar', [AccesosController::class, 'edit'])->name('accesos.edit');
    Route::put('/{id}', [AccesosController::class, 'update'])->name('accesos.update');
    Route::delete('/{id}', [AccesosController::class, 'destroy'])->name('accesos.destroy');
});

Route::post('/usuarios/import', [UsuariosController::class, 'importExcel'])->name('importar.usuarios');
Route::post('/torniquetes/import', [TorniquetesController::class, 'importExcel'])->name('importar.torniquetes');
Route::post('/importar-accesos', [AccesosController::class, 'import'])->name('import.accesos');

// routes/web.php
// routes/web.php
Route::get('/torniquetes/import', [TorniquetesController::class, 'exportExcel'])->name('exportar.torniquetes');


Route::get('/export-excel', [TorniquetesController::class, 'exportExcel'])->name('torniquetes.export');

Route::get('/usuarios-exportar', [UsuariosController::class, 'exportExcel'])->name('usuarios.export');

Route::get('/exportar', [AccesosController::class, 'exportExcel'])->name('accesos.export');


Route::get('/usuarios-grafica', [UsuariosController::class, 'showGraph'])->name('usuarios.grafica');

Route::get('/torniquetes-grafica', [TorniquetesController::class, 'showGraph'])->name('torniquetes.grafica');

Route::get('/accesos-grafica', [AccesosController::class, 'showGraph'])->name('accesos.graficas');
