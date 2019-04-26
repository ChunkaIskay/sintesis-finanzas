@extends('layouts.app')
@section('content')
 
<div class="container">
			@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
	
	<div class="row">
		<h2> Listado de Comisiones clientes - servicios de Pagos Net</h2>
			<div class="row">
					<form action="{{ url('/search-pay-entity') }}"  method="post"  enctype="multipart/form-data" class="navbar-form navbar-left" >
						 {{ csrf_field() }}
						<div class="form-group">
							<input type="text" autofocus class="form-control" placeholder="Buscar clientes-servicios" name="query" value="{{ old('query',$query) }}" size="35" maxlength="45"/>
							Fecha Desde:
							<input type="text" class="form-control dateTimeFrom" id="dateTimeFrom" name="dateFrom" value="{{ old('dateFrom',$dateFrom) }}" autocomplete="off">
							Fecha Hasta:
							<input type="text" class="form-control dateTimeUntil" id="dateTimeUntil" name="dateTo" value="{{ old('dateTo',$dateTo) }}"  autocomplete="off">
						</div>
						<button type="submit" class="btn btn-info">
							<span >Buscar</span>
						</button>
					</form>
			</div>
			<br>
								

			<table class="table">
			    <thead>
			        <tr>
			            <th class="text-center">#</th>
			            <th>Entidad</th>
			            <th>Servicio</th>
			            <th>Total Recaudado</th>
			            <th>Total de transacciones</th>
			            <th>Pagos de comisiones</th>
			            <th class="text-left">Fecha de referencia</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<!-- {{ $cont=1 }} {{ $enty='x' }} -->
			 		@foreach($listCommission as $key => $value1) 
						

						@if($enty <> $value1['desc_enti'])
						<tr style="background: #b1dab8; padding-left:10px; padding-bottom:10px;">
							 <td class="text-left" colspan="7"><strong>{{ $cont++ }} - {{ $value1['desc_enti'] }}</strong></td>
						</tr>	 
						@endif

						@if(($key % 2) == 1 )
						<tr style="background: #c5d9e6; padding-left:10px; padding-bottom:10px;">
						@else
						<tr style="background: #edeffbe8; padding-left: 10px; padding-bottom:10px;">
						@endif
			            <td class="text-center">&nbsp;</td>
			            <td>{{ $value1['desc_enti'] }}</td>
			            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1['desc'] }}</strong></td>  
			            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1['valTot'] }}</strong></td>  
			            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1['tot'] }}</strong></td>
			            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1['total_billing'] }}</strong></td>  
			            <td class="text-left">{{ $value1['created_at'] }}</td>
			        	</tr>
				     <!-- {{ $enty = $value1['desc_enti'] }} -->  
			   	 @endforeach
			    </tbody>
			</table>
	</div>
	<div class="row">
		  <div class="col-md-4"></div>
		  <div class="col-md-4 text-left"></div>
		  
		  <div class="col-md-3"></div>
	</div>

</div>

@include('includes.footer')
@endsection