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

    public function getGeneraOrden()
    {
        $clientes = Cliente::select('id', 'documento', 'apellidos', 'nombres')->get();
        $tipoPago = TipoPago::all();
        return view('ordenes.crear')
            ->with('clientes', $clientes)
            ->with('tipoPago', $tipoPago);
    }

    public function postGeneraOrden()
    {
        //
    }
}
