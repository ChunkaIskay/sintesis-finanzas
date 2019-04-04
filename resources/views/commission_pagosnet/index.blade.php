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
					<form action="{{ url('/search-pagosnet') }}"  method="post"  enctype="multipart/form-data" class="navbar-form navbar-left" >
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
			            <th>Razón social</th>
			            <th>Total Recaudado</th>
			            <th>Total de transacciones</th>
			            <th>Comisiòn a cobrar</th>
			            <th class="text-left">Fecha de referencia</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<!-- {{ $cont=1 }} -->
			 		@foreach($pagosNet as $key => $value1) 

						@if(($key % 2) == 1 )
						<tr style="background: #c5d9e6; padding-left:10px; padding-bottom:10px;">
						@else
						<tr style="background: #edeffbe8; padding-left: 10px; padding-bottom:10px;">
						@endif	
			            <td class="text-center">{{ $cont++ }}</td>
			            <td>{{ $value1->razon_social }}</td>
			            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1->monto }}</strong></td>  
			            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1->monto_total_comision }}</strong></td>  
			            <td>{{ $value1->cantidad_transacciones }}</td>
			            <td class="text-left">{{ $value1->fecha_referencial }}</td>
			        </tr>
			   	 @endforeach
			    </tbody>
			</table>
	</div>
	<div class="row">
		  <div class="col-md-4"></div>
		  <div class="col-md-4 text-left">{{ $pagosNet->appends(['dateFrom' => $dateFrom, 'dateTo' => $dateTo, 'query' => $query ])->links() }}</div>
		  
		  <div class="col-md-3"></div>
	</div>

</div>

@include('includes.footer')
@endsection