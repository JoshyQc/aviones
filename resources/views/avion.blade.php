@include('shared.header')

<div = class="container-fluid">
	<h1 class="display-3">Aviones</h1>
</div>
<br>
<div class ="container">
	<div class="row">
		<div class="col-md-12">
				<table class="table table-hover table-smS">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Id</th>
				      <th scope="col">Plaza</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach ($aviones as $avion)
					    <tr>
					      <th scope="row">{{$avion->id}}</th>
					      <td>{{$avion->plaza}}</td>
					      <td>
					      	<form method="POST" action="/avion/delete">
					      		<input type="hidden" name="id" value="{{$avion->id}}">
					      		<input type="submit" class="btn btn-outline-danger btn-sm" value="Eliminar">
					      		<a href="/avion/edit/{{$avion->id}}" class="btn btn-outline-info btn-sm" role="button" aria-disabled="true">Editar</a>	
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
				      	<h4 class="modal-title">Agregar Avion</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        
				      </div>
				      <div class="modal-body">
				        <form method="POST" action="/avion">
						  <div class="form-group">
						    <label for="plaza">Plaza</label>
						    <input type="text" class="form-control" id="plaza" name="plaza" required>
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