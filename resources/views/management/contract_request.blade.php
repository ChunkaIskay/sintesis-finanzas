<style type="text/css">
	
	.extra{
		background-color:#f7f9fb;
	}
	

</style>


<div class="tab-pane active" id="tab_default_1" style="margin-left: 20px; margin-right: 15px;">
<form action="{{ url('/'.$contact.'/update-entity') }}" method="post" enctype="multipart/form-data" >
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
	<h4 class="texto">Datos del Contrato</h4>
	<div style="background: #edeffbe8; padding-left: 10px; padding-bottom:10px;"><br>
		<div class="row">
			<div class="col-md-2 text-left"><label for="codigo">Código del Contrato:</label></div>
			<div class="col-md-3">
				<div class="form-group">
						<input type="text" class="form-control" id="codigo" name="codigo" value="{{ $contract->code }}">
				</div>
			</div>
			<div class="col-md-2 text-left"><label for="codigo_carpeta">Código de la Carpeta</label></div>
			
			<div class="col-md-3">
				<div class="form-group">
						<input type="text" class="form-control" id="codigo_carpeta" name="codigo_carpeta" value="{{ old('codigo_carpeta', $contract->folder_code) }}">
				</div>
			</div>
		</div>
	</div>
	<div style="background: #f7f9fb; padding-left: 10px; padding-bottom:10px;"><br>
		<div class="row">
			<div class="col-md-2 text-left"><label for="servicio">Servicios:</label></div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control form-control-large"  name="servicio" required="">
						@foreach($services as $service)
				              <option value="{{ $service->service_id }}" @if( $service->service_id == old('servicio', $contract->service_id)) selected @endif >{{ $service->name }}</option>
						@endforeach			        
					</select>
				</div>
			</div>
			<div class="col-md-2 text-left"><label for="entidad">Entidad</label></div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control form-control-large"  name="entidad" required="">
				         @foreach($entities as $entity)
				              <option value="{{ $entity->entity_id }}" @if( $entity->entity_id == old('entidad', $contract->entity_id)) selected @endif>{{ $entity->name }}</option>
						 @endforeach
					</select>
				</div>
			</div>
		</div>
	</div>		
	<div style="background: #edeffbe8; padding-left: 10px; padding-bottom:10px;"><br>
		<div class="row">
			<div class="col-md-3 text-left"><label for="control-label">Renovación automática</label></div>
			<div class="col-md-1">
				<div class="form-group">
						@if($contract->number_month != 0)
							<input type="radio" name="automatica" value="no" onclick="notShowMonth();" />
							NO
						@else
							<input type="radio" name="automatica" value="no" checked="true" onclick="notShowMonth();" />
							NO
						@endif
				</div>
			</div>
			
			<div class="col-md-8">
				<div class="row">
						@if($contract->number_month != 0)
						<div class="col-md-1">
							<div class="form-group">
								<input type="radio" name="automatica" value="yes"  checked="true" onclick="showMonth();" />
								SI
							</div>		
						</div>		
						<div class="col-md-5">	
							<div class="form-group">
								<div class="col-sm-9 text-right">Meses consecutivos</div>
								<div class="col-sm-3">
									<input type="number" id="numero_mes" class="form-control form-control-large" name="numero_mes" value="{{ old('numero_mes', $contract->number_month) }}" maxlength="2" size="4">
								</div>
							</div>
						 </div>
						@else
						<div class="col-md-1">
							<div class="form-group">
								<input type="radio" name="automatica" value="yes"  onclick="showMonth();" />
								SI
							</div>		
						</div>
						<div class="col-md-5">
							<div id="div1" style="display: none;">
								<div class="col-sm-7 text-left">Meses consecutivos</div>
								<div class="col-sm-5">
									<input type="number" id="numero_mes" class="form-control form-control-large" name="numero_mes" value="{{ old('numero_mes', $contract->number_month) }}" maxlength="2" size="4">
								</div>
							</div>
						</div>
						@endif
				</div>	
			</div>
		</div>
	</div>	
	<div style="background: #f7f9fb; padding-left: 10px; padding-bottom:10px;"><br>
		<div class="row">
			<div class="col-md-2 text-left"><label for="cate_general">Categorización General</label></div>
			<div class="col-md-3"><select class="custom-select form-control"  name="cate_general" required="">
					             	@foreach($categorizations as $categorizationg)
					            	 	@if( $categorizationg->type == 'especifica' )	
						              		<option value="{{ $categorizationg->categorization_id }}" @if( $categorizationg->categorization_id == old('cate_general', $contract->general_category_id)) selected @endif>{{ $categorizationg->name }}</option>
						              	@endif
						             @endforeach
					            </select>
			</div>
			<div class="col-md-3 text-left"><label for="cate_especifica">Categorización Específica</label></div>
			<div class="col-md-3"><select class="custom-select form-control" name="cate_especifica" required="">
					              	@foreach($categorizations as $categorizatione)
						              	@if( $categorizatione->type == 'general' )	
							              <option value="{{ $categorizatione->categorization_id }}" @if( $categorizatione->categorization_id == old('cate_especifica', $contract->specific_category_id)) selected @endif>{{ $categorizatione->name }}</option>
							          	@endif
							         @endforeach
					            </select>
			</div>
		</div>
	</div>
	
	<div style="background: #edeffbe8; padding-left: 10px; padding-bottom:10px;">
		<div class="row">
			<br>
			<div class="col-md-2 text-left"><label for="tipo">Tipo de Contrato</label></div>
			<div class="col-md-3">
					<select class="custom-select form-control" name="tipo" required="">
		              @foreach($typeContracts as $typeContract)
			              <option value="{{ $typeContract->type_id }}" @if( $typeContract->type_id == old('tipo', $contract->type_id)) selected @endif>{{ $typeContract->name }}</option>
			          @endforeach
		            </select>
			</div>
			<div class="col-md-3 text-left"><label for="habilitacion">Habilitación a Nivel</label></div>
			<div class="col-md-3">
					<select name="enable_level[]" multiple class="custom-selec form-control">
						@foreach($levels as $l =>$level)
							<option value="{{ $l }}" {{ $level[1] }} >{{ $level[0] }} </option>
					        
						@endforeach	
					</select>
			</div>

		</div>
		<br>
	</div>

	<h4 class="texto">Datos de la entidad</h4>

		@if($entity2->entity_id == $contract->entity_id )
			<div style="background: #f7f9fb; padding-left: 10px; padding-bottom:10px;">
				<div class="row">
					<br>
					<div class="col-md-2 text-left"><label for="code">Código de la entidad</label></div>
					<div class="col-md-3">
						<div class="form-group"><input type="text" class="form-control" id="code" name="code" value="{{ old('code', $entity->code) }}"> 
						</div>
					</div>
					<div class="col-md-2 text-left"><label for="name">Nombre de la entidad</label></div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control" id="name" name="name" value="{{ old('name', $entity->name) }}">
						</div>
					</div>
				</div>
			</div>
			@foreach($accounts as $key => $account)
			@if($key == 1 )
			<div style="background: #f7f9fb; padding-left:10px; padding-bottom:10px;">
			@else
			<div style="background: #edeffbe8; padding-left: 10px; padding-bottom:10px;">
			@endif	
			<br>
			<h4 class="texto" style="color:#324280;">{{ $account->description }}</h4>

				<div class="row">
						<br>
						<div class="col-md-2 text-left">
							<label for="nombre_cuenta_{{ $key}}">Nombre de la cuenta {{ $key +1 }}:</label>
						</div>
						<div class="col-md-3"><div class="form-group">
							<input type="text" class="form-control" id="nombre_cuenta_{{$key}}" name="nombre_cuenta_{{$key}}" value="{{ old('nombre_cuenta_$key', $account->account_name) }}"> </div>
						</div>
						<div class="col-md-2 text-left"><label for="number_account_{{ $key}}"># Cuenta {{ $key +1 }}</label></div>
						<div class="col-md-3">
							<div class="form-group">
										@if(!empty($account->number_account))
										<input type="text" class="form-control" id="number_account_{{ $key}}" name="number_account_{{ $key}}" value="{{ old('number_account_$key', $account->number_account) }}">
									@else
							<input type="text" class="form-control" id="number_account_{{ $key}}" name="number_account_{{ $key}}" value="">
									@endif
							</div>
						</div>
				 	
				</div>
				<div class="row">
					<div class="col-md-1 text-left"><label for="bank_{{ $key}}">Banco</label></div>
					<div class="col-md-2">
							<div class="form-group">
								<select class="form-control form-control-large"  name="bank_{{ $key}}" required="">
									 @foreach($bank as $value)   
									 	  <option value="{{ $value->bank_id }}" @if( $value->bank_id == old('bank_id_{{ $key}}', $account->bank_id)) selected @endif>{{ $value->short_name }}
							              </option>
									 @endforeach
								</select>
							</div>
					</div>
					<div class="col-md-1 text-left"><label for="bank_type_{{ $key}}">Tipo</label>
								</div>
					<div class="col-md-2">
							<div class="form-group">
								<select class="form-control form-control-large"  name="bank_type_{{ $key}}" required="">
									 @foreach($type as $k => $value)   
									 	  <option value="{{ $k }}" @if( $k == old('bank_type_{{ $key}}', $account->type_account)) selected @endif>{{ $value }}
							              </option>
									 @endforeach
								</select>
							</div>
					</div>
					<div class="col-md-1 text-left"><label for="bank_coin_{{ $key}}">Moneda</label>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<select class="form-control form-control-large"  name="bank_coin_{{ $key}}" required="">
									 @foreach($coin as $value)   
									 	  <option value="{{ $value }}" @if( $value == old('bank_coin_{{ $key}}', $account->coin)) selected @endif>{{ $value }}
							              </option>
									 @endforeach
								</select>
							</div>
						</div>
				</div>
			</div>
		@endforeach

		@endif
		<h4 class="texto">Datos de la persona con la que conciliara</h4>
		<div class="row">
			<div class="col-md-3 text-left"><label for="nomvbre">Nombre:</label></div>
			<div class="col-md-6">
				<div class="form-group">
						<input type="text" class="form-control" id="codigo" name="codigo" value="">
				</div></div>
			<div class="col-md-3">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-3 text-left"><label for="telefono">Teléfono:</label></div>
			<div class="col-md-6"><p></p></div>
			<div class="col-md-3">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-3 text-left"><label for="celular">Núnero de celular:</label></div>
			<div class="col-md-6"><p></p></div>
			<div class="col-md-3">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-3 text-left"><label for="email">Correo eléctronico:</label></div>
			<div class="col-md-6"><p></p></div>
			<div class="col-md-3">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-3 text-left"><label for="cargo">Cargo:</label></div>
			<div class="col-md-6"><p></p></div>
			<div class="col-md-3">&nbsp;</div>
		</div>
		<div class="row">
			<button type="submit" class="btn btn-success">Generar fecha de creación</button>
			<a href="{{ route('createdManagement') }}" class="btn btn-default">Cancelar</a>
		</div>
</form>
</div>


<script type="text/javascript">
	function notShowMonth(){ 
	  document.getElementById('div1').style.display ='none';
	}
	function showMonth(){ 
	  document.getElementById('div1').style.display ='block';
	}
</script>		


