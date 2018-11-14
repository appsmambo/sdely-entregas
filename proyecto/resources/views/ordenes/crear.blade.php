@extends('layouts.app')
@section('content')
<h2>
	Generar orden de entrega
</h2>
<div class="card">
	<div class="card-body">
		<form method="post" action="{{ url('genera-orden') }}">
			{{ csrf_field() }}
			<div class="form-row">
				<div class="col-sm">
					<label for="cliente" class="d-block">Cliente</label>
					<div class="input-group">
						<input type="text" class="form-control typeahead cliente" id="cliente" name="cliente" placeholder="Busque por nombre o correo electrónico">
						<div class="input-group-append">
							<button data-toggle="modal" data-target="#formCliente" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-user-plus"></i></button>
						</div>
					</div>
				</div>
				<div class="col-sm">
					<div class="form-group">
						<label for="tipo_pago">Tipo de pago</label>
						<select class="form-control" name="tipo_pago" id="tipo_pago">
						@foreach ($tipoPago as $tipo)
							<option value="">{{ $tipo->descripcion }}</option>
						@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="fecha">Fecha de entrega:</label>
								<input type="text" class="form-control" id="fecha" name="fecha" placeholder="Ingrese fecha de entrega">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="hora">Hora de entrega:</label>
								<input type="text" class="form-control" id="hora" name="hora" placeholder="Ingrese hora de entrega">
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm text-right mt-4">
					<a href="{{ url('home') }}" class="btn btn-secondary">Cancelar</a>
					<button type="submit" class="btn btn-primary">Grabar</button>
				</div>
			</div>
			<hr>
			<h3>Ingresar productos</h3>
			<div class="form-row">
				<div class="col">
					<div class="form-group">
						<label for="sku">SKU</label>
						<input type="text" id="sku" name="sku" class="form-control">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label for="color">Color</label>
						<input type="text" id="color" name="color" class="form-control">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label for="talla">Talla</label>
						<input type="text" id="talla" name="talla" class="form-control">
					</div>
				</div>
				<div class="col">
					<label for="cantidad">Cantidad</label>
					<div class="input-group">
						<input type="number" id="cantidad" name="cantidad" class="form-control">
						<div class="input-group-append">
							<button class="btn btn-secondary btn-sm" type="button"><i class="fas fa-plus-square"></i></button>
						</div>
					</div>
				</div>
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">SKU</th>
						<th scope="col">Color</th>
						<th scope="col">Talla</th>
						<th scope="col">Cantidad</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
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
				<div class="form-group">
					<label for="cliente_nombre" class="col-form-label">Nombre:</label>
					<input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre">
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="cliente_correo" class="col-form-label">Correo:</label>
							<input type="text" class="form-control" id="cliente_correo" name="cliente_correo">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="cliente_telefono" class="col-form-label">Teléfono:</label>
							<input type="text" class="form-control" id="cliente_telefono" name="cliente_telefono">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="cliente_direccion" class="col-form-label">Dirección:</label>
							<input type="text" class="form-control" id="cliente_direccion" name="cliente_direccion">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="cliente_distrito" class="col-form-label">Distrito:</label>
							<input type="text" class="form-control" id="cliente_distrito" name="cliente_distrito">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="cliente_referencia" class="col-form-label">Referencia:</label>
					<input type="text" class="form-control" id="cliente_referencia" name="cliente_referencia">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary">Grabar</button>
			</div>
		</div>
	</div>
</div>
@endsection