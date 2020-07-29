<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
	protected $table = 'productos';
	protected $primaryKey = 'producto_id';
	public $timestamps = false;

	protected $fillable = [
		'producto_nombre',
		'producto_cantidad',
		'producto_num_lote',
		'producto_fecha_vencimiento',
		'producto_precio'
	];
}
