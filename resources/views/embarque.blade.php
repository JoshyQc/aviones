@include('shared.header')

<div = class="container-fluid">
	<h1 class="display-3">Embarques</h1>
</div>
<br>
<div class ="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover  table-bordered table-smS">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Id</th>
				      <th scope="col">Asiento</th>
				      <th scope="col">Vuelo</th>
				      <th scope="col">Reserva</th>
				      <th scope="col">Cliente</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach ($embarques as $embarque)
					    <tr>
					      <th scope="row">{{$embarque->id}}</th>
					      <td>{{$embarque->asiento}}</td>
					      <td>{{$embarque->id_vuelo}}</td>
					      <td>{{$embarque->id_reserva}}</td>
					      <td>
					      	@foreach ($clientes as $cliente)
					      	@if($cliente->id == $embarque->id_cliente)
					      	{{$cliente->nombre}}
					      	@endif
					      	@endforeach
					      </td>
					      <!---->
					    </tr>
				    @endforeach
				  </tbody>
			</table>
		</div>
	</div>
</div>


	
		
@include('shared.footer')
