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
			            <th class="text-left" colspan="4">Razón social</th>
			            <th class="text-left" >Fecha referencial</th>
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
			            
			            	@if($value1->intervalos_cobro > 0) 
				            	<td class="text-left" colspan="2">{{ $value1->nombre_comercio }} 
								</td>
								<td class="text-left" colspan="2">
								<a class="button" id="mostrar_{{ $value1->import_id }}" onclick="showTable('mostrar',{{ $value1->import_id }})" >Ver Detalle</a>
								<a class="button1" id="ocultar_{{ $value1->import_id }}" style="display: none;" onclick="showTable('ocultar',{{ $value1->import_id }})">Ocultar Detalle</a></td>
								<td class="text-left">{{ $value1->fecha_referencial }}</td>
				            </tr> 
			            	<tr id="target_{{ $value1->import_id }}" style="display: none;"><td colspan="6"><table width="100%">
							<tr style="background: #c5d9e6; padding-left: 10px; padding-bottom:10px;">
								<td class="text-center">&nbsp;</td>
								<th class="text-left">Descripción de intervalo</th>
								<th class="text-left">Cantidad Trasacciones</th>
								<th class="text-left">Monto Total</th>
								<th class="text-left">Monto total a cobrar</th>
								
							</tr>
					        	<!--{{ $aux = 0 }}-->				            
					        @foreach($pagosNetSub as $kd => $valueD)
								@if($value1->import_id == $valueD->sub_import_id)

						            @if(($kd % 2) == 1 )
						            	<tr style="background: #ced4f9e8; padding-left: 10px; padding-bottom:10px;">
									@else
										<tr style="background: #b7bff5e8; padding-left: 10px; padding-bottom:10px;">
									@endif	
						            	<td class="text-center">&nbsp;</td>
						            	<td class="text-left">{{ $valueD->descripcion_intervalo }}</td>
						            	  <td  class="text-left" style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $valueD->cantidad_transacciones }}</strong></td>
							            <td class="text-left">{{ $valueD->monto_total }}</td>
							             <td class="text-left" style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $valueD->monto_total_cobrar }}</strong></td> 
							             <!--{{ $aux = $aux + $valueD->monto_total_cobrar }}-->
							        </tr>
						        @endif
				            @endforeach   
				            <tr style="background: #c9cff5; padding-left: 10px; padding-bottom:10px;"><td class="text-left" colspan="4"><strong>Total</strong></td><td><strong>{{ $aux }}</strong></td></tr>
					        </table></td></tr>
				         	@else

			            <td>{{ $value1->nombre_comercio }}</td>
			            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1->monto }}</strong></td>  
			            <td style="font-family: sans-serif;  font-size:100%;font-style: normal;"><strong>{{ $value1->monto_total_comision }}</strong></td>  
			            <td>{{ $value1->cantidad_transacciones }}</td>
			            <td class="text-left">{{ $value1->fecha_referencial }}</td>

			            @endif
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