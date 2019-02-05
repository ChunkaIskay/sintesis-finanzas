@extends('layouts.app')


@section('content')

<div class="container">
			@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
	<div class="row">
		<h2> Crear una nueva Entidad</h2>
		<form action="{{ route('saveEntity') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
				<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
				<input type="hidden"  id="entityId" name="entityId" value="{{ $entityId }}">
			</div>
			<div class="form-group">
				<label for="bank_account">Número de cuenta</label>
				<input type="text" class="form-control" id="bank_account" name="bank_account" value="{{ old('bank_account') }}">
			</div>
			<div class="form-group">
				<label for="bank_name">Banco</label>
				<input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ old('bank_name') }}">
			</div>
			<div class="form-group">
				<label for="description">Descripción de la entidad</label>
				<textarea class="form-control" name="description" placeholder="Ingrese la descripción de la entidad" rows="5">{{  old('description') }}</textarea>
			</div>

			<div class="form-group">
				<label for="address">Dirección</label>
				<input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
			</div>

			<div class="form-group">
				<label for="city">Ciudad</label>
				<select class="form-control form-control-large"  name="city" required="">
					 @foreach($countries as $value)
			              <option value="{{ $value->country_id }}" @if( $value->country_id == old('city')) selected @endif>{{ $value->city }}</option>
					 @endforeach

				</select>
			</div>

			
	      	<br><br><br>			
			<button type="submit" class="btn btn-success">Crear Entidad</button>	

		</form>

	</div>
</div>
@include('includes.footer')
@endsection
