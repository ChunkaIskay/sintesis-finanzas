@extends('layouts.app')


@section('content')

<div class="container">
	<div class="row">
		<h2> Crear nuevo Contacto</h2>
		@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
         @endif
		<form action="{{ route('saveContact') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
				<label for="nombre">Nombre del Contacto</label>
				<input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
			</div>
			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}">
			</div>
			<div class="form-group">
				<label for="telefono">Teléfono</label>
				<input type="number" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
			</div>
			<div class="form-group">
				<label for="celular">Celular</label>
				<input type="number" class="form-control" id="celular" name="celular" value="{{ old('celular') }}">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
			</div>
			<div class="form-group">
				<label for="cargo">Cargo</label>
				<input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo') }}">
			</div>
			<div class="form-group">
				<label for="entidad">Entidad</label>
				<select class="form-control form-control-large"  name="entidad" required="">
					 @foreach($entities as $entity)
			              <option value="{{ $entity->entity_id }}" @if( $entity->entity_id == old('entidad')) selected @endif>{{ $entity->name }}</option>
					 @endforeach
				</select>
			</div>
    	
			<br><br><br>
			<button type="submit" class="btn btn-success">Crear Contacto</button>	

		</form>

	</div>
</div>
@include('includes.footer')
@endsection
