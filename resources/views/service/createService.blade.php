@extends('layouts.app')


@section('content')

<div class="container">
			@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
	<div class="row">
		<h2> Crear un nuevo Servicio</h2>
		<form action="{{ route('saveService') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
				<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
				<input type="hidden"  id="serviceId" name="serviceId" value="{{ $serviceId }}">
				serviceId
			</div>
			<div class="form-group">
				<label for="description">Descripción del servicio</label>
				<textarea class="form-control" name="description" placeholder="Ingrese la descripción del Servicio" rows="5">{{ old('description') }}</textarea>
			</div>
			<div class="form-group">
				<label for="status">Estado</label>
				<select class="form-control form-control-large"  name="status" required="">
					<option value="activo">Activo</option>
					<option value="inactivo">Inactivo</option>
				</select>
			</div>
	      	<br>
			
			<button type="submit" class="btn btn-success">Crear Servicio</button>	

		</form>

	</div>
</div>
@endsection
