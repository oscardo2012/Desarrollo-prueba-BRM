<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pedido;

class PedidosController extends Controller
{
	/*
	 * Retorna el listado de pedidos asociando los datos del cliente y el producto
	 */
	public function listarPedidos(){
		return Pedido::with("cliente", "producto")->get()->toJson();
	}

	/*
	 * Elimina un pedido y agrega el producto al inventario
	 */
	public function eliminarPedido($id){
		$codigoRespuesta = '';
		$jsonRespuesta = json_decode('{}');
		if(empty($id)){
			$codigoRespuesta = 400;
			$jsonRespuesta = [
				'error-mensaje' => 'Parámetros incompletos.',
				'error-codigo' => "PedidoEliminar-1"
			];
		}
		else{
			$pedido = Pedido::where("pedido_id",$id)->with("producto")->first();
			if(!$pedido){
				$codigoRespuesta = 200;
				$jsonRespuesta = [
					'error-mensaje' => 'El pedido no existe.',
					'error-codigo' => "PedidoEliminar-2"
				];
			}
			else{
				$producto = $pedido->producto;
				$producto->producto_cantidad = intval($producto->producto_cantidad) + intval($pedido->pedido_cantidad);
				$producto->save();
				$pedido->delete();
				$codigoRespuesta = 200;
				$jsonRespuesta = [
					'exito-mensaje' => 'El pedido se elimino correctamente.',
					'exito-codigo' => "PedidoEliminar-3"
				];
			}
		}
		return response()->json($jsonRespuesta, $codigoRespuesta);
	}
}
