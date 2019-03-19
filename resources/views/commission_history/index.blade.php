@extends('layouts.app')
@section('content')

 <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('scripts/datepicker/css/datepicker.css')}}">
    
    <script src="{{asset('scripts/datepicker/js/bootstrap-datepicker.js')}}"></script>
   
<div class="container">
			@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
	
	<div class="row">
		<h2> Listado de historial de Comisiones clientes - servicios </h2>
		<div>
			<form class="navbar-form navbar-left" role='search' action="">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Buscar contratos" name="search" size="50" maxlength="30"/>
				</div>
				<button type="submit" class="btn btn-info">
					<span >Buscar</span>
				</button>
				
				<input class="datepicker form-control" type="text" name="date" value="03/12/2016"/>
			</form>
		</div>
			<table class="table">
			    <thead>
			        <tr>
			            <th class="text-center">#</th>
			            <th>Nombre</th>
			            <th>Total Transacciones</th>
			            <th>Total a Facturar Bs.</th>
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
			            <td class="text-left">{{ $value1->description }}</td>
			        </tr>
			      	@endforeach
			    </tbody>
			</table>
	</div>

	<div class="row">
	  <div class="col-md-4">{{ $listCommission->links() }}</div>
	  <div class="col-md-4 text-left"></div>
	  <div class="col-md-3"></div>
	  
	</div>

</div>

<script type="text/javascript">

	$('.datepicker').datepicker({
	format: "dd/mm/yyyy"
});

</script>
@include('includes.footer')
@endsection