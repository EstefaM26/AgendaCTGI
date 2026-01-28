@extends('layouts.dashboard')

@section('content')
<style>
    .bg-light-gray { background-color: #f8f9fa; min-height: 100vh; padding: 40px 0; }
    .form-card { background: white; border: 1px solid #e0e0e0;  box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden; }
    .card-body-custom { padding: 40px; }
    .form-title { font-size: 24px; font-weight: 600; color: #333; margin-bottom: 30px; }
    label { font-size: 14px; color: #666; margin-bottom: 6px; display: block; font-weight: 500; }
    .form-control, .form-select { border: 1px solid #dee2e6; border-radius: 6px; padding: 10px 12px; margin-bottom: 20px; }
    .btn-submit { background-color: #0d6efd; color: white; border: none; width: 100%; padding: 15px; font-weight: 600; border-radius: 0 0 8px 8px; transition: 0.3s; }
    .btn-submit:hover { background-color: #0b5ed7; }
    
    /* Estilos Alerta Personalizada (Igual a la imagen) */
    .custom-alert {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        border-radius: 8px;
        color: #155724;
        padding: 15px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
    }
    .btn-pdf { background-color: #5bc0de; border: none; color: black; font-weight: bold; }
    .btn-report { background-color: #449d44; border: none; color: white; font-weight: bold; }
</style>

<div class="bg-light-gray">
    <div class="container" style="max-width: 850px;">
        
       @if (session('success'))
        <div class="alert alert-success d-flex align-items-center justify-content-between p-3 mb-4 shadow-sm" style="background-color: #d4edda; border-color: #c3e6cb; border-radius: 8px;">
            <span class="text-dark fw-medium">{{ session('success') }}</span>

            <div class="d-flex gap-2">
                {{-- Solo intentamos generar la ruta si el agenda_id existe en la sesión --}}
                @if (session('agenda_id'))
                    <a href="{{ route('agenda.pdf', ['id' => session('agenda_id')]) }}" 
                    class="btn btn-info text-dark fw-bold px-4" 
                    target="_blank" 
                    style="background-color: #5bc0de; border: none; text-decoration: none; padding: 8px 15px; border-radius: 5px;">
                        Ver PDF
                    </a>

                    <a href="{{ route('reportes.show', session('agenda_id')) }}"
                    class="btn btn-success fw-bold px-4"
                    style="background-color: #28a745; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px;">
                        Reportar actividades
                    </a>
                @endif
            </div>
        </div>
    @endif


        @if ($errors->any())
            <div class="alert alert-danger shadow-sm mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-success text-white p-2  mt-2">
            <h4 class="text-center mb-0">Datos del Contratista que se Desplaza</h4>
        </div>
        
        <div class="form-card">
            <div class="card-body-custom">
                {{-- Nota: Asegúrate que la ruta 'formulario.store' exista en web.php --}}
                <form action="{{ route('formulario.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label>Nombres y Apellidos</label>
                    <input type="text" name="nombre_completo" class="form-control" placeholder="Ej: Juan Pérez" value="{{ old('nombre_completo') }}" required>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Tipo de Documento</label>
                            <select name="tipo_documento" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <option value="CC" {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                                <option value="TI" {{ old('tipo_documento') == 'TI' ? 'selected' : '' }}>Tarjeta de identidad</option>
                                <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>Cédula de extranjería</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Número de Documento</label>
                            <input type="text" name="numero_documento" class="form-control" placeholder="Ej: 123456789" value="{{ old('numero_documento') }}" required>
                        </div>
                    </div>

                    <label>Fecha de Elaboración</label>
                    <input type="date" name="fecha_elaboracion" class="form-control bg-white" value="{{ date('Y-m-d') }}" readonly>

                    <div class="row">
                        <div class="col-md-8">
                            <label>Número de Contrato</label>
                            <input type="number" name="numero_contrato" class="form-control" value="{{ old('numero_contrato') }}" placeholder="Ej: 7445826" required>
                        </div>
                        <div class="col-md-4">
                            <label>Año</label>
                            <select name="anio_contrato" class="form-select" required>
                                @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                    <option value="{{ $i }}" {{ old('anio_contrato') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <label>Fecha Vencimiento de Contrato</label>
                    <input type="date" name="fecha_vencimiento" class="form-control" value="{{ old('fecha_vencimiento') }}" min="{{ date('Y-m-d') }}" required>

                    <label>Cargo: </label>
                    <select name="cargo" id="cargo" class="form-select" required>
                        <option value="">Seleccione un cargo...</option>
                        <option value="Instructor" {{ old('cargo') == 'Instructor' ? 'selected' : '' }}>Instructor</option>
                        <option value="Servidor_Publico" {{ old('cargo') == 'Servidor_Publico' ? 'selected' : '' }}>Servidor Público</option>
                    </select>

                    <label>Objetivo Contractual</label>
                    <select name="objetivo_contractual_display" id="objetivo_contractual" class="form-select" required>
                        <option value="">Seleccione un objetivo...</option>
                    </select>
                    <input type="hidden" name="objetivo_contractual" id="objetivo_contractual_hidden" value="{{ old('objetivo_contractual') }}">

                    <div class="row">
                        <div class="col-md-6">
                            <label>Dirección General / Regional</label>
                            <input type="text" class="form-control bg-light" value="ANTIOQUIA" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Dependencia / Centro</label>
                            <input type="text" class="form-control bg-light" value="Centro Textil y de Gestión Industrial (CTGI)" readonly>
                        </div>
                    </div>

                    <div class="bg-success text-white p-2 rounded mb-4 mt-2">
                        <h4 class="text-center mb-0">Información del desplazamiento</h4>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-4">
                            <label>Origen</label>
                            <input type="text" class="form-control bg-light" value="MEDELLIN" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Destino</label>
                            <select name="municipio_destino" class="form-select" required>
                                <option value="">Seleccione un Destino...</option>
                                @php $muni_list = $municipios ?? ['BARBOSA', 'GIRARDOTA', 'COPACABANA', 'BELLO', 'MEDELLIN']; @endphp
                                @foreach ($muni_list as $m)
                                    <option value="{{ $m }}">{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Retorno</label>
                            <input type="text" class="form-control bg-light" value="MEDELLÍN" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Entidad o Empresa</label>
                            <input type="text" name="entidad_empresa" class="form-control" placeholder="Ej: Secretaria de Educación" required>
                        </div>
                        <div class="col-md-6">
                            <label>Contacto</label>
                            <input type="text" name="contacto" class="form-control" placeholder="Nombre del contacto" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Fecha Inicio Del desplazamiento</label>
                            <input type="date" name="fecha_inicio_desplazamiento" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Fecha Fin Del desplazamiento</label>
                            <input type="date" name="fecha_fin_desplazamiento" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Objetivo Del desplazamiento</label>
                            <textarea name="objetivo_desplazamiento" class="form-control" maxlength="160" rows="3" placeholder="Máximo 160 caracteres" required></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold">Obligaciones del contrato</label>
                            <div id="obligaciones-container">
                                <div class="d-flex align-items-stretch mb-2 item-obligacion">
                                    <textarea name="obligaciones_contrato[]" class="form-control" rows="2" required style="border-radius: 6px 0 0 6px; border-right: none; resize: none;"></textarea>
                                    <div class="d-flex flex-column" style="width: 40px;">
                                        <button type="button" class="btn btn-primary add-obligacion d-flex align-items-center justify-content-center p-0" style="flex: 1; border-radius: 0 6px 0 0; font-size: 20px;">+</button>
                                        <button type="button" class="btn btn-danger remove-obligacion d-flex align-items-center justify-content-center p-0" style="flex: 1; border-radius: 0 0 6px 0; font-size: 20px;">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold">Firma</label>
                        <input type="file" name="firma_contratista" class="form-control" accept="image/*">
                    </div>

                    <button type="submit" class="btn-submit">
                        {{ isset($agenda) ? 'Actualizar Agenda' : 'Crear Agenda' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Lógica de Cargos y Objetivos
    const cargoSelect = document.getElementById('cargo');
    const objetivoSelect = document.getElementById('objetivo_contractual');
    const objetivoHidden = document.getElementById('objetivo_contractual_hidden');

    const opcionesInstructor = [
        { short: 'OBJETO REGULAR', long: 'CONTRATAR LOS SERVICIOS PERSONALES DE CARÁCTER TEMPORAL COMO INSTRUCTOR...' },
        { short: 'OBJETO DESPLAZADOS', long: 'CONTRATAR LOS SERVICIOS PERSONALES DE CARÁCTER TEMPORAL COMO INSTRUCTOR...' },
        { short: 'OBJETO DE MEDIA TECNICA', long: 'CONTRATAR LOS SERVICIOS PERSONALES DE CARÁCTER TEMPORAL COMO INSTRUCTOR...' }
    ];

    const opcionesServidor = [
        { short: 'Coordinación académica', long: 'PRESTAR SERVICIOS PROFESIONALES PARA EL DESARROLLO DE ACTIVIDADES...' }
    ];

    function actualizarObjetivos() {
        const cargo = cargoSelect.value;
        objetivoSelect.innerHTML = '<option value="">Seleccione un objetivo...</option>';
        let opciones = cargo === 'Instructor' ? opcionesInstructor : (cargo === 'Servidor_Publico' ? opcionesServidor : []);
        
        opciones.forEach(opt => {
            const option = document.createElement('option');
            option.value = opt.short;
            option.textContent = opt.short;
            objetivoSelect.appendChild(option);
        });
        objetivoHidden.value = '';
    }

    cargoSelect.addEventListener('change', actualizarObjetivos);
    objetivoSelect.addEventListener('change', function () {
        const cargo = cargoSelect.value;
        let opciones = cargo === 'Instructor' ? opcionesInstructor : opcionesServidor;
        const match = opciones.find(opt => opt.short === this.value);
        objetivoHidden.value = match ? match.long : '';
    });

    // Lógica dinámica de botones +/-
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('add-obligacion')) {
            const container = document.getElementById('obligaciones-container');
            const div = document.createElement('div');
            div.classList.add('d-flex', 'align-items-stretch', 'mb-2', 'item-obligacion');
            div.innerHTML = `
                <textarea name="obligaciones_contrato[]" class="form-control" rows="2" required style="border-radius: 6px 0 0 6px; border-right: none; resize: none;"></textarea>
                <div class="d-flex flex-column" style="width: 40px;">
                    <button type="button" class="btn btn-primary add-obligacion d-flex align-items-center justify-content-center p-0" style="flex: 1; border-radius: 0 6px 0 0; font-size: 20px;">+</button>
                    <button type="button" class="btn btn-danger remove-obligacion d-flex align-items-center justify-content-center p-0" style="flex: 1; border-radius: 0 0 6px 0; font-size: 20px;">-</button>
                </div>
            `;
            container.appendChild(div);
        }

        if (e.target.classList.contains('remove-obligacion')) {
            const container = document.getElementById('obligaciones-container');
            if (container.children.length > 1) {
                e.target.closest('.item-obligacion').remove();
            }
        }
    });

    // Validación de fechas
    const inicio = document.querySelector('[name="fecha_inicio_desplazamiento"]');
    const fin = document.querySelector('[name="fecha_fin_desplazamiento"]');
    inicio.addEventListener('change', () => { fin.min = inicio.value; });
</script>
@endsection