<style type="text/css">
	.hide {
	  display: none;
	}

	.select_n {
		    width: 80px;
		    height: 36px;
		    padding: 6px 12px;
		    background-color: #fff;
		    background-image: none;
		    border: 1px solid #ccd0d2;
		    border-radius: 4px;

	}
	.select_m {
		    width: 150%x;
		    height: 130px;
		    padding: 6px 12px;
		    background-color: #fff;
		    background-image: none;
		    border: 1px solid #ccd0d2;
		    border-radius: 4px;
	}
</style>

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
					<label for="codigo_carpeta">Código de la Carpeta</label>
					<input type="text" class="form-control" id="codigo_carpeta" name="codigo_carpeta" value="{{ old('codigo_carpeta') }}">
				</div>

				<div class="form-group">
					<label for="codigo">Código del Contrato</label>
					<input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo') }}">
				</div>
				<div class="form-group">
					<label for="entidad">Entidad</label>
					<select class="form-control form-control-large"  name="entidad" required="">
						 @foreach($entities as $entity)
				              <option value="{{ $entity->entity_id }}">{{ $entity->name }}</option>
						 @endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="servicio">Servicios</label>
					<select class="form-control form-control-large"  name="servicio"required="">
						  @foreach($services as $service)
				              <option value="{{ $service->service_id }}">{{ $service->name }}</option>
						  @endforeach			        
					</select>
				</div>
				<div  class="form-group">
					<label for="control-label">Renovación automática</label>
					<div class="radio" style="left: 30px;">
						<input type="radio" name="automatica" value="yes"  onclick="showMonth();" />
						SI
						<div id="div1" style="display: none;">
							<label class="control-label">Meses consecutivos</label>
							<input type="number" id="numero_mes" class="select_n" name="numero_mes" value="{{ old('numero_mes') }}" maxlength="2" size="4">
						</div>
					</div>
					<div class="radio" style="left: 30px;">
						<input type="radio" name="automatica" value="no" onclick="notShowMonth();" />
						No
					</div>
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
		        </div><br/>
		        <div  class="row">
		        	<div class="col-md-4 mb-3">
		        		<label for="habilitacion">Habilitación a Nivel</label>
				        <select name="enable_level[]" multiple class="custom-selec form-control">
							@foreach($levels as $l =>$level)
							  	<option value="{{ $l }}" @if( $level == old('enable_level')) selected @endif>{{ $level }}
						              </option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4 mb-6">&nbsp;
					</div>
				</div>
			<br/>
		        <div class="form-group">
					<label for="description">Descripción del contrato</label>
					<textarea class="form-control" name="description" placeholder="Ingrese la descripción del contrato" rows="5">{{ old('description') }}</textarea>
				</div>
		        	
			<br><br><br>
			<button type="submit" class="btn btn-success">Crear Contrato</button>	

		</form>

	</div>
</div>
<script type="text/javascript">
	function notShowMonth(){ 
	  document.getElementById('div1').style.display ='none';
	}
	function showMonth(){ 
	  document.getElementById('div1').style.display ='block';
	}
</script>

@include('includes.footer')
@endsection
