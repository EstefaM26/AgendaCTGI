<x-app-layout>

    <body class="container mt-5">

        <h3>Datos del Contratista que se Desplaza</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif




        <div class="container-fluid"></div>
        <div class="row"></div>
        <div class="col-12 col-lg-10 mx-auto">
            <div class="card shadow-sm my-4">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                            @if(isset($agenda))
                                <a href="{{ route('agenda.pdf', $agenda->id) }}" class="btn btn-sm btn-info ms-3"
                                    target="_blank">Ver PDF</a>
                                <a href="{{ route('reportar-dia.show', $agenda->id) }}" class="btn btn-sm btn-success ms-2">
                                    Reportar actividades
                                </a>
                            @endif
                        </div>
                    @endif

                    <form method="POST" action="{{ route('formulario.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nombres y Apellidos -->
                        <div class="mb-3">
                            <label class="form-label">Nombres y Apellidos</label>
                            <input type="text" name="nombre_completo" class="form-control"
                                value="{{ old('nombre_completo') }}" placeholder="Ej: Juan Pérez" required>
                        </div>

                        <!-- Tipo de Documento y Número -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tipo de Documento</label>
                                <select name="tipo_documento" class="form-select" required>
                                    <option value="">Seleccione...</option>
                                    <option value="CC" {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}>Cédula de
                                        ciudadanía
                                    </option>
                                    <option value="TI" {{ old('tipo_documento') == 'TI' ? 'selected' : '' }}>Tarjeta de
                                        identidad
                                    </option>
                                    <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>Cédula de
                                        extranjería
                                    </option>
                                    <option value="PAS" {{ old('tipo_documento') == 'PAS' ? 'selected' : '' }}>Pasaporte
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Número de Documento</label>
                                <input type="text" name="numero_documento" class="form-control"
                                    value="{{ old('numero_documento') }}" placeholder="Ej: 123456789" required>
                            </div>
                        </div>

                        <!-- Fecha de Elaboración -->
                        <div class="mb-3">
                            <label class="form-label">Fecha de Elaboración</label>
                            <input type="date" name="fecha_elaboracion" class="form-control"
                                value="{{ old('fecha_elaboracion', date('Y-m-d')) }}" readonly>
                        </div>

                        <!-- Número de Contrato y Año -->
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Número de Contrato</label>
                                <input type="number" name="numero_contrato" class="form-control"
                                    value="{{ old('numero_contrato') }}" placeholder="Ej: 7445826" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Año</label>
                                <select name="anio_contrato" class="form-select" required>
                                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                        <option value="{{ $i }}" {{ old('anio_contrato') == $i ? 'selected' : '' }}>{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Fecha Vencimiento de Contrato -->
                        <div class="mb-3">
                            <label class="form-label">Fecha Vencimiento de Contrato</label>
                            <input type="date" name="fecha_vencimiento" class="form-control"
                                value="{{ old('fecha_vencimiento') }}" min="{{ date('Y-m-d') }}" required>
                        </div>


                        <div class="mb-3">
                            <label for="form-label">Cargo: </label>
                            <select name="cargo" id="cargo" class="form-select" required>
                                <option value="">Seleccione un cargo...</option>
                                <option value="Instructor">Instructor</option>
                                <option value="Servidor_Publico">Servidor Publico</option>
                            </select>

                        </div>

                        <!-- Objetivo Contractual -->
                        <div class="mb-3">
                            <label class="form-label">Objetivo Contractual</label>
                            <select name="objetivo_contractual_display" id="objetivo_contractual" class="form-select"
                                required>
                                <option value="">Seleccione un objetivo...</option>
                            </select>
                            <!-- Hidden input to send the long text to the server -->
                            <input type="hidden" name="objetivo_contractual" id="objetivo_contractual_hidden">
                        </div>

                        <!-- Dirección General y Dependencia/Centro -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Dirección General / Regional</label>
                                <input type="text" class="form-control" value="ANTIOQUIA" readonly>
                                <input type="hidden" name="direccion_general" value="ANTIOQUIA">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Dependencia / Centro</label>
                                <input type="text" class="form-control"
                                    value="Centro Textil y de Gestión Industrial (CTGI)" readonly>

                            </div>
                        </div>
                        <!--firma-->
                        <div class="mb-3">
                            <label for="">Firma</label><br>
                            <input type="file" name="firma_contratista" accept="image/*">
                        </div>



                        <!--informacion desplazamiento-->
                        <h3>Información del desplazamiento</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Origen</label>
                                <input type="text" class="form-control" value="MEDELLIN" readonly>
                                <input type="hidden" name="origen" value="MEDELLIN">
                            </div>
                            <div class="col-md-4">
                                <label>Destino</label>
                                <select name="municipio_destino" class="form-select" required>
                                    <option value="">Seleciione un Destino...</option>
                                    @foreach ($municipios as $municipio)
                                        <option value="{{ $municipio }}">
                                            {{ $municipio }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Retorno</label>
                                <input type="text" class="form-control" value="MEDELLÍN" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Dirección General / Regional</label>
                                <input type="text" class="form-control" value="ANTIOQUIA" readonly>
                                <input type="hidden" name="direccion_general" value="ANTIOQUIA">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Dependencia / Centro</label>
                                <input type="text" class="form-control"
                                    value="Centro Textil y de Gestión Industrial (CTGI)" readonly>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Entidad o Empresa</label>
                                <input type="text" name="entidad_empresa" class="form-control" maxlength="120"
                                    placeholder="Ej: Secretaria de Educación" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Contacto</label>
                                <input type="text" name="contacto" class="form-control" maxlength="120"
                                    placeholder="Nombre del contacto" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Fecha Inicio Del desplazamiento</label>
                                <input type="date" name="fecha_inicio_desplazamiento" class="form-control"
                                    min="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Fecha Fin Del desplazamiento</label>
                                <input type="date" name="fecha_fin_desplazamiento" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Objetivo Del desplazamiento</label>
                                <textarea name="objetivo_desplazamiento" class="form-control" maxlength="160" rows="3"
                                    placeholder="Máximo 160 caracteres" required></textarea>
                                <small class="text-muted">Máximo 160 caracteres</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Obligaciones del contrato</label>
                                <div id="obligaciones-container">
                                    <div class="input-group mb-2">
                                        <textarea name="obligaciones_contrato[]" class="form-control" rows="2"
                                            required></textarea>
                                        <button type="button" class="btn btn-primary add-obligacion">+</button>
                                        <button type="button" class="btn btn-primary remove-obligacion">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="mb-4">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ isset($agenda) ? 'Actualizar Agenda' : 'Crear Agenda' }}
                    </button>
                </div>
                </form>
            </div>
        </div>
        </div>
        </div>
        </div>











        <script>
            const cargoSelect = document.getElementById('cargo');
            const objetivoSelect = document.getElementById('objetivo_contractual');
            const objetivoHidden = document.getElementById('objetivo_contractual_hidden');

            const opcionesInstructor = [
                { short: 'OBJETO REGULAR', long: 'CONTRATAR LOS SERVICIOS PERSONALES DE CARÁCTER TEMPORAL COMO INSTRUCTOR PARA IMPARTIR FORMACIÓN TITULADA Y COMPLEMENTARIA EN MODALIDAD PRESENCIAL Y VIRTUAL PARA LOS PROGRAMAS DE OFERTA REGULAR DEL CTGI' },
                { short: 'OBJETO DESPLAZADOS', long: 'CONTRATAR LOS SERVICIOS PERSONALES DE CARÁCTER TEMPORAL COMO INSTRUCTOR PARA IMPARTIR FORMACIÓN TITULADA Y COMPLEMENTARIA EN MODALIDAD PRESENCIAL Y VIRTUAL PARA LOS PROGRAMAS DE OFERTA DESPLAZADOS DEL CTGI.        ' },
                { short: 'OBJETO DE MEDIA TECNICA', long: 'CONTRATAR LOS SERVICIOS PERSONALES DE CARÁCTER TEMPORAL COMO INSTRUCTOR PARA IMPARTIR FORMACIÓN TITULADA EN MODALIDAD PRESENCIAL PARA LOS PROGRAMAS DE ARTICULACIÓN CON LA EDUCACIÓN MEDIA DEL CTGI.  ' },
                { short: 'OBJETO ECONOMIA POPULAR', long: 'Prestar servicios profesionales y/o de apoyo a la gestión, en la planeación y ejecución de la formación, así como la evaluación de los resultados de aprendizaje definidos en los diseños curriculares asignados, para el desarrollo de habilidades y competencias técnicas de la población de trabajadores de la ECONOMIA POPULAR, aportando al fortalecimiento de la economía popular en  concordancia con los lineamientos establecidos por la Dirección del Sistema Nacional de Formación para el Trabajo y la Coordinación Nacional de Atención Integral, Diferencial e Incluyente a la Economía popular – CampeSEN       ' },
                { short: 'OBJETO TIC', long: 'CONTRATAR LOS SERVICIOS PERSONALES DE CARÁCTER TEMPORAL COMO INSTRUCTOR PARA IMPARTIR FORMACIÓN TITULADA Y COMPLEMENTARIA EN MODALIDAD PRESENCIAL Y VIRTUAL PARA LOS PROGRAMAS DE OFERTA FIC DEL CTGI       ' },
                { short: 'CAMPESENA', long: 'Prestar servicios profesionales y/o de apoyo a la gestión, en la planeación y ejecución de la formación, así como la evaluación de los resultados de aprendizaje definidos en los diseños curriculares asignados, para el desarrollo de habilidades y competencias técnicas de la población campesina, aportando al fortalecimiento de la economía popular, familiar, étnica y comunitaria, en concordancia con lineamientos establecidos por la Dirección del Sistema Nacional de Formación para el Trabajo y la Coordinación Nacional de Atención Integral, Diferencial e Incluyente a la Economía popular – CampeSENA' }
            ];

            const opcionesServidor = [
                { short: 'Coordinación académica', long: 'PRESTAR SERVICIOS PROFESIONALES PARA EL DESARROLLO DE ACTIVIDADES DE COORDINACIÓN ACADÉMICA EN LOS PROGRAMAS DE FORMACIÓN DEL CENTRO' },
                { short: 'Apoyo a la gestión administrativa', long: 'PRESTAR SERVICIOS PERSONALES DE APOYO A LA GESTIÓN EN LOS PROCESOS ADMINISTRATIVOS DEL CENTRO DE FORMACIÓN' },
                { short: 'Apoyo Bienestar al Aprendiz', long: 'CONTRATAR LOS SERVICIOS PERSONALES PARA EL APOYO EN EL DESARROLLO DE ACTIVIDADES DE BIENESTAR AL APRENDIZ' }
            ];

            function actualizarObjetivos() {
                const cargo = cargoSelect.value;
                objetivoSelect.innerHTML = '<option value="">Seleccione un objetivo...</option>';

                let opciones = [];
                if (cargo === 'Instructor') {
                    opciones = opcionesInstructor;
                } else if (cargo === 'Servidor_Publico') {
                    opciones = opcionesServidor;
                }

                opciones.forEach(opt => {
                    const option = document.createElement('option');
                    option.value = opt.short;
                    option.textContent = opt.short;
                    objetivoSelect.appendChild(option);
                });

                // Limpiar el hidden cuando cambia el cargo
                objetivoHidden.value = '';
            }

            cargoSelect.addEventListener('change', actualizarObjetivos);

            objetivoSelect.addEventListener('change', function () {
                const cargo = cargoSelect.value;
                const selectedShort = this.value;
                let opciones = cargo === 'Instructor' ? opcionesInstructor : opcionesServidor;

                const match = opciones.find(opt => opt.short === selectedShort);
                if (match) {
                    objetivoHidden.value = match.long;
                } else {
                    objetivoHidden.value = '';
                }
            });

            // Inicializar si hay un valor previo (por ejemplo en validación error)
            if (cargoSelect.value) {
                actualizarObjetivos();
            }


            const inicio = document.querySelector('[name="fecha_inicio_desplazamiento"]');
            const fin = document.querySelector('[name="fecha_fin_desplazamiento"]');

            inicio.addEventListener('change', () => {
                fin.min = inicio.value;
            });




            document.addEventListener('click', function (e) {

                if (e.target.classList.contains('add-obligacion')) {
                    const container = document.getElementById('obligaciones-container');

                    const div = document.createElement('div');
                    div.classList.add('input-group', 'mb-2');

                    div.innerHTML = `
                    <textarea name="obligaciones_contrato[]" class="form-control" rows="2" required></textarea>
                    <button type="button" class="btn btn-primary add-obligacion">+</button>
                    <button type="button" class="btn btn-danger remove-obligacion">-</button>
                `;

                    container.appendChild(div);
                }

                if (e.target.classList.contains('remove-obligacion')) {
                    const container = document.getElementById('obligaciones-container');
                    if (container.children.length > 1) {
                        e.target.parentElement.remove();
                    }
                }
            });




        </script>
    </body>

    </html>
</x-app-layout>|