@include('shared.header')

<div = class="mx-auto" style="width: 600px">
	<h1 class="display-4"  style="text-align: center;">Editar Avion</h1>
</div>
<br>
<div class="container" style="width: 600px">
	<form method="POST" action="/avion/update">
		<input type="hidden" name="id" value="{{$avion->id}}">
  <div class="form-group">
    <label for="plaza">Plaza</label>
    <input value="{{$avion->plaza}}" type="text" class="form-control" id="plaza" name="plaza" required>
  </div>
  <button type="submit" class="btn btn-outline-success">Guardar</button>
	</form>
</div>
 

@include('shared.footer')