@include('shared.header')
<div = class="container-fluid">
	<h1 class="display-3">Vuelos</h1>
</div>
<br>
<div class ="container">
	<div class="row">
		<div class="col-md-12">
				<table class="table table-hover table-smS">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">id</th>
				      <th scope="col">Fecha y Hora Salida</th>
				      <th scope="col">Fecha y Hora Entrada</th>
				      <th scope="col">Aeropuerto de Salida</th>
				      <th scope="col">Aeropuerto de Entrada</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach ($vuelos as $vuelo)
					    <tr>
					      <th scope="row">{{$vuelo['id']}}</th>
					      <td>{{$vuelo['fecha_salida']}}</td>
					      <td>{{$vuelo['fecha_llegada']}}</td>
					      <td>
					      	@foreach ($aeropuertos as $aeropuerto)
					      	@if($aeropuerto['id'] == $vuelo['id_salida_aeropuerto'])
					      	{{$aeropuerto['nombre']}}
					      	@endif
					      	@endforeach	      	
					      </td>
					      <td>
					      	@foreach ($aeropuertos as $aeropuerto)
					      	@if($aeropuerto['id'] == $vuelo['id_llegada_aeropuerto'])
					      	{{$aeropuerto['nombre']}}
					      	@endif
					      	@endforeach
					      </td>
					      <td>
					      	<form method="POST" action="/vuelo/delete">
					      		<input type="hidden" name="id" value="{{$vuelo['id']}}">
					      		<a href="/vuelo/edit/{{$vuelo['id']}}" class="btn btn-outline-info btn-sm" role="button" aria-disabled="true">Editar</a>	
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
				      	<h4 class="modal-title">Agregar Vuelo</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        
				      </div>
				      <div class="modal-body">
				        <form method="POST" action="/vuelo">
						  <div class="form-group">
						    <label for="fecha_salida">Fecha de Salida:</label>
						    <input type="datetime-local" class="form-control" id="fecha_salida" name="fecha_salida" required>
						  </div>
						  <div class="form-group">
						    <label for="fecha_llegada">Fecha de Entrada:</label>
						    <input type="datetime-local" class="form-control" id="fecha_llegada" name="fecha_llegada" required>
						  </div>
						  <div class="form-group">
						    <label for="id_salida_aeropuerto">Aeropuerto de Salida</label>
						    <select name="id_salida_aeropuerto" name="id_salida_aeropuerto" required>
						    	<option value="">-- SELECCIONE --</option>
						    	@foreach ($aeropuertos as $a)
						    	<option value="{{$a['id']}}">{{$a['id']}} - {{$a['nombre']}}</option>
						    	@endforeach
						    </select>
						    <!--<input type="date" class="form-control" id="id_salida_aeropuerto" name="id_salida_aeropuerto" required>-->
						  </div>
						  <div class="form-group">
						    <label for="id_llegada_aeropuerto">Aeropuerto de Entrada</label>
						    <select id="id_llegada_aeropuerto" name="id_llegada_aeropuerto" required>
						    	<option value="">-- SELECCIONE --</option>
						    	@foreach ($aeropuertos as $a)
						    	<option value="{{$a['id']}}">{{$a['id']}} - {{$a['nombre']}}</option>
						    	@endforeach
						    </select>
						    <!--<input type="date" class="form-control" id="id_llegada_aeropuerto" name="id_llegada_aeropuerto" required>-->
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