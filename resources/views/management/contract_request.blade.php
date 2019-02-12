
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


