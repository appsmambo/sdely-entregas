<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPago;
use App\Cliente;
use App\Orden;
use App\OrdenDetalle;

class OrdenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getListaOrdenes()
    {
        //
    }

    public function getGeneraOrden()
    {
        $clientes = Cliente::select('id', 'documento', 'apellidos', 'nombres')->get();
        $tipoPago = TipoPago::all();
        return view('ordenes.crear')
            ->with('clientes', $clientes)
            ->with('tipoPago', $tipoPago);
    }

    public function postGeneraOrden(Request $request)
    {
        $fecha = $request->input('fecha');
        $fecha = str_replace('/', '-', $fecha);
        $fechaHora = date('Y-m-d H:i:s', strtotime($fecha . ' ' . $request->input('hora')));

        $orden = new Orden;
        $orden->id_cliente = $request->input('cliente_id');
        $orden->id_tipo_pago = $request->input('tipo_pago');
        $orden->fecha_hora_entrega = $fechaHora;
        $orden->save();
        $idOrden = $orden->id;

        $sku = $request->input('sku');
        $color = $request->input('color');
        $talla = $request->input('talla');
        $cantidad = $request->input('cantidad');
        foreach ($sku as $key => $value) {
            $ordenDetalle = new OrdenDetalle;
            $ordenDetalle->id_orden = $idOrden;
            $ordenDetalle->sku = $sku[$key];
            $ordenDetalle->color = $color[$key];
            $ordenDetalle->talla = $talla[$key];
            $ordenDetalle->cantidad = $cantidad[$key];
            $ordenDetalle->save();
        }

        return redirect('home');
    }
}
