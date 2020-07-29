<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Pedido;
use App\Productos;

class ProductosController extends Controller
{
	/*
	 * Retorna el listado de todos los productos
	 */
	public function listarProductos(Request $req){
		return Productos::orderBy("producto_nombre", "asc")->get()->toJson();
	}

	/*
	 * Crea un nuevo producto.
	 * Si el producto ya existe retorna un mensaje avisando.
	 */
	public function crearProducto(Request $req){
		$codigoRespuesta = '';
		$jsonRespuesta = json_decode('{}');
		$producto = Productos::where('producto_nombre',$req->nombre)->get();
		if($producto->count() == 0){
			$nuevoProducto = new Productos();
			$nuevoProducto->producto_nombre = $req->nombre;
			$nuevoProducto->producto_cantidad = $req->cantidad;
			$nuevoProducto->producto_num_lote = $req->lote;
			$nuevoProducto->producto_fecha_vencimiento = $req->fecha_vencimiento;
			$nuevoProducto->producto_precio = $req->precio;
			$nuevoProducto->save();
			$codigoRespuesta = 200;
			$jsonRespuesta = [
				'exito-mensaje' => 'Se ha creado el producto correctamente.',
				'exito-codigo' => "ProdCrear-1"
			];
		}
		else{
			$codigoRespuesta = 200;
			$jsonRespuesta = [
				'error-mensaje' => 'El producto ya existe.',
				'error-codigo' => "ProdCrear-2"
			];
		}
		return response()->json($jsonRespuesta, $codigoRespuesta);
	}

	/*
	 * Modifica un producto.
	 * Si el producto no existe retorna un mensaje avisando.
	 */
	public function modificarProducto($id, Request $req){
		$codigoRespuesta = '';
		$jsonRespuesta = json_decode('{}');
		$producto = Productos::where('producto_id',$id)->first();
		if($producto->count() != 0){
			$producto->producto_nombre = $req->nombre;
			$producto->producto_cantidad = $req->cantidad;
			$producto->producto_num_lote = $req->lote;
			$producto->producto_fecha_vencimiento = $req->fecha_vencimiento;
			$producto->producto_precio = $req->precio;
			$producto->save();
			$codigoRespuesta = 200;
			$jsonRespuesta = [
				'exito-mensaje' => 'Se ha actualizado el producto correctamente.',
				'exito-codigo' => "ProdModificar-1"
			];
		}
		else{
			$codigoRespuesta = 200;
			$jsonRespuesta = [
				'error-mensaje' => 'El producto no existe.',
				'error-codigo' => "ProdModificar-2"
			];
		}
		return response()->json($jsonRespuesta, $codigoRespuesta);
	}


	/*
	 * Compra el producto y actualiza el inventario.
	 */
	public function comprarProducto(Request $req){
		$codigoRespuesta = '';
		$jsonRespuesta = json_decode('{}');
		if(empty($req->producto) || empty($req->cantidad) || empty($req->cliente)){
			$codigoRespuesta = 400;
			$jsonRespuesta = [
				'error-mensaje' => 'Parámetros incompletos',
				'error-codigo' => "ProdComprar-1"
			];
		}
		else{
			$producto = Productos::where("producto_id",$req->producto)->first();
			if($producto){

				$producto->producto_cantidad = intval($producto->producto_cantidad) - intval($req->cantidad);
				$producto->save();
				$total = floatval($producto->producto_precio) * intval($req->cantidad);

				$nuevoPedido = new Pedido();
				$nuevoPedido->cliente_id = $req->cliente;
				$nuevoPedido->producto_id = $producto->producto_id;
				$nuevoPedido->pedido_fecha = Carbon::now()->format("Y-m-d");
				$nuevoPedido->pedido_cantidad = $req->cantidad;
				$nuevoPedido->pedido_total = $total;
				$nuevoPedido->save();
				$codigoRespuesta = 200;
				$jsonRespuesta = [
					'exito-mensaje' => 'Se ha creado el pedido.',
					'exito-codigo' => "ProdComprar-2"
				];

			}
			else{
				$codigoRespuesta = 200;
				$jsonRespuesta = [
					'error-mensaje' => 'No se encontró el producto.',
					'error-codigo' => "ProdComprar-3"
				];
			}
		}
		return response()->json($jsonRespuesta, $codigoRespuesta);
	}

}
