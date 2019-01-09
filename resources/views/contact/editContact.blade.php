@extends('layouts.app')


@section('content')

<div class="container">
	<div class="row">
		<h2> Modificar el contracto seleccionado</h2>
		@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
         @endif
		<form action="{{ url('/'.$contracts->contract_id.'/update-contract') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
				<label for="codigo">Código del Contrato</label>
				<input type="text" class="form-control" id="codigo" name="codigo" value="{{ $contracts->code }}">
			</div>
			<div class="form-group">
				<label for="description">Descripción del contrato</label>
				<textarea class="form-control" name="description" placeholder="Ingrese la descripción del contrato" rows="5">{{ $contracts->description }}</textarea>
			</div>			
			<div class="form-group">
				<label for="servicio">Servicios</label>
				<select class="form-control form-control-large"  name="servicio" required="">
					  
					  @foreach($services as $service)
			              <option value="{{ $service->service_id }}" @if( $service->service_id == old('servicio', $contracts->service_id)) selected @endif >{{ $service->name }}</option>
					  @endforeach			        
				</select>  
			</div>
			<div class="form-group">
				<label for="entidad">Entidad</label>
				<select class="form-control form-control-large"  name="entidad" required="">
					
		             @foreach($entities as $entity)
			              <option value="{{ $entity->entity_id }}" @if( $entity->entity_id == old('entidad', $contracts->entity_id)) selected @endif>{{ $entity->name }}</option>
					 @endforeach
				</select>
			</div>
				<div class="row">
		          <div class="col-md-4 mb-3">
		            <label for="cate_general">Categorización General</label>
		            <select class="custom-select form-control"  name="cate_general" required="">
		             	@foreach($categorizations as $categorizationg)
		            	 	@if( $categorizationg->type == 'especifica' )	
			              		<option value="{{ $entity->entity_id }}" @if( $categorizationg->categorization_id == old('cate_general', $contracts->general_category_id)) selected @endif>{{ $categorizationg->name }}</option>
			              	@endif
			             @endforeach
		            </select>
		          </div>
		   
		          <div class="col-md-4 mb-3">
		            <label for="cate_especifica">Categorización Específica</label>
		            <select class="custom-select form-control" name="cate_especifica" required="">
		              	@foreach($categorizations as $categorizatione)
			              	@if( $categorizatione->type == 'general' )	
				              <option value="{{ $categorizatione->categorization_id }}" @if( $categorizatione->categorization_id == old('cate_especifica', $contracts->specific_category_id)) selected @endif>{{ $categorizatione->name }}</option>
				          	@endif
				         @endforeach
		            </select>
		          </div>
		           <div class="col-md-4 mb-3">
		            <label for="tipo">Tipo de Contrato</label>
		            <select class="custom-select form-control" name="tipo" required="">
		              @foreach($typeContracts as $typeContract)
			              <option value="{{ $typeContract->type_id }}" @if( $typeContract->type_id == old('tipo', $contracts->type_id)) selected @endif>{{ $typeContract->name }}</option>
			          @endforeach
		            </select>
		          </div>
		        </div>
			<br><br><br>
			<button type="submit" class="btn btn-success">Modicar Contrato</button>
			<a href="{{ route('listContract') }}" class="btn btn-default">Cancelar</a>	

		</form>

	</div>
</div>
@endsection
