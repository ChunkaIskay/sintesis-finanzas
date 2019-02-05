@extends('layouts.app')


@section('content')

<div class="container">
	<div class="row">
		<h2> Crear nuevo Contrato</h2>
		@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
         @endif
		<form action="{{ route('saveContract') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
				<input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo') }}">
			</div>
			<div class="form-group">
				<label for="description">Descripción del contrato</label>
				<textarea class="form-control" name="description" placeholder="Ingrese la descripción del contrato" rows="5">{{ old('description') }}</textarea>
			</div>
			<div class="form-group">
				<label for="servicio">Servicios</label>
				<select class="form-control form-control-large"  name="servicio"required="">
					  @foreach($services as $service)
			              <option value="{{ $service->service_id }}">{{ $service->name }}</option>
					  @endforeach			        
				</select>
			</div>
			<div class="form-group">
				<label for="entidad">Entidad</label>
				<select class="form-control form-control-large"  name="entidad" required="">
					 @foreach($entities as $entity)
			              <option value="{{ $entity->entity_id }}">{{ $entity->name }}</option>
					 @endforeach
				</select>
			</div>
				<div class="row">
		          <div class="col-md-4 mb-3">
		            <label for="cate_general">Categorización General</label>
		            <select class="custom-select form-control"  name="cate_general" required="">
		            	 @foreach($categorizations as $categorizationg)
		            	 	@if( $categorizationg->type == 'especifica' )	
			              		<option value="{{ $entity->entity_id }}">{{ $categorizationg->name }}</option>
			              	@endif
			             @endforeach
		            </select>
		          </div>
		   
		          <div class="col-md-4 mb-3">
		            <label for="cate_especifica">Categorización Específica</label>
		            <select class="custom-select form-control" name="cate_especifica" required="">
			              @foreach($categorizations as $categorizatione)
			              	@if( $categorizatione->type == 'general' )	
				              <option value="{{ $entity->entity_id }}">{{ $categorizatione->name }}</option>
				          	@endif
				          @endforeach
		            </select>
		          </div>
		           <div class="col-md-4 mb-3">
		            <label for="tipo">Tipo de Contrato</label>
		            <select class="custom-select form-control" name="tipo" required="">
		              @foreach($typeContracts as $typeContract)
			              <option value="{{ $entity->entity_id }}">{{ $typeContract->name }}</option>
			          @endforeach
		            </select>
		          </div>
		        </div>
		        	
			<br><br><br>
			<button type="submit" class="btn btn-success">Crear Contrato</button>	

		</form>

	</div>
</div>
@include('includes.footer')
@endsection
