@extends('layouts.app')
@section('content')
<h2>
	Orden de entrega Nro: {{ $orden->id }}
</h2>
<div class="card">
	<div class="card-body">
		<form method="post" action="#">
			<h3>Datos del cliente</h3>
			<div class="form-row">
				<div class="col-sm">
					<div class="form-group">
						<label>Nombre</label>
						<input readonly class="form-control" value="{{ $cliente->nombres . ' ' . $cliente->apellidos }}">
					</div>
				</div>
				<div class="col-sm">
					<div class="form-group">
						<label>Documento</label>
						<input readonly class="form-control" value="{{ strtoupper($cliente->tipo_documento) . ' - ' . $cliente->documento }}">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm">
					<div class="form-group">
						<label>Correo</label>
						<input readonly class="form-control" value="{{ $cliente->correo }}">
					</div>
				</div>
				<div class="col-sm">
					<div class="form-group">
						<label>Teléfono</label>
						<input readonly class="form-control" value="{{ $cliente->telefono }}">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm">
					<div class="form-group">
						<label>Tipo de pago</label>
						<input readonly class="form-control" value="{{ $tipoPago }}">
					</div>
				</div>
				<div class="col-sm">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Fecha de entrega:</label>
								<input readonly class="form-control" value="{{ date('d/m/Y', strtotime($orden->fecha_hora_entrega)) }}">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label>Hora de entrega:</label>
								<input readonly class="form-control" value="{{ date('h:i A', strtotime($orden->fecha_hora_entrega)) }}">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm text-right mt-4">
					<a href="{{ url('home') }}" class="btn btn-secondary">Regresar</a>
					@if (!isset($orden->voucher))
					<a href="#" class="btn btn-success cancelarOrden" data-ordenid="{{ $orden->id }}" data-toggle="modal" data-target="#formCancelarOrden">Cancelar la orden</a>
					@endif
				</div>
			</div>
			<hr>
			<h3>Lugar de entrega</h3>
			<div class="form-group">
				<label>Dirección:</label>
				<input readonly class="form-control" value="{{ $cliente->direccion }}">
			</div>
			<div class="form-group">
				<label>Distrito</label>
				<input readonly class="form-control" value="{{ $ubigeo->departamento . ' - ' . $ubigeo->provincia . ' - ' . $ubigeo->distrito }}">
			</div>
			<div class="form-group">
				<label>Referencia:</label>
				<input readonly class="form-control" value="{{ $cliente->referencia }}">
			</div>
			<div class="row">
				<div class="col-sm text-right mt-4">
					<a href="{{ url('home') }}" class="btn btn-secondary">Regresar</a>
					@if (!isset($orden->voucher))
					<a href="#" class="btn btn-success cancelarOrden" data-ordenid="{{ $orden->id }}" data-toggle="modal" data-target="#formCancelarOrden">Cancelar la orden</a>
					@endif
				</div>
			</div>
			<hr>
			<h3>Lista de productos</h3>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">SKU</th>
							<th scope="col">Color</th>
							<th scope="col">Talla</th>
							<th scope="col">Cantidad</th>
						</tr>
					</thead>
					<tbody>
					@forelse ($ordenDetalle as $orden)
						<tr>
							<td>{{ $orden->sku }}</td>
							<td>{{ $orden->color }}</td>
							<td>{{ $orden->talla }}</td>
							<td>{{ $orden->cantidad }}</td>
						</tr>
					@empty
						<tr><td colspan="4">No se encontraron registros para esta orden.</td></tr>
					@endforelse
					</tbody>
				</table>
			</div>
			<p class="text-right">
				<a href="{{ url('home') }}" class="btn btn-secondary">Regresar</a>
				@if (!isset($orden->voucher))
				<a href="#" class="btn btn-success cancelarOrden" data-ordenid="{{ $orden->id }}" data-toggle="modal" data-target="#formCancelarOrden">Cancelar la orden</a>
				@endif
			</p>
		</form>
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
		$('.cancelarOrden', function() {
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