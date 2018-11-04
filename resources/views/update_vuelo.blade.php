@include('shared.header')

<div = class="mx-auto" style="width: 600px">
  <h1 class="display-4">Editar Vuelo</h1>
</div>
<br>
<div class="container" style="width: 600px">
  <form method="POST" action="/vuelo/update">
    <input type="hidden" name="id" value="{{$vuelo->id}}">
  <div class="form-group">
    <label for="fecha_salida">Salida Fecha y Hora</label>
    <input value="{{$vuelo->fecha_salida}}" type="text" class="form-control" id="fecha_salida" name="fecha_salida" required>
  </div>
  <div class="form-group">
    <label for="fecha_llegada">Entrada Fecha y Hora</label>
    <input value="{{$vuelo->fecha_llegada}}" type="text" class="form-control" id="fecha_llegada" name="fecha_llegada" required>
  </div>
  <div class="form-group">
   <label for="id_salida_aeropuerto">Aeropuerto de Salida:</label>
  <select name="id_salida_aeropuerto" name="id_salida_aeropuerto" required>
    <option value="">-- SELECCIONE --</option>
     @foreach ($aeropuertos as $a)
     <option value="{{$a->id}}"
       @if($a->id == $vuelo->id_salida_aeropuerto)
       selected
       @endif
       >{{$a->id}} - {{$a->nombre}}
     </option>
      @endforeach
  </select>
 </div>
 <div class="form-group">
   <label for="id_llegada_aeropuerto">Aeropuerto de Entrada:</label>
   <select id="id_llegada_aeropuerto" name="id_llegada_aeropuerto" required>
     <option value="">-- SELECCIONE --</option>
      @foreach($aeropuertos as $b)
      <option value="{{$b->id}}"
       @if($b->id == $vuelo->id_llegada_aeropuerto)
       selected
       @endif
       >{{$b->id}} - {{$b->nombre}}
      </option>
      @endforeach
   </select>
 </div>
  <button type="submit" class="btn btn-outline-success">Guardar</button>
  </form>
</div>
 

@include('shared.footer')