<style type="text/css">
	
	.extra{
		background-color: #f7f9fb;
	}
	

</style>


<div class="tab-pane active" id="tab_default_1" style="margin-left: 20px; margin-right: 15px;">
<form action="{{ url('/'.$entity->entity_id.'/update-entity') }}" method="post" enctype="multipart/form-data" >
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
	<div class="row">
		<div class="col-md-3 text-right"><label for="codigo">Código del Contrato:</label></div>
		<div class="col-md-3">{{ $contract->code }}</div>
		<div class="col-md-6">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-3 text-right"><label for="servicio">Servicios:</label></div>
		<div class="col-md-6">  <p> {{ $service->name }}</p></div>
		<div class="col-md-3">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-3 text-right"><label for="entidad">Entidad:</label></div>
		<div class="col-md-6">  <p> {{ $entity->name }}</p></div>
		<div class="col-md-3">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-3 text-right"><label for="cate_general">Categorización General:</label></div>
		<div class="col-md-6">  <p> 
									@foreach($categorizations as $categorizationg)
					            	 	@if( $categorizationg->type == 'especifica' )	
						              		@if( $categorizationg->categorization_id == $contract->general_category_id) 
						              			{{ $categorizationg->name }}	
						              		@endif
						              	@endif
						             @endforeach
			  					</p>
		</div>
		<div class="col-md-3">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-3 text-right"><label for="cate_especifica">Categorización Específica:</label></div>
		<div class="col-md-6">  <p> 
									@foreach($categorizations as $categorizatione)
										@if( $categorizatione->type == 'general' )	
											@if( $categorizatione->categorization_id == $contract->specific_category_id)
												{{ $categorizatione->name }}
											@endif
										@endif
									@endforeach
			  					</p>
		</div>
		<div class="col-md-3">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-3 text-right"><label for="tipo">Tipo de Contrato:</label></div>
		<div class="col-md-6">  <p> {{ $typeContract->name }}</p></div>
		<div class="col-md-3">&nbsp;</div>
	</div>

	<div class="row">
		<div class="col-md-3 text-right" ><label for="description">Descripción del contrato:</label></div>
		
		<div class="col-md-6"><textarea style="resize:none" disabled class="form-control" id="exampleFormControlTextarea3" rows="4">{{ $contract->description }}</textarea></div>
		<div class="col-md-3">&nbsp;</div>
	</div>
	<h4 class="texto">Datos de la entidad</h4>

		@if($entity->entity_id == $contract->entity_id )
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
		<h4 class="texto">Datos del contacto</h4>
		<div class="row">
			<div class="col-md-3 text-left"><label for="nomvbre">Nombre del contacto:</label></div>
			<div class="col-md-6"><p>{{ $contact->name .' '. $contact->last_name }}</p></div>
			<div class="col-md-3">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-3 text-left"><label for="telefono">Teléfono:</label></div>
			<div class="col-md-6"><p>{{ $contact->phone }}</p></div>
			<div class="col-md-3">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-3 text-left"><label for="celular">Núnero de celular:</label></div>
			<div class="col-md-6"><p>{{ $contact->movile }}</p></div>
			<div class="col-md-3">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-3 text-left"><label for="email">Correo eléctronico:</label></div>
			<div class="col-md-6"><p>{{ $contact->email }}</p></div>
			<div class="col-md-3">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-3 text-right"><label for="cargo">Cargo:</label></div>
			<div class="col-md-6"><p>{{ $contact->position }}</p></div>
			<div class="col-md-3">&nbsp;</div>
		</div>
		<div class="row">
			<button type="submit" class="btn btn-success">Generar fecha de creación</button>
			<a href="{{ route('createdManagement') }}" class="btn btn-default">Cancelar</a>
		</div>
</form>
</div>

			


