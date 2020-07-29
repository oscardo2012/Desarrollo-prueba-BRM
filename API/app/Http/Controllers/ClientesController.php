<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clientes;

class ClientesController extends Controller
{
	public function listaClientes(){
		return Clientes::orderBy("cliente_nombre", "asc")->get()->toJson();
	}
}
