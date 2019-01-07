@extends('layouts.app')


@section('content')

<div class="container">
			@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
	
	<div class="row">
		<h2> Listado de Entidades</h2>
		<div>
			<form class="navbar-form navbar-left" role='search' action="">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Buscar contratos" name="search" size="50" maxlength="30"/>
			</div>
			<button type="submit" class="btn btn-info">
				<span >Buscar</span>
			</button>
			<a href="{{ route('createService') }}" type="submit" class="btn btn-info">
				<span >Crear Nueva Entidad</span>
			</a>
			
		</form>
		</div>
			<table class="table">
			    <thead>
			        <tr>
			            <th class="text-center">#</th>
			            <th>Entidad</th>
			            <th>Cuenta</th>
			            <th>Ciudad</th>
			            <th class="text-right">Dirección</th>
			            <th class="text-right">Acciones</th>
			        </tr>
			    </thead>
			    <tbody>
			    
					@foreach($entities as $key => $value) 
			        <tr>
			            <td class="text-center">{{ $key+1 }}</td>
			            <td>{{ $value->name }}</td>
			            <td>{{ $value->bank_account }}</td>
			            <td>{{ $value->city }}</td>
			            <td>{{ $value->address }}</td>
			       		<td class="td-actions text-right">
			               <form method="post" action="{{ url('/'.$value->entity_id.'/entity') }}"> 
				            	{{ csrf_field() }}   
				            	{{ method_field('DELETE') }}
								<a type="button" rel="tooltip" title="Ver contrato" class="btn btn-info btn-simple btn-xs">
									<i class="fa fa-user">Ver</i>
								</a>
				                <a href="{{ url('/'.$value->entity_id.'/edit-entity') }}" type="button" rel="tooltip" title="Editar contrato" class="btn btn-success btn-simple btn-xs">
				                    <i class="fa fa-edit">Editar</i>
				                </a>
				                <button type="submit" rel="tooltip" title="Eliminar contrato" class="btn btn-danger btn-simple btn-xs">
				                    <i class="fa fa-times">Eliminar</i>
				                </button>
				           </form>

			            </td>
			        </tr>
			      	@endforeach
			       
			    </tbody>
			</table>
	</div>

	<div class="row">
	  <div class="col-md-4">{{ $entities->links() }}</div>
	  <div class="col-md-4 text-left"></div>
	  <div class="col-md-3"></div>
	  
	</div>

</div>
@endsection
