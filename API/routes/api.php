<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'productos', 'middleware' => ['cors']], function(){
	Route::get('/', ['uses' => 'ProductosController@listarProductos']);
	Route::post('/crear', ['uses' => 'ProductosController@crearProducto']);
	Route::post('/{id}/modificar', ['uses' => 'ProductosController@modificarProducto']);
	Route::post('/comprar', ['uses' => 'ProductosController@comprarProducto']);
});

Route::group(['prefix' => 'clientes'], function(){
	Route::get('/', ['uses' => 'ClientesController@listaClientes']);
});

Route::group(['prefix' => 'pedidos', 'middleware' => ['cors']], function(){
	Route::get('/', ['uses' => 'PedidosController@listarPedidos']);
	Route::post('/{id}/eliminar', ['uses' => 'PedidosController@eliminarPedido']);
});
