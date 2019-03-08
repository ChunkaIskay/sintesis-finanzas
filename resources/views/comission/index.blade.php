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
		<h2> Listado de clientes - servicios</h2>
		<div>
			<form class="navbar-form navbar-left" role='search' action="">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Buscar contratos" name="search" size="50" maxlength="30"/>
				</div>
				<button type="submit" class="btn btn-info">
					<span >Buscar</span>
				</button>
				<a href="{{ route('createContract') }}" type="submit" class="btn btn-info">
					<span >Ver listado</span>
				</a>
				<input class="datepicker form-control" type="text" name="date" value="03/12/2016"/>
			</form>
		</div>
			<table class="table">
			    <thead>
			        <tr>
			            <th class="text-center">#</th>
			            <th>Código del Contrato</th>
			            <th>Servicio</th>
			            <th>Entidad</th>
			            <th class="text-right">Categoria general</th>
			            <th class="text-right">Categoria especifica</th>
			            <th class="text-right">Tipo</th>
			            <th class="text-right">Acciones</th>
			        </tr>
			    </thead>
			    <tbody>
			   
				     <tr>
			            <td class="text-center"></td>
			            <td></td>
			            <td></td>
			            <td></td>  
			            <td class="text-right">
		                	</td>
			            <td class="text-right"></td>
			            <td class="text-right"></td>
						<td class="td-actions text-right">
			                <form method="post" action=""> 
				            	{{ csrf_field() }}   
				            	{{ method_field('DELETE') }} 
								<a href=""  type="button" rel="tooltip" title="Ver contrato" class="btn btn-info btn-simple btn-xs">
									<i class="fa fa-user">Gestionar contrato</i>
								</a>
				                <a href="" type="button" rel="tooltip" title="Editar contrato" class="btn btn-success btn-simple btn-xs">
				                    <i class="fa fa-edit">Editar</i>
				                </a>
				                <button type="submit" rel="tooltip" title="Eliminar contrato" class="btn btn-danger btn-simple btn-xs">
				                    <i class="fa fa-times">Eliminar</i>
				                </button>
				             </form>

			            </td>
			        </tr>
			      
			       
			    </tbody>
			</table>

	
	</div>

	<div class="row">
	  <div class="col-md-4"><!----></div>
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
