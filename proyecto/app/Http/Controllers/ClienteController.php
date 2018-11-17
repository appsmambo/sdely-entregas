<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postGrabarCliente(Request $request)
    {
        $cliente = new Cliente;
        $cliente->tipo_documento = $request->input('cliente_tipo_documento');
        $cliente->documento = $request->input('cliente_documento');
        $cliente->apellidos = $request->input('cliente_apellido');
        $cliente->nombres = $request->input('cliente_nombre');
        $cliente->correo = $request->input('cliente_correo');
        $cliente->telefono = $request->input('cliente_telefono');
        $cliente->direccion = $request->input('cliente_direccion');
        $cliente->ubigeo = $request->input('cliente_ubigeo');
        $cliente->referencia = $request->input('cliente_referencia');
        $cliente->save();
        return response($cliente->id, 200)
            ->header('Content-Type', 'text/plain');
    }
}
