@extends('layouts.app')
@section('content')

  
   
<div class="container">
			@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
	
	<div class="row">
		<h2> Listado de Comisiones clientes - servicios </h2>
		
			<div class="row">
					<form action="{{ url('/search-commission') }}"  method="post"  enctype="multipart/form-data" class="navbar-form navbar-left" >
						 {{ csrf_field() }}
						<div class="form-group">
							<input type="text" autofocus class="form-control" placeholder="Buscar clientes-servicios" name="query" value="{{ $query }}" size="35" maxlength="45"/>
							Fecha Desde:
							<input type="text" class="form-control dateTimeFrom" id="dateTimeFrom" name="dateFrom" value="{{ $dateFrom }}" autocomplete="off">
							Fecha Hasta:
							<input type="text" class="form-control dateTimeUntil" id="dateTimeUntil" name="dateTo" value="{{ $dateTo }}"  autocomplete="off">
						</div>
						<button type="submit" class="btn btn-info">
							<span >Buscar</span>
						</button>
					</form>
			</div>
			<br>
			@if(!empty($dateFrom))
			
				<table class="table">
				    <thead>
				        <tr>
				            <th class="text-center">#</th>
				            <th>Nombre</th>
				            <th>Total Transacciones</th>
				            <th>Total a Facturar Bs.</th>
				            <th>Descripciòn</th>
				            <th class="text-left">Fecha de referencia</th>
				        </tr>
				    </thead>
				    <tbody>
				    	<!-- {{ $cont=1 }} -->
				 		@foreach($listCommission as $key => $value1) 

							@if(($key % 2) == 1 )
							<tr style="background: #c5d9e6; padding-left:10px; padding-bottom:10px;">
							@else
							<tr style="background: #edeffbe8; padding-left: 10px; padding-bottom:10px;">
							@endif	
				            <td class="text-center">{{ $cont++ }}</td>
				            <td>{{ $value1['name'] }}</td>
				            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1['total_transaction'] }}</strong></td>  
				            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1['total_billing'] }}</strong></td>  
				            <td class="text-left">{{ $value1['description'] }}</td>
				             <td class="text-left">{{ $value1['created_at'] }}</td>
				        </tr>
				    @endforeach
				    </tbody>
				</table>
				@else
					<table class="table">
					    <thead>
					        <tr>
					            <th class="text-center">#</th>
					            <th>Nombre</th>
					            <th>Total Transacciones</th>
					            <th>Total a Facturar Bs.</th>
					            <th>Descripciòn</th>
					            <th class="text-left">Fecha de referencia</th>
					        </tr>
					    </thead>
					    <tbody>  
					        <tr>
					            <td class="text-center">&nbsp;</td>
					            <td>&nbsp;</td>
					            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>&nbsp;</strong></td>  
					            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>&nbsp;</strong></td>  
					            <td class="text-left">&nbsp;</td>
					             <td class="text-left">&nbsp;</td>
					        </tr>
					    </tbody>
					</table>
				@endif	
		
	</div>

	<div class="row">
	  <div class="col-md-4"></div>
	  <div class="col-md-4 text-left"></div>
	  <div class="col-md-3"></div>
	  
	</div>

</div>

@include('includes.footer')
@endsection