@extends('layouts.app')
@section('content')
<h2>
	Generar orden de entrega
</h2>
<div class="card">
	<div class="card-body">
		<form method="post" action="{{ url('genera-orden') }}" id="orden">
			{{ csrf_field() }}
			<div class="form-row">
				<div class="col-lg">
					<label for="cliente" class="d-block">Cliente</label>
					<div class="input-group">
						<input type="hidden" name="cliente_id" id="cliente_id">
						<input type="text" class="form-control typeahead cliente" id="cliente" name="cliente" placeholder="Busque por nombre o número de documento" required>
						<div class="input-group-append">
							<button data-toggle="modal" data-target="#formCliente" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-user-plus"></i></button>
						</div>
					</div>
				</div>
				<div class="col-lg">
					<div class="form-group">
						<label for="tipo_pago">Tipo de pago</label>
						<select class="form-control" name="tipo_pago" id="tipo_pago">
						@foreach ($tipoPago as $tipo)
							<option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
						@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-lg">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="fecha">Fecha de entrega:</label>
								<input type="date" min="" class="form-control" id="fecha" name="fecha" placeholder="Ingrese fecha de entrega" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="hora">Hora de entrega:</label>
								<input type="time" class="form-control" id="hora" name="hora" placeholder="Ingrese hora de entrega" required>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg text-right mt-4">
					<a href="{{ url('home') }}" class="btn btn-secondary">Cancelar</a>
					<button type="submit" class="btn btn-primary">Grabar</button>
				</div>
			</div>
			<hr>
			<h3>Ingresar productos</h3>
			<div class="form-row">
				<div class="col">
					<div id="colSku" class="form-group">
						<label>SKU</label>
						<input type="text" name="sku[]" class="form-control">
					</div>
				</div>
				<div class="col">
					<div id="colColor" class="form-group">
						<label>Color</label>
						<input type="text" name="color[]" class="form-control">
					</div>
				</div>
				<div class="col">
					<div id="colTalla" class="form-group">
						<label>Talla</label>
						<input type="text" name="talla[]" class="form-control">
					</div>
				</div>
				<div id="colCantidad" class="col">
					<label>Cantidad</label>
					<div class="input-group">
						<input type="number" name="cantidad[]" class="form-control">
						<div class="input-group-append">
							<button id="agregarFila" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-plus-square"></i></button>
						</div>
					</div>
				</div>
			</div>
			<p class="text-right">
				<a href="{{ url('home') }}" class="btn btn-secondary">Cancelar</a>
				<button type="submit" class="btn btn-primary">Grabar</button>
			</p>
		</form>
	</div>
</div>
<div class="modal fade" id="formCliente" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Nuevo cliente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="nuevoCliente" action="" method="post">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-lg">
							<div class="form-group">
								<label for="cliente_tipo_documento" class="col-form-label">Tipo documento:</label>
								<select class="form-control" id="cliente_tipo_documento" name="cliente_tipo_documento" required>
									<option value="dni">DNI</option>
									<option value="ruc">RUC</option>
									<option value="ce">CE</option>
								</select>
							</div>
						</div>
						<div class="col-lg">
							<div class="form-group">
								<label for="cliente_documento" class="col-form-label">Número de documento:</label>
								<input type="text" class="form-control" id="cliente_documento" name="cliente_documento" value="" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg">
							<div class="form-group">
								<label for="cliente_nombre" class="col-form-label">Nombres:</label>
								<input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre" value="" required>
							</div>
						</div>
						<div class="col-lg">
							<div class="form-group">
								<label for="cliente_apellido" class="col-form-label">Apellidos:</label>
								<input type="text" class="form-control" id="cliente_apellido" name="cliente_apellido" value="" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg">
							<div class="form-group">
								<label for="cliente_correo" class="col-form-label">Correo:</label>
								<input type="email" class="form-control" id="cliente_correo" name="cliente_correo" value="" required>
							</div>
						</div>
						<div class="col-lg">
							<div class="form-group">
								<label for="cliente_telefono" class="col-form-label">Teléfono:</label>
								<input type="text" class="form-control" id="cliente_telefono" name="cliente_telefono" value="" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg">
							<div class="form-group">
								<label for="cliente_direccion" class="col-form-label">Dirección:</label>
								<input type="text" class="form-control" id="cliente_direccion" name="cliente_direccion" value="" required>
							</div>
						</div>
						<div class="col-lg">
							<input type="hidden" name="cliente_ubigeo" id="cliente_ubigeo">
							<div class="form-group">
								<label for="cliente_distrito" class="col-form-label d-block">Distrito:</label>
								<input type="text" class="form-control typeahead distrito" id="cliente_distrito" name="cliente_distrito" value="" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="cliente_referencia" class="col-form-label">Referencia:</label>
						<input type="text" class="form-control" id="cliente_referencia" name="cliente_referencia" value="" required>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="grabarCliente">Grabar</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
	var fila = 1;
	var clientes = {!! $clientes !!};
	var distritos = {!! $ubigeo !!};
	var buscaClientes = function(strs) {
		return function findMatches(q, cb) {
			var matches, substringRegex;
			matches = [];
			substrRegex = new RegExp(q, 'i');
			$.each(strs, function(i, str) {
				if (substrRegex.test(str.documento) || substrRegex.test(str.nombres) || substrRegex.test(str.apellidos)) {
					matches.push(str.documento + ' - ' + str.nombres + ' ' + str.apellidos);
				}
			});
			cb(matches);
		};
	};
	var buscaDistrito = function(strs) {
		return function findMatches(q, cb) {
			var matches, substringRegex;
			matches = [];
			substrRegex = new RegExp(q, 'i');
			$.each(strs, function(i, str) {
				if (substrRegex.test(str.distrito)) {
					matches.push(str.provincia + ' - ' + str.distrito);
				}
			});
			cb(matches);
		};
	};
	$(function() {
		$('.typeahead').bind('typeahead:select', function(ev, suggestion) {
			var esCliente = $(this).hasClass('cliente');
			var buscar = suggestion.split(' - ');
			if (esCliente) {
				$.each(clientes, function(i, str) {
					if (str.documento == buscar[0]) {
						$('#cliente_id').val(str.id);
					}
				});
			} else {
				$.each(distritos, function(i, str) {
					if (str.provincia == buscar[0] && str.distrito == buscar[1]) {
						$('#cliente_ubigeo').val(str.id);
					}
				});
			}
		});
		$('.typeahead.cliente').typeahead({
			hint: false,
			highlight: true,
			minLength: 3
		},
		{
			name: 'clientes',
			source: buscaClientes(clientes)
		});
		$('.typeahead.distrito').typeahead({
			hint: false,
			highlight: true,
			minLength: 3
		},
		{
			name: 'distritos',
			source: buscaDistrito(distritos)
		});
		$('#grabarCliente').click(function() {
			$('#nuevoCliente').submit();
		});
		$('#orden').validate();
		$('#nuevoCliente').validate({
			submitHandler: function(form) {
				var thisForm = $(form);
				var data = thisForm.serialize();
				var nombreCliente = $('#cliente_nombre').val();
				var apellidoCliente = $('#cliente_apellido').val();
				var documentoCliente = $('#cliente_documento').val();
				$.ajax({
					type: 'POST',
					url: '{{ url('grabar-cliente') }}',
					data: data,
					dataType: 'text'
				}).done(function(e) {
					var cliente = {id: e,documento: documentoCliente, apellidos: apellidoCliente, nombres: nombreCliente};
					clientes.push(cliente);
					$('#cliente_id').val(e);
					$('#cliente').val(nombreCliente + ' ' + apellidoCliente);
					// limpiar controles
					$("#cliente_tipo_documento").prop('selectedIndex', 0);
					$('#cliente_documento, #cliente_nombre, #cliente_apellido, #cliente_correo, #cliente_telefono, #cliente_direccion, #cliente_distrito, #cliente_referencia').val('');
					$('#formCliente').modal('hide');
				});
				return false;
			}
		});
		$('#agregarFila').click(function() {
			$('#colSku').append('<input id="sku' + fila + '" type="text" name="sku[]" class="form-control my-3">');
			$('#colColor').append('<input id="color' + fila + '" type="text" name="color[]" class="form-control my-3">');
			$('#colTalla').append('<input id="talla' + fila + '" type="text" name="talla[]" class="form-control my-3">');
			$('#colCantidad').append('<div id="cantidad' + fila + '" class="input-group my-3"><input type="number" name="cantidad[]" class="form-control"><div class="input-group-append"><button data-fila="' + fila + '" class="borrarFila btn btn-danger btn-sm" type="button"><i class="far fa-trash-alt"></i></button></div></div>');
			fila++;
		});
		$(document).on('click', '.borrarFila', function() {
			var fila = $(this).data('fila');
			$('#sku' + fila + ',#color' + fila + ',#talla' + fila + ',#cantidad' + fila).remove();
		});
	});
</script>
@endsection