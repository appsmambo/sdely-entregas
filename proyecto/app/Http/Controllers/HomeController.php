<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Orden;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$ordenes = DB::table('orden')
			->join('cliente', 'orden.id_cliente', '=', 'cliente.id')
			->select('orden.id', 'orden.voucher', DB::raw('CONCAT(cliente.nombres, cliente.apellidos) AS cliente'), DB::raw('DATE_FORMAT(orden.fecha_hora_entrega, "%d/%m/%Y %h:%i %p") AS entrega'))
			->orderBy('orden.fecha_hora_entrega', 'desc')
			->get();
        return view('home')->with('ordenes', $ordenes);
    }

}
