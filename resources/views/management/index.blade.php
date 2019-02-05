@extends('layouts.app')
@section('content')
	<div class="container">
    <div class="row">
		<div class="col-md-12">
			<h3>Getión operativa de contratos</h3>
			<div class="row">
					<form action="{{ url('/search-contract') }}"  method="post"  enctype="multipart/form-data" class="navbar-form navbar-left" >
						 {{ csrf_field() }}
						<h4>Ingrese el código de contrato</h4>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Buscar contratos creados" name="query" size="50" maxlength="45"/>
						</div>

						<button type="submit" class="btn btn-info">
							<span >Buscar</span>
						</button>
					</form>
			</div>
			@if(isset($query))
					<div class="tabbable-panel">
						<div class="name">
							<h4 class="title">Resultados de la búsqueda</h4>
						</div>
						<div class="description text-center">
							<p>Se encontraton {{ $contracts->count() }} terminos.</p>
						</div>
						<table class="table table-striped">
						    <thead>
						        <tr>
						            <th class="text-center"></th>
						            <th>Código del Contrato</th>
						            <th class="text-right"></th>
						        </tr>
						    </thead>
						    <tbody>
								@foreach($contracts as $key => $value) 
						        <tr class="table-success">
						            <td class="text-center">{{ $key+1 }}</td>
						            <td>{{ $value->code }}</td>
						        
						        <td class="td-actions text-right">
					                    <a href="{{ url('/'.$value->contract_id.'/management') }}" type="button" rel="tooltip" title="Editar contrato" class="btn btn-success btn-simple btn-xs">
						                    <i class="fa fa-edit">Gestionar contrato</i>
						                </a>
						        </td>
						        </tr>	
						      	@endforeach
						    </tbody>
						</table>
					</div>
			@endif
			@if(isset($contract->code))
			<div class="tabbable-panel">
				<div class="tabbable-line">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_default_1" data-toggle="tab">
							Elaborar contrato</a>
						</li>
						<li class="disabled">
							<a href="#" data-toggle="tab">
							Envío de contrato</a>
						</li>
						<li class="disabled">
							<a href="#" data-toggle="tab">
							Recepción del contrato firmado </a>
						</li>
						<li class="disabled">
							<a href="#" data-toggle="tab">
							Solicitud de activación del servicio </a>
						</li>
						<li class="disabled">
							<a href="#" data-toggle="tab">
							Activacíon del servicio </a>
						</li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="tab_default_1" style="margin-left: 20px; margin-right: 15px;">
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
									<div class="row">
										<div class="col-md-3 text-right"><label for="tipo">Nombre de la entidad:</label></div>
										<div class="col-md-3">  <p> {{ $entity->name }} </p> </div>
										<div class="col-md-6">&nbsp;</div>
									</div>
									<div class="row">
										<div class="col-md-3 text-right"><label for="tipo">Nombre del Banco:</label></div>
										<div class="col-md-3">  <p> {{ $entity->bank_name }} </p> </div>
										<div class="col-md-6">&nbsp;</div>
									</div>
									<div class="row">
										<div class="col-md-3 text-right"><label for="tipo">Número de cuenta:</label></div>
										<div class="col-md-3">  <p> {{ $entity->bank_account }} </p> </div>
										<div class="col-md-6">&nbsp;</div>
									</div>
									<div class="row">
										<div class="col-md-3 text-right" ><label for="description">Descripción de la entidad:</label></div>
										
										<div class="col-md-6"><textarea style="resize:none" disabled class="form-control" id="exampleFormControlTextarea3" rows="4">{{ $entity->description }}</textarea></div>
										<div class="col-md-3">&nbsp;</div>
									</div>
									<div class="row">
										<div class="col-md-3 text-right"><label for="tipo">Dirección:</label></div>
										<div class="col-md-3">  <p> {{ $entity->address }} </p> </div>
										<div class="col-md-6">&nbsp;</div>
									</div>
									<div class="row">
										<div class="col-md-3 text-right"><label for="tipo">Ciudad:</label></div>
										<div class="col-md-3">  <p>{{ $country->city }} </p> </div>
										<div class="col-md-6">&nbsp;</div>
									</div>
								@endif


							<h4 class="texto">Datos del contacto</h4>
							<div class="row">
								<div class="col-md-3 text-right"><label for="nomvbre">Nombre del contacto:</label></div>
								<div class="col-md-6"><p>{{ $contact->name .' '. $contact->last_name }}</p></div>
								<div class="col-md-3">&nbsp;</div>
							</div>
							<div class="row">
								<div class="col-md-3 text-right"><label for="telefono">Teléfono:</label></div>
								<div class="col-md-6"><p>{{ $contact->phone }}</p></div>
								<div class="col-md-3">&nbsp;</div>
							</div>
							<div class="row">
								<div class="col-md-3 text-right"><label for="celular">Núnero de celular:</label></div>
								<div class="col-md-6"><p>{{ $contact->movile }}</p></div>
								<div class="col-md-3">&nbsp;</div>
							</div>
							<div class="row">
								<div class="col-md-3 text-right"><label for="email">Correo eléctronico:</label></div>
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
						</div>

						<div class="tab-pane" id="tab_default_2">
							<p>
								Howdy, I'm in Tab 2.
							</p>
							<p>
								Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation.
							</p>
							<p>
								<a class="btn btn-warning" href="http://j.mp/metronictheme" target="_blank">
									Click for more features...
								</a>
							</p>
						</div>
						<div class="tab-pane" id="tab_default_3">
							<p>
								Howdy, I'm in Tab 3.
							</p>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
							<p>
								<a class="btn btn-info" href="" target="_blank">
									Learn more...
								</a>
							</p>
						</div>
						<div class="tab-pane" id="tab_default_4">
							<p>
								Howdy, I'm in Tab 3.
							</p>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
							<p>
								<a class="btn btn-info" href="" target="_blank">
									Learn more...
								</a>
							</p>
						</div>
						<div class="tab-pane" id="tab_default_5">
							<p>
								Howdy, I'm in Tab 3.
							</p>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
							<p>
								<a class="btn btn-info" href="" target="_blank">
									Learn more...
								</a>
							</p>
						</div>

					</div>
				</div>
			</div>
			 @endif

		</div>
	</div>
</div>
@include('includes.footer')
@endsection
