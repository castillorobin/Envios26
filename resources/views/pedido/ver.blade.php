@extends('layouts.app')

@section('content')


<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<style>
    .datos{
        color:#787878
    }

/* Style the Image Used to Trigger the Modal */
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



<div class="row mx-5 mb-5" style="font-size:10px; background: #ececec; border: 1px solid; ">
   <div class="col-12 text-center" style="background:#ececec">

    <h5>Status del paquete</h5>
      <p></p>
    </div>
    
  <br>
  <div class="col-12">


<div class="row mx-2" style=" background: #ececec;"> <!--  Inicia el row general  -->
<br>
<div class="col-12"> <!--  Inicia la primera columna  -->

<div class="row" >
    <div class="col-12" >
    <form action="/pedido/editrepa" method="get">
        <table>
          <tr>
            <td>Id:</td>
            <td><strong> {{$pedido->id}}</strong></td>
            <input hidden type="text" name="idpe" value="{{$pedido->id}}">
          </tr>
          <tr>
            <td>Comercio: </td>
            <td><strong>{{$pedido->vendedor}}</strong></td>
          </tr>
          <tr>
            <td>Destinatario: </td>
            <td><strong>{{$pedido->destinatario}}</strong></td>
          </tr>

          
          <tr>
            <td>Direccion: </td>
            <td><strong>{{$pedido->direccion}}</strong></td>
          </tr>
          <tr>
            <td>Total:</td>
            <td><strong>${{$pedido->total}}</strong></td>
          </tr>
        </table>
        
        
        

        <p></p>
        <button type="submit" name="entre" class="btn btn-primary" style="border-radius: 8px; height:30px; width:100%">Entregado</button>           
        <br>

<p></p>
<button type="submit" name="repro" class="btn btn-primary" style="border-radius: 8px; height:30px; width:100%">Reprogramado</button>           
<br>
<p></p>
<button type="submit" class="btn btn-primary" style="border-radius: 8px; height:30px; width:100%">No entregado</button>           
<p></p>
  &nbsp; &nbsp;<strong>Nota:</strong> 
<br>
<br>
<input type="text" name="nota" class="form-control">
<p></p>
    </div>
    
</form>
</div>



</div> <!--  Fin de la primera columna  -->



 


<br><p></p>
</div>
</div> <!--  Termina el row general  -->

</div>

</form>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>




@endsection

