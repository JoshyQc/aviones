@include('shared.header')

<div>
	<h1 class="display-1">Vuelos Memorables</h1>
</div>
<br>
<br>

<!-- Empieza Carousel -->
<div class="container">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="\images\A1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="\images\japon.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="\images\hawaii.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
<!-- Termina Carousel -->	
<br>
<br>
<br>
<br>

<div class="container-fluid">
	 <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
          	<center>
          		<img class="rounded-circle" src="\images\1.jpg" alt="nose" width="140" height="140">
          	</center>
            <h2>TIP DE VIAJE 1</h2>
            <p>Visita tu médico. Consulta tu médico sobre la necesidad de tomar alguna medida preventiva, acorde a tu estado de salud, para realizar el viaje.</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
          	<center>
          		<img class="rounded-circle" src="\images\2.jpg" alt="nose" width="140" height="140">
          	</center>
            <h2>TIP DE VIAJE 2</h2>
            <p>Uso de medias antiembólicas especiales. Recuerda realizar el cambio diario de las medias, usa el tamaño exacto para controlar la presión y revisa el estado de tu piel.</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
          	<center>
          		<img class="rounded-circle" src="\images\3.jpg" alt="nose" width="140" height="140">
          	</center>
            <h2>TIP DE VIAJE 3</h2>
            <p>Consumo de agua
            Es importante consumir una buena cantidad de agua para mantenerte hidratado</p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
</div>
      
<br>
<br>
<br>


        <!-- START THE FEATURETTES -->

        <div class="container marketing">
        	<hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
          	<br>
          	<br>
          	<br>
          	<br>
            <h2 class="featurette-heading">¿Cómo acceder a nuestras <span class="text-muted">Salas VIP?</span></h2>
            <p class="lead">Presenta tu tarjeta de viajero frecuente LifeMiles Diamond, Gold o Silver. Si viajas en Clase Ejecutiva de Avianca, presenta tu boleto de embarque en la entrada de la Sala.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="\images\london.jpg" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">

          <div class="col-md-7 order-md-2">
          	<br>
          	<br>
          	<br>
          	<br>
            <h2 class="featurette-heading">Estado<span class="text-muted"> de vuelos</span></h2>
            <p class="lead">Conoce los horarios de llegada y salida de nuestros vuelos. Además, revisa los cambios de itinerarios.Realiza la consulta usando los detalles de tu vuelo o el número del mismo.
            En caso de que tengas un vuelo cancelado, puedes revisar si te hemos reacomodado y aceptar el cambio de itinerario. Actualizamos la información de nuestros vuelos constantemente. Verifica tu reserva 48 horas antes del viaje.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" src="\images\airplane.jpg" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
          	<br>
          	<br>
          	<br>
          	<br>
            <h2 class="featurette-heading">Medios<span class="text-muted"> de pago​​​​</span></h2>
            <p class="lead">Aceptamos tarjetas de crédito emitidas en los siguientes países: Argentina, Bolivia, Brasil, Chile, Costa Rica, Colombia, Ecuador, El Salvador, Estados Unidos, Guatemala, Honduras, México, Nicaragua, Panamá, Paraguay, Perú, República Dominicana, Uruguay y Venezuela​.​
            En Centroamérica todas las compras realizadas con tarjeta de crédito permiten pago a una cuota (un pago).​​</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="\images\ny.jpg" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">
        	
        </div>

        <!-- /END THE FEATURETTES -->

@include('shared.footer')