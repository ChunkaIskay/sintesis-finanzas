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
					<label for="codigo_carpeta">Código de la Carpeta</label>  
					<input type="text" class="form-control" id="codigo_carpeta" name="codigo_carpeta" value="{{ old('codigo_carpeta', $contracts->folder_code) }}">
			</div>

			<div class="form-group">
				<label for="codigo">Código del Contrato</label>
				<input type="text" class="form-control" id="codigo" name="codigo" value="{{ $contracts->code }}">
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
			<div  class="form-group">
				<label for="control-label">Renovación automática</label>
				<div class="radio" style="left: 30px;">
					@if($contracts->number_month != 0)
							<input type="radio" name="automatica" value="yes"  checked="true" onclick="showMonth();" />
							SI
							<div id="div1" style="display: block;">
								<label class="control-label">Meses consecutivos</label>
								<input type="number" id="numero_mes" class="select_n" name="numero_mes" value="{{ old('numero_mes', $contracts->number_month) }}" maxlength="2" size="4">
							</div>
					@else
						<input type="radio" name="automatica" value="yes"  onclick="showMonth();" />
							SI
						<div id="div1" style="display: none;">
							<label class="control-label">Meses consecutivos</label>
							<input type="number" id="numero_mes" class="select_n" name="numero_mes" value="{{ old('numero_mes', $contracts->number_month) }}" maxlength="2" size="4">
						</div>
					@endif
				</div>
				<div class="radio" style="left: 30px;">
					@if($contracts->number_month != 0)
						<input type="radio" name="automatica" value="no" onclick="notShowMonth();" />
						No
					@else
						<input type="radio" name="automatica" value="no" checked="true" onclick="notShowMonth();" />
						No
					@endif
				</div>
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
		        </div><br/>
		        <div  class="row">
		        	<div class="col-md-4 mb-3">
		        		<label for="habilitacion">Habilitación a Nivel</label>
				        <select name="enable_level[]" multiple class="custom-selec form-control">
							@foreach($levels as $l =>$level)
								<option value="{{ $l }}" {{ $level[1] }} >{{ $level[0] }} </option>
						        
							@endforeach	
						</select>
					</div>
					<div class="col-md-4 mb-6">&nbsp;
					</div>
				</div>
				<div class="form-group">
					<label for="description">Descripción del contrato</label>
					<textarea class="form-control" name="description" placeholder="Ingrese la descripción del contrato" rows="5">{{ $contracts->description }}</textarea>
				</div>
			<br><br><br>
			<button type="submit" class="btn btn-success">Modicar Contrato</button>
			<a href="{{ route('listContract') }}" class="btn btn-default">Cancelar</a>	
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
