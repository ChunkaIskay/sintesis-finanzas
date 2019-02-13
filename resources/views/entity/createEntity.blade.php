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
				<label for="code">Código de la entidad</label>
				<input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
			</div>

			<div class="form-group">
				<label for="name">Nombre de la entidad</label>
				<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
				<input type="hidden"  id="entityId" name="entityId" value="{{ $entityId['entityId'] }}">
			</div>

				<div class="row">
					<div class="col-md-10">
						<label for="number_account_0"><h5>Abono de lo recaudado a la siguiente cuenta:</h5></label>
						<div class="form-group">
							<label for="nombre_cuenta_0">Nombre de la cuenta 1</label>
								<input type="text" class="form-control" id="nombre_cuenta_0" name="nombre_cuenta_0" value="{{ old('nombre_cuenta_0') }}">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="number_account_0">Nª de Cuenta 1</label>
							@if(!empty($account->number_account))
								<input type="text" class="form-control" id="number_account_0" name="number_account_0}" value="{{ old('number_account_0')}}">
							@else
								<input type="text" class="form-control" id="number_account_0" name="number_account_0" value="{{ old('number_account_0') }}">
							@endif
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="bank_0">Banco</label>
							<select class="form-control form-control-large"  name="bank_0" required="">
								 @foreach($bank as $value)   
								 	  <option value="{{ $value->bank_id }}" @if( $value->bank_id == old('bank_id_0')) selected @endif>{{ $value->short_name }}
						              </option>
								 @endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="bank_type_0">Tipo</label>
							<select class="form-control form-control-large"  name="bank_type_0" required="">
								 @foreach($type as $k => $value)   
								 	  <option value="{{ $k }}" @if( $k == old('bank_type_0')) selected @endif>{{ $value }}
						              </option>
								 @endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
							<label for="bank_coin_0">Moneda</label>
							<select class="form-control form-control-large"  name="bank_coin_0" required="">
								 @foreach($coin as $value)   
								 	  <option value="{{ $value }}" @if( $value == old('bank_coin_0')) selected @endif>{{ $value }}
						              </option>
								 @endforeach
							</select>
					</div>
				</div>

				<div class="row">
					<div class="col-md-10">
						<label for="number_account_1"><h5>Abono por el pago de las comisiones a la siguiente cuenta:</h5></label>
						<div class="form-group">
							<label for="nombre_cuenta_1">Nombre de la cuenta 2</label>
								<input type="text" class="form-control" id="nombre_cuenta_1" name="nombre_cuenta_1" value="{{ old('nombre_cuenta_1') }}">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="number_account_1">Nª de Cuenta 2</label>
							@if(!empty($account->number_account))
								<input type="text" class="form-control" id="number_account_1" name="number_account_1}" value="{{ old('number_account_1')}}">
							@else
								<input type="text" class="form-control" id="number_account_1" name="number_account_1" value="{{ old('number_account_1') }}">
							@endif
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="bank_1">Banco</label>
							<select class="form-control form-control-large"  name="bank_1" required="">
								 @foreach($bank as $value)   
								 	  <option value="{{ $value->bank_id }}" @if( $value->bank_id == old('bank_id_1')) selected @endif>{{ $value->short_name }}
						              </option>
								 @endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="bank_type_1">Tipo</label>
							<select class="form-control form-control-large"  name="bank_type_1" required="">
								 @foreach($type as $k => $value)   
								 	  <option value="{{ $k }}" @if( $k == old('bank_type_1')) selected @endif>{{ $value }}
						              </option>
								 @endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
							<label for="bank_coin_1">Moneda</label>
							<select class="form-control form-control-large"  name="bank_coin_1" required="">
								 @foreach($coin as $value)   
								 	  <option value="{{ $value }}" @if( $value == old('bank_coin_1')) selected @endif>{{ $value }}
						              </option>
								 @endforeach
							</select>
					</div>
				</div>

				<div class="row">
					<div class="col-md-10">
						<label for="number_account_2"><h5>Otra cuenta:</h5></label>
						<div class="form-group">
							<label for="nombre_cuenta_2">Nombre de la cuenta 3</label>
								<input type="text" class="form-control" id="nombre_cuenta_2" name="nombre_cuenta_2" value="{{ old('nombre_cuenta_2') }}">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="number_account_2">Nª de Cuenta 3</label>
							@if(!empty($account->number_account))
								<input type="text" class="form-control" id="number_account_2" name="number_account_2}" value="{{ old('number_account_2')}}">
							@else
								<input type="text" class="form-control" id="number_account_2" name="number_account_2" value="{{ old('number_account_2') }}">
							@endif
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="bank_2">Banco</label>
							<select class="form-control form-control-large"  name="bank_2" required="">
								 @foreach($bank as $value)   
								 	  <option value="{{ $value->bank_id }}" @if( $value->bank_id == old('bank_id_2')) selected @endif>{{ $value->short_name }}
						              </option>
								 @endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="bank_type_2">Tipo</label>
							<select class="form-control form-control-large"  name="bank_type_2" required="">
								 @foreach($type as $k => $value)   
								 	  <option value="{{ $k }}" @if( $k == old('bank_type_2')) selected @endif>{{ $value }}
						              </option>
								 @endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
							<label for="bank_coin_2">Moneda</label>
							<select class="form-control form-control-large"  name="bank_coin_2" required="">
								 @foreach($coin as $value)   
								 	  <option value="{{ $value }}" @if( $value == old('bank_coin_2')) selected @endif>{{ $value }}
						              </option>
								 @endforeach
							</select>
					</div>
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
			<div class="form-group">
				<label for="description">Descripción de la entidad</label>
				<textarea class="form-control" name="description" placeholder="Ingrese la descripción de la entidad" rows="5">{{  old('description') }}</textarea>
			</div>

	      	<br><br><br>			
			<button type="submit" class="btn btn-success">Crear Entidad</button>	

		</form>

	</div>
</div>
@include('includes.footer')
@endsection
