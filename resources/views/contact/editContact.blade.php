@extends('layouts.app')


@section('content')

<div class="container">
	<div class="row">
		<h2> Modificar el contacto seleccionado</h2>
		@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
         @endif
		<form action="{{ url('/'.$contacts->contact_id.'/update-contact') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
			{{ csrf_field() }}
			@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="form-group">
				<label for="entidad">Entidad</label>
				<select class="form-control form-control-large"  name="entidad" required="">
					
		             @foreach($entities as $entity)
			              <option value="{{ $entity->entity_id }}" @if( $entity->entity_id == old('entidad', $contacts->entity_id)) selected @endif>{{ $entity->name }}</option>
					 @endforeach
				</select>
			</div>
			<div class="form-group">
						<label for="tipo_contacto">Tipo contacto</label>
						<select class="form-control form-control-large"  name="tipo_contacto" required="">
							 @foreach($contactType as $val => $value)   
							 	  <option value="{{ $val }}" @if( $val == old('tipo_contacto', $contacts->type)) selected @endif>{{ $value }}
					              </option>
							 @endforeach
						</select>
			</div>

			<div class="form-group">
				<label for="nombre">Nombre del Contacto</label>
				<input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre',$contacts->name) }}">
			</div>
			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido',$contacts->last_name) }}">
			</div>
			<div class="form-group">
				<label for="telefono">Teléfono</label>
				<input type="number" class="form-control" id="telefono" name="telefono" value="{{ old('telefono',$contacts->phone) }}">
			</div>
			<div class="form-group">
				<label for="celular">Celular</label>
				<input type="number" class="form-control" id="celular" name="celular" value="{{ old('celular',$contacts->movile) }}">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" value="{{ old('email',$contacts->email) }}">
			</div>
			<div class="form-group">
				<label for="cargo">Cargo</label>
				<input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo',$contacts->position) }}">
			</div>
			<br><br><br>
			<button type="submit" class="btn btn-success">Modicar Contacto</button>
			<a href="{{ route('listContact') }}" class="btn btn-default">Cancelar</a>	

		</form>

	</div>
</div>
@include('includes.footer')
@endsection
