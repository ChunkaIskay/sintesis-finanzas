@extends('layouts.app')


@section('content')

<div class="container">
	<div class="row">
		<h2> Modificar el contracto seleccionado</h2>
		<form action="{{ url('/'.$contracts->contract_id.'/update-contract') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
			{{ csrf_field() }}
			<!--@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{$error}}</li>/{id}/
						@endforeach
					</ul>
				</div>
			@endif-->

			<div class="form-group">
				<label for="codigo">Código del Contrato</label>
				<input type="text" class="form-control" id="codigo" name="codigo" value="{{ $contracts->code }}">
			</div>
			
			<div class="form-group">
				<label for="servicio">Servicios</label>
				<select class="form-control form-control-large"  name="servicio"required="">
					  <option value="">Seleccione</option>
					  @foreach($services as $service)
			              <option value="{{ $service->service_id }}" >{{ $service->name }}</option>
					  @endforeach			        
				</select>
			</div>
			<div class="form-group">
				<label for="entidad">Entidad</label>
				<select class="form-control form-control-large"  name="entidad" required="">
					<option value="">Seleccione</option>
		             @foreach($entities as $entity)
			              <option value="{{ $entity->entity_id }}">{{ $entity->name }}</option>
					  @endforeach
				</select>
			</div>
				<div class="row">
		          <div class="col-md-4 mb-3">
		            <label for="cate_general">Categorización General</label>
		            <select class="custom-select form-control"  name="cate_general" required="">
		              <option value="1">Otros comercios </option>
		              <option value="2">Comercio Electrónico</option>
		            </select>
		          </div>
		   
		          <div class="col-md-4 mb-3">
		            <label for="cate_especifica">Categorización Específica</label>
		            <select class="custom-select form-control" name="cate_especifica" required="">
		              <option value="1">Solución Pymes</option>
		              <option value="2">Otros </option>
		            </select>
		          </div>
		           <div class="col-md-4 mb-3">
		            <label for="tipo">Tipo de Contrato</label>
		            <select class="custom-select form-control" name="tipo" required="">
		              <option value="1">Cliente</option>
		              <option value="2">Canal</option>
		            </select>
		          </div>
		        </div>
		        	<br>
			
			<button type="submit" class="btn btn-success">Crear Contrato</button>
			<a href="{{ route('listContract') }}" class="btn btn-default">Cancelar</a>	

		</form>

	</div>
</div>
@endsection
