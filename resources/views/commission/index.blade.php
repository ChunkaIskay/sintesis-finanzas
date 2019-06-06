@extends('layouts.app')
@section('content')
<style type="text/css">
  .button {
    display: block;
    width: 115px;
    height: 25px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}
.button1 {
    display: none;
    width: 115px;
    height: 25px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}



</style>
  
   
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

				            @if(array_key_exists('0', $value1)) 
				            	<td class="text-left" colspan="2">{{ $value1[0]['name'] }} 
								</td>
								<td class="text-left" colspan="3">
								<a class="button" id="mostrar_{{ $value1[0]['cli'] }}" onclick="showTable('mostrar',{{ $value1[0]['cli'] }})" style="display: none;">Ver Detalle</a>
								<a class="button1" id="ocultar_{{ $value1[0]['cli'] }}" onclick="showTable('ocultar',{{ $value1[0]['cli'] }})">Ocultar Detalle</a></td>
				            </tr> 
				            	<tr id="target_{{ $value1[0]['cli'] }}"><td colspan="6"><table width="100%">
								<tr style="background: #c5d9e6; padding-left: 10px; padding-bottom:10px;">
									<td class="text-center">&nbsp;</td>
									<th class="text-center">Nombre</th>
									<th class="text-center">Cantidad</th>
									<th>Detalle</th>
									<th>P/U</th>
									<th>Subtotal</th>
								</tr>
					        	
					            @foreach($value1 as $kd => $valueDetail)
					            
					            @if(($kd % 2) == 1 )
					            	<tr style="background: #ced4f9e8; padding-left: 10px; padding-bottom:10px;">
								@else
									<tr style="background: #b7bff5e8; padding-left: 10px; padding-bottom:10px;">
								@endif	
					            	<td class="text-center">&nbsp;</td>
					            	<td class="text-center">{{ $valueDetail['name'] }}</td>
						              <td  class="text-center" style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $valueDetail['total_transaction'] }}</strong></td>
						            <td class="text-left">{{ $valueDetail['description'] }}</td>
						             <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $valueDetail['pu'] }}</strong></td> 
						            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $valueDetail['total_billing'] }}</strong></td> 
						        </tr>
					            @endforeach
					        
					        </table></td></tr>
				         	@else
				         		<td>{{ $value1['name'] }}</td>
					            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1['total_transaction'] }}</strong></td>  
					            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1['total_billing'] }}</strong></td>  
					            <td class="text-left">{{ $value1['description'] }}</td>
					            <td class="text-left">{{ $value1['created_at'] }}</td>

				         	@endif

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

<script type="text/javascript">

		function showTable(mostrar, code){ 

			mmostrar = 'mostrar_'+code;
			oocultar = 'ocultar_'+code;
			ttarget = 'target_'+code;

			if(mostrar == 'ocultar')
			{  
				document.getElementById(mmostrar).style.display = 'block';
				document.getElementById(oocultar).style.display = 'none';
				$('#target_'+code).show(2000);
				$('#target_'+code).hide("fast");
			}
			else
			{
				document.getElementById(oocultar).style.display = 'block';
				document.getElementById(mmostrar).style.display = 'none';
				$('#target_'+code).show(2000);
				$('.target_'+code).show("slow");
			}
		}

</script>

@include('includes.footer')
@endsection