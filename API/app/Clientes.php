<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
	protected $table = 'clientes';
	protected $primaryKey = 'cliente_id';
	public $timestamps = false;

	protected $fillable = [
		'cliente_nombre',
		'cliente_direccion',
		'cliente_telefono',
		'cliente_email',
	];

	public function pedidos(){
		return $this->hasMany('App\Pedido','cliente_id','cliente_id');
	}
}
