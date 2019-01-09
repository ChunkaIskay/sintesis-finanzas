@extends('layouts.app')


@section('content')

<div class="container">
	<div class="row">
		<h2> Modificar la entidad seleccionada</h2>
		<form action="{{ url('/'.$entity->entity_id.'/update-entity') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
				<label for="name">Nombre de la entidad</label>
				<input type="text" class="form-control" id="name" name="name" value="{{ old('name', $entity->name) }}">
			</div>
			<div class="form-group">
				<label for="bank_account">Número de cuenta</label>
				<input type="text" class="form-control" id="bank_account" name="bank_account" value="{{ old('bank_account', $entity->bank_account) }}">
			</div>
			<div class="form-group">
				<label for="bank_name">Banco</label>
				<input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ old('bank_name', $entity->bank_name) }}">
			</div>
			<div class="form-group">
				<label for="description">Descripción de la entidad</label>
				<textarea class="form-control" name="description" placeholder="Ingrese la descripción de la entidad" rows="5">{{  old('description', $entity->description) }}</textarea>
			</div>

			<div class="form-group">
				<label for="address">Dirección</label>
				<input type="text" class="form-control" id="address" name="address" value="{{ old('address', $entity->address) }}">
			</div>

			<div class="form-group">
				<label for="city">Ciudad</label>
				<select class="form-control form-control-large"  name="city" required="">
					 @foreach($countries as $value)   @if( $value->country_id == old('city')) selected @endif
			              <option value="{{ $value->country_id }}" @if( $value->country_id == old('city', $entity->city)) selected @endif>{{ $value->city }}</option>
					 @endforeach

				</select>
			</div>

	      	
			<br><br><br>
			<button type="submit" class="btn btn-success">Modificar Entidad</button>	
			<a href="{{ route('listEntity') }}" class="btn btn-default">Cancelar</a>	

		</form>

	</div>
</div>
@endsection
