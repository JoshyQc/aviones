@include('shared.header')

<div = class="mx-auto" style="width: 600px">
	<h1 class="display-4"  style="text-align: center;">Editar Cliente</h1>
</div>
<br>
<div class="container" style="width: 600px">
	<form method="POST" action="/cliente/update">
		<input type="hidden" name="id" value="{{$cliente->id}}">
  <div class="form-group">
    <label for="dni">DNI</label>
    <input value="{{$cliente->dni}}" type="text" class="form-control" id="dni" name="dni" required>
  </div>
  <div class="form-group">
    <label for="nombre">Nombre:</label>
    <input value="{{$cliente->nombre}}" type="text" class="form-control" id="nombre" name="nombre" required>
  </div>
  <div class="form-group">
    <label for="apellido">Apellido:</label>
    <input value="{{$cliente->apellido}}" type="text" class="form-control" id="apellido" name="apellido" required>
  </div>
  <div class="form-group">
    <label for="telefono">Telefono:</label>
    <input value="{{$cliente->telefono}}" type="number" class="form-control" id="telefono" name="telefono" required>
  </div>
  <div class="form-group">
    <label for="direccion">Direccion:</label>
    <input value="{{$cliente->direccion}}" type="text" class="form-control" id="direccion" name="direccion" required>
  </div>
  <button type="submit" class="btn btn-outline-success">Guardar</button>
	</form>
</div>
 

@include('shared.footer')