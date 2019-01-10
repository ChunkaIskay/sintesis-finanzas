@extends('layouts.app')


@section('content')

<div class="container">
			@if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
	
	<div class="row">
		<h2> Listado de contactos</h2>
		<div>
			<form class="navbar-form navbar-left" role='search' action="">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Buscar contratos" name="search" size="50" maxlength="30"/>
			</div>
			<button type="submit" class="btn btn-info">
				<span >Buscar</span>
			</button>
			<a href="{{ route('createContact') }}" type="submit" class="btn btn-info">
				<span >Crear Nuevo Contacto</span>
			</a>
			
		</form>
		</div>
			<table class="table">
			    <thead>
			        <tr>
			            <th class="text-center">#</th>
			            <th>Nombre contacto</th>
			            <th>Celular</th>
			            <th>Teléfono</th>
			            <th>Email</th>
			            <th class="text-right">Cargo</th>
			            <th class="text-right">Entidad</th>
			            <th class="text-right">Acciones</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($contacts as $key => $value) 
			        <tr>
			            <td class="text-center">{{ $key+1 }}</td>
			            <td>{{ $value->name . ' ' . $value->last_name }}</td>
			            <td>{{ $value->movile }}</td>
			            <td>{{ $value->phone }}</td> 
			            <th>{{ $value->email }}</th> 
			            <td class="text-right">{{ $value->position }}</td>
			            <td class="text-right">{{ $value->entity_name }}</td>
			            <td class="td-actions text-right">
			                <form method="post" action="{{ url('/'.$value->contact_id.'/contact') }}"> 
				            	{{ csrf_field() }}   
				            	{{ method_field('DELETE') }} 
								<a type="button" rel="tooltip" title="Ver contacto" class="btn btn-info btn-simple btn-xs">
									<i class="fa fa-user">Ver</i>
								</a>
				                <a href="{{ url('/'.$value->contact_id.'/edit-contact') }}" type="button" rel="tooltip" title="Editar contacto" class="btn btn-success btn-simple btn-xs">
				                    <i class="fa fa-edit">Editar</i>
				                </a>
				                <button type="submit" rel="tooltip" title="Eliminar contacto" class="btn btn-danger btn-simple btn-xs">
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
	  <div class="col-md-4">{{ $contacts->links() }}</div>
	  <div class="col-md-4 text-left"></div>
	  <div class="col-md-3"></div>
	  
	</div>

</div>
@endsection
