@extends('layouts.app')
@section('content')
	<div class="container">
    <div class="row">
		<div class="col-md-12">
			<h3>Gestión operativa de contratos</h3>
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
							Solicitar contrato</a>
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
						@include('management.contract_request')
						@include('management.contract_send')
						@include('management.contract_received')
						@include('management.service_request')
						@include('management.activated_service')
					</div>
				</div>
			</div>
			 @endif

		</div>
	</div>
</div>
@include('includes.footer')
@endsection
