@include('shared.header')

<div = class="container-fluid">
	<h1 class="display-3">Clientes</h1>
</div>
<br>
<div class ="container">
	<div class="row">
		<div class="col-md-12">
				<table class="table table-hover table-smS">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Id</th>
				      <th scope="col">DNI</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Apellido</th>
				      <th scope="col">Telefono</th>
				      <th scope="col">Direccion</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach ($clientes as $cliente)
					    <tr>
					      <th scope="row">{{$cliente->id}}</th>
					      <td>{{$cliente->dni}}</td>
					      <td>{{$cliente->nombre}}</td>
					      <td>{{$cliente->apellido}}</td>
					      <td>{{$cliente->telefono}}</td>
					      <td>{{$cliente->direccion}}</td>
					      <td>
					      	<form method="POST" action="/cliente/delete">
					      		<input type="hidden" name="id" value="{{$cliente->id}}">
					      		<input type="submit" class="btn btn-outline-danger btn-sm" value="Eliminar">
					      		<a href="/cliente/edit/{{$cliente->id}}" class="btn btn-outline-info btn-sm" role="button" aria-disabled="true">Editar</a>	
					      	</form>
					      	
					      </td>
					    </tr>
				    @endforeach
				  </tbody>
				</table>
				
				
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-secondary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Agregar</button>

				<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				      	<h4 class="modal-title">Agregar Cliente</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        
				      </div>
				      <div class="modal-body">
				        <form method="POST" action="/cliente">
						  <div class="form-group">
						    <label for="dni">DNI</label>
						    <input type="text" class="form-control" id="dni" name="dni" required>
						  </div>
						  <div class="form-group">
						    <label for="nombre">Nombre:</label>
						    <input type="text" class="form-control" id="nombre" name="nombre" required>
						  </div>
						  <div class="form-group">
						    <label for="apellido">Apellido:</label>
						    <input type="text" class="form-control" id="apellido" name="apellido" required>
						  </div>
						  <div class="form-group">
						    <label for="telefono">Telefono:</label>
						    <input type="number" class="form-control" id="telefono" name="telefono" required>
						  </div>
						  <div class="form-group">
						    <label for="direccion">Direccion:</label>
						    <input type="text" class="form-control" id="direccion" name="direccion" required>
						  </div>
						  <button type="submit" class="btn btn-outline-success">Guardar</button>
						</form>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>


			</div>
		</div>
</div>


	
		
@include('shared.footer')