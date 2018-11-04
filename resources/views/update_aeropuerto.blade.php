@include('shared.header')

<div = class="mx-auto" style="width: 600px">
  <h1 class="display-4"  style="text-align: center;">Editar Aeropuerto</h1>
</div>
<br>
<div class="container" style="width: 600px">
  <form method="POST" action="/aeropuerto/update">
    <input type="hidden" name="id" value="{{$aeropuerto->id}}">
  <div class="form-group">
    <label for="nombre">Nombre:</label>
    <input value="{{$aeropuerto->nombre}}" type="text" class="form-control" id="nombre" name="nombre" required>
  </div>
  <div class="form-group">
    <label for="localidad">Localidad:</label>
    <input value="{{$aeropuerto->localidad}}" type="text" class="form-control" id="localidad" name="localidad" required>
  </div>
  <div class="form-group">
    <label for="pais">Pais:</label>
    <input value="{{$aeropuerto->pais}}" type="text" class="form-control" id="pais" name="pais" required>
  </div>
  <button type="submit" class="btn btn-outline-success">Guardar</button>
  </form>
</div>
 

@include('shared.footer')