<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
	protected $table = 'pedido';
	protected $primaryKey = 'pedido_id';
	public $timestamps = false;

	protected $fillable = [
		'cliente_id',
		'producto_id',
		'pedido_fecha',
		'pedido_cantidad',
		'pedido_total',
	];

	public function cliente(){
		return $this->hasOne("App\Clientes", "cliente_id", "cliente_id");
	}

	public function producto(){
		return $this->hasOne("App\Productos", "producto_id", "producto_id");
	}
}
