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
                        <th scope="col">Voucher</th>
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
                            Sin voucher
                            @else
                            <a href="{{ url('storage/' . $orden->voucher) }}" target="_blank"><i class="far fa-image fa-2x"></i></a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/ver-orden/'. $orden->id) }}" class="btn btn-info btn-sm">Ver detalle</a>
                            @if (!isset($orden->voucher))
                            <a href="#" data-ordenid="{{ $orden->id }}" data-toggle="modal" data-target="#formCancelarOrden" class="btn btn-success btn-sm cancelarOrden">Cancelar la orden</a>
                            @endif
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
<div class="modal fade" id="formCancelarOrden" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancelar Orden</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cancelarOrden" action="{{ url('cancelar-orden') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="orden_id" id="orden_id" value="">
                    <div class="form-group">
                        <label for="orden_operacion" class="col-form-label">Ingresar número de operación:</label>
                        <input type="text" class="form-control" id="orden_operacion" name="orden_operacion" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="orden_voucher" class="col-form-label">Adjuntar voucher:</label>
                        <input type="file" class="form-control" id="orden_voucher" name="orden_voucher" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="orden_observacion" class="col-form-label">Ingresar observaciones:</label>
                        <textarea class="form-control" id="orden_observacion" name="orden_observacion" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="actualizarOrden">Actualizar la orden</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        $('#cancelarOrden').validate();
        $(document).on('click', '.cancelarOrden', function() {
            var id = $(this).data('ordenid');
            $('#orden_id').val(id);
        });
        $('#actualizarOrden').click(function() {
            var rpta = confirm('Favor de confirmar!');
            if (rpta == true) {
                $('#cancelarOrden').submit();
                return;
            }
        });
    });
</script>
@endsection