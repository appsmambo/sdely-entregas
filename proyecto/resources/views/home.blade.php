@extends('layouts.app')
@section('content')
<h2>
    Últimas órdenes
</h2>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"># Orden</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha entrega</th>
                        <th scope="col">Documentos</th>
                        <th scope="col">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($ordenes as $orden)
                    <tr>
                        <td>{{ $orden->id }}</td>
                        <td>{{ $orden->cliente }}</td>
                        <td>{{ $orden->entrega }}</td>
                        <td>
                            @if (!isset($orden->voucher))
                            No voucher
                            @else
                            <a href="{{ url('storage/voucher/' . $orden->voucher) }}" target="_blank"><i class="far fa-image fa-2x"></i></a>
                            @endif
                            -
                            @if (!isset($orden->entrega_remito))
                            No remito
                            @else
                            <a href="{{ url('storage/remito/' . $orden->entrega_remito) }}" target="_blank" class="ml-2"><i class="far fa-image fa-2x"></i></a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/ver-orden/'. $orden->id) }}" class="btn btn-info btn-sm">Ver detalle</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">No se encontraron registros.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection