<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPago;
use App\Cliente;
use App\Orden;
use App\OrdenDetalle;
use App\Ubigeo;

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

    public function getVerOrden(Request $request)
    {
        $id = $request->id;
        $orden = Orden::find($id);
        $tipoPago = TipoPago::find($orden->id_tipo_pago);
        $ordenDetalle = OrdenDetalle::where('id_orden', $orden->id)->get();
        $cliente = Cliente::find($orden->id_cliente);
        $ubigeo = Ubigeo::find($cliente->ubigeo);
        return view('ordenes.ver')
            ->with('orden', $orden)
            ->with('ordenDetalle', $ordenDetalle)
            ->with('cliente', $cliente)
            ->with('tipoPago', $tipoPago->descripcion)
            ->with('ubigeo', $ubigeo);
    }

    public function getGeneraOrden()
    {
        $clientes = Cliente::select('id', 'documento', 'apellidos', 'nombres')->get();
        $ubigeo = Ubigeo::select('id', 'departamento', 'provincia', 'distrito')->get();
        $tipoPago = TipoPago::all();
        return view('ordenes.crear')
            ->with('clientes', $clientes)
            ->with('tipoPago', $tipoPago)
            ->with('ubigeo', $ubigeo);
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

    public function postCancelarOrden(Request $request)
    {
        $id = $request->input('orden_id');
        $orden = Orden::find($id);
        $orden->numero_operacion = $request->input('orden_operacion');
        $orden->observaciones = $request->input('orden_observacion');
        if ($request->hasFile('orden_voucher')) {
            $orden_voucher = str_replace('images/', '', $request->orden_voucher->store('images'));
            $orden->voucher = $orden_voucher;
        }
        $orden->save();
        return redirect('home');
    }
}
