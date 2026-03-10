@extends('layouts.app')

@section('content')



<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="card-title mb-0">Entregas fallidas</h5>
                </div>
                <div class="card-header">
                    <h5 class="card-title mb-0">Guia: {{ $orden->guia }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('ordenes.registrar_fallida', $orden->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Motivo de la entrega fallida:</label>
                            <select name="motivo" id="motivo" class="form-select" required>
                                <option value="" disabled selected>Seleccione un motivo</option>
                                <option value="Reprogramado">Reprogramado</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="contenedor-fecha">
                            <label class="form-label">Nueva fecha de entrega:</label>
                            <input type="date" name="fecha_reprogramacion" class="form-control" min="{{ date('Y-m-d') }}">
                        </div>

                        <div class="mb-3 d-none" id="contenedor-nota">
                            <label class="form-label">Especifique el motivo:</label>
                            <textarea name="nota_motivo" class="form-control" rows="2" placeholder="Escriba aquí la nota..."></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Registrar Fallida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectMotivo = document.getElementById('motivo');
    const contenedorFecha = document.getElementById('contenedor-fecha');
    const contenedorNota = document.getElementById('contenedor-nota');

    selectMotivo.addEventListener('change', function() {
        const valor = this.value;

        // Resetear visibilidad (ocultar ambos primero)
        contenedorFecha.classList.add('d-none');
        contenedorNota.classList.add('d-none');

        // Lógica condicional
        if (valor === 'Reprogramado') {
            contenedorFecha.classList.remove('d-none');
        } else if (valor === 'Otro') {
            contenedorNota.classList.remove('d-none');
        }
    });
});
</script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Alerta de Éxito
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Logrado!',
                text: "{{ session('success') }}",
                confirmButtonText: 'Aceptar',
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
        @endif

           
            // Alerta de Error
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonText: 'Cerrar',
                customClass: {
                    confirmButton: 'btn btn-danger'
                }
            });
        @endif




        });
    </script>

@endsection