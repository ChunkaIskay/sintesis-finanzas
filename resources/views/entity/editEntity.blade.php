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
				<label for="code">Código de la entidad</label>
				<input type="text" class="form-control" id="code" name="code" value="{{ old('code', $entity->code) }}">
			</div>
			<div class="form-group">
				<label for="name">Nombre de la entidad</label>
				<input type="text" class="form-control" id="name" name="name" value="{{ old('name', $entity->name) }}">
			</div>
			@foreach($accounts as $key => $account)
				<div class="row">
					<div class="col-md-10">
						<label for="number_account_0">
							@if($key == 0)<h5>Abono de lo recaudado a la siguiente cuenta:</h5> @endif
							@if($key == 1)<h5><h5>Abono por el pago de las comisiones a la siguiente cuenta:</h5></h5> @endif
							@if($key == 2)<h5>Otra cuanta:</h5> @endif
						</label>
						<div class="form-group">
							<label for="nombre_cuenta_{{ $key}}">Nombre de la cuenta {{ $key +1 }}</label>
								<input type="text" class="form-control" id="nombre_cuenta_{{$key}}" name="nombre_cuenta_{{$key}}" value="{{ old('nombre_cuenta_$key', $account->account_name) }}">
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="number_account_{{ $key}}"># Cuenta {{ $key +1 }}</label>
							@if(!empty($account->number_account))
								<input type="text" class="form-control" id="number_account_{{ $key}}" name="number_account_{{ $key}}" value="{{ old('number_account_$key', $account->number_account) }}">
							@else
								<input type="text" class="form-control" id="number_account_{{ $key}}" name="number_account_{{ $key}}" value="">
							@endif
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="bank_{{ $key}}">Banco</label>
							<select class="form-control form-control-large"  name="bank_{{ $key}}" required="">
								 @foreach($bank as $value)   
								 	  <option value="{{ $value->bank_id }}" @if( $value->bank_id == old('bank_id_{{ $key}}', $account->bank_id)) selected @endif>{{ $value->short_name }}
						              </option>
								 @endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="bank_type_{{ $key}}">Tipo</label>
							<select class="form-control form-control-large"  name="bank_type_{{ $key}}" required="">
								 @foreach($type as $k => $value)   
								 	  <option value="{{ $k }}" @if( $k == old('bank_type_{{ $key}}', $account->type_account)) selected @endif>{{ $value }}
						              </option>
								 @endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
							<label for="bank_coin_{{ $key}}">Moneda</label>
							<select class="form-control form-control-large"  name="bank_coin_{{ $key}}" required="">
								 @foreach($coin as $value)   
								 	  <option value="{{ $value }}" @if( $value == old('bank_coin_{{ $key}}', $account->coin)) selected @endif>{{ $value }}
						              </option>
								 @endforeach
							</select>
					</div>
				</div>
			@endforeach


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
					 @foreach($countries as $value) 
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
@include('includes.footer')
@endsection
