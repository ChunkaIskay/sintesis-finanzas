@extends('layouts.app')


@section('content')

<div class="container">
	<div class="row">
		<h2> Modificar el servicio seleccionado</h2>
		<form action="{{ url('/'.$services[0]['service_id'].'/update-service') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
			{{ csrf_field() }}
			<!--@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif-->
			<div class="form-group">
				<label for="name">Nombre del servicio</label>
				<input type="text" class="form-control" id="name" name="name" value="{{ $services[0]['name'] }}">
				
				
			</div>
			<div class="form-group">
				<label for="description">Descripción del servicio</label>
				<textarea class="form-control" name="description" placeholder="Ingrese la descripción del Servicio" rows="5">{{ $services[0]['description'] }}</textarea>
			</div>
			<div class="form-group">
				<label for="status">Estado</label>
				<select class="form-control form-control-large"  name="status" required="">
					@if($services[0]['status'] == 'activo')
					 	<option value="activo" selected="selected">{{ $services[0]['status'] }}</option>
					 	<option value="inactivo">Inactivo</option>
					 	<option value="pendiente">Pendiente</option>
					@elseif ($services[0]['status'] == 'inactivo')
						<option value="activo">Activo</option>
						<option value="inactivo" selected="selected">Inactivo</option>
						<option value="pendiente">Pendiente</option>
					@else
						<option value="activo">Activo</option>
						<option value="inactivo">Inactivo</option>
					 	<option value="pendiente" selected="selected">Pendiente</option>
					@endif 
				</select>
			</div>
	      	<br>
			
			<button type="submit" class="btn btn-success">Crear Servicio</button>	
			<a href="{{ route('listService') }}" class="btn btn-default">Cancelar</a>	

		</form>

	</div>
</div>
@endsection
