@extends('layouts.app')
@section('content')

<div class="container">
			@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
	
	<div class="row">
		<h2> Historial de Comisiones clientes - servicios </h2>
		<div>
			<div class="row">
					<form action="{{ url('/search-history') }}"  method="post"  enctype="multipart/form-data" class="navbar-form navbar-left" >
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
		</div>
			<table class="table">
			    <thead>
			        <tr>
			            <th class="text-center">#</th>
			            <th>Nombre</th>
			            <th>Total Transacciones</th>
			            <th>Total a Facturar Bs.</th>
			            <th>Fecha de referencia</th>
			            <th>Descripciòn</th>
			        </tr>
			    </thead>
			    <tbody>  
			 		@foreach($listCommission as $key => $value1) 
			        <tr>
			            <td class="text-center">{{ $key+1 }}</td>
			            <td>{{ $value1->name }}</td>
			            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1->total_transaction }}</strong></td>  
			            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1->total_billing }}</strong></td>
			            <td>{{ $value1->created_at }}</td>  
			            <td class="text-left">{{ $value1->description }}</td>
			        </tr>
			      	@endforeach
			    </tbody>
			</table>
	</div>

	<div class="row">
	  <div class="col-md-4"></div>
	  <div class="col-md-4 text-left">{{ $listCommission->appends(['dateFrom' => $dateFrom, 'dateTo' => $dateTo, 'query' => $query ])->links() }}</div>
	  <div class="col-md-3"></div>
	  
	</div>

</div>

@include('includes.footer')
@endsection