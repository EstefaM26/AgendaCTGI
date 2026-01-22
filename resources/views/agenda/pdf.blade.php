<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Formato Agenda Desplazamiento</title>
  <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>

  <div class="hoja">

    <!-- ================= ENCABEZADO ================= -->
    <table class="encabezado">
      <!-- Fila 1 -->
      <tr>
        <td class="logo" rowspan="2" colspan="4">
          <img src="{{ asset('images/sena/logoSena.png') }}" alt="SENA">
        </td>
        <td class="info" colspan="20">Versión: 04</td>
      </tr>

      <!-- Fila 2 -->
      <tr>
        <td class="info" colspan="20">
          Código:<br>
          GTH-F-090
        </td>
      </tr>

      <!-- Barras -->
      <tr class="barra">
        <td colspan="24">GESTIÓN DE TALENTO HUMANO</td>
      </tr>

      <tr class="barra">
        <td colspan="24">FORMATO AGENDA DESPLAZAMIENTO CONTRATISTA</td>
      </tr>
    </table>

    <!-- ================= DATOS CONTRATO ================= -->
    <table class="datos-contrato">
      <!-- Fila Título -->
      <tr class="enca">
        <td colspan="24">DATOS DEL CONTRATISTA QUE SE DESPLAZA</td>
      </tr>

      <!-- Fila Fecha Elaboración -->
      <tr class="fecha-venc">
        <td colspan="12">FECHA DE ELABORACIÓN DE AGENDA</td>
        <td colspan="12">{{ $agenda->fecha_elaboracion ?? '' }}</td>
      </tr>

      <!-- Fila Nombres -->
      <tr class="resaltado">
        <td colspan="12">NOMBRES Y APELLIDOS</td>
        <td colspan="12">IDENTIFICACIÓN</td>
      </tr>
      <!-- Fila 1 -->
      <tr>
        <td colspan="12" class="resaltado nombre">
          {{ $agenda->nombre_completo ?? '' }}
        </td>
        <td colspan="2" class="resaltado">Tipo</td>
        <td colspan="2" class="resaltado">{{ $agenda->tipo_documento ?? '' }}</td>
        <td colspan="2" class="resaltado">No.</td>
        <td colspan="6" class="resaltado">{{ $agenda->numero_documento ?? '' }}</td>
      </tr>

      <!-- Fila 2 -->
      <tr class="fila-contrato">
        <td colspan="3" class="resaltado contrato">CONTRATO</td>
        <td colspan="2" class="resaltado">No.</td>
        <td colspan="4" class="resaltado">{{ $agenda->numero_contrato ?? '' }}</td>
        <td colspan="2" class="resaltado">AÑO</td>
        <td colspan="2" class="resaltado">{{ $agenda->anio_contrato ?? '' }}</td>

        <td colspan="4" class="fecha-venc" style="font-size: 8px; line-height: 1;">
          FECHA<br>
          VENCIMIENTO<br>
          DEL CONTRATO
        </td>
        <td colspan="2" class="resaltado">{{ date('d', strtotime($agenda->fecha_vencimiento)) }}</td>
        <td colspan="2" class="resaltado">{{ date('m', strtotime($agenda->fecha_vencimiento)) }}</td>
        <td colspan="3" class="resaltado">{{ date('Y', strtotime($agenda->fecha_vencimiento)) }}</td>
      </tr>


      <tr>
        <td colspan="4" class="fecha-venc">OBJETO CONTRACTUAL:</td>
        <td colspan="20">{{ $agenda->objetivo_contractual ?? '' }}</td>
      </tr>

      <tr>
        <td colspan="4" class="fecha-venc">DIRECCIÓN GENERAL/<br>REGIONAL</td>
        <td colspan="8" class="fecha-venc">{{ $agenda->direccion_general ?? '' }}</td>
        <td colspan="4">DEPENDENCIA/<br>CENTRO</td>
        <td colspan="8">{{ $agenda->dependencia_centro ?? '' }}</td>
      </tr>

      <tr>
        <td colspan="4" class="fecha-venc">NOMBRE DEL ORDENADOR DEL GASTO (de la Movilización)</td>
        <td colspan="8" class="fecha-venc">DERLYS MARGOTH MADERA SOTO</td>
        <td colspan="4" class="fecha-venc">CARGO</td>
        <td colspan="8" class="fecha-venc">SUBDIRECTOR ENCARGADA</td>
      </tr>

      <tr>
        <td colspan="4" class="fecha-venc">NOMBRE DEL SUPERVISOR(A) DEL CONTRATO</td>
        <td colspan="8" class="fecha-venc">FREDDY CAMACHO GARCÍA</td>
        <td colspan="4" class="fecha-venc">CARGO</td>
        <td colspan="8" class="fecha-venc">COORDINADOR ACADEMICO</td>
      </tr>

      <tr class="enca">
        <td colspan="24">INFORMACIÓN DEL DESPLAZAMIENTO</td>
      </tr>

      <tr>
        <td colspan="4" class="fecha-venc">RUTA</td>
        <td colspan="20" class="fecha-venc">{{ $agenda->ruta }}</td>
      </tr>

      <tr>
        <td colspan="4">DIRECCIÓN GENERAL/<br>REGIONAL</td>
        <td colspan="8">{{ $agenda->direccion_general }}</td>
        <td colspan="4">DEPENDENCIA/<br>CENTRO</td>
        <td colspan="8">{{ $agenda->dependencia_centro }}</td>
      </tr>

      <tr>
        <td colspan="4">CIUDAD/DEPARTAMENTO O <br> MUNICIPIO/DEPARTAMENTO <br> O CIUDAD/PAIS</td>
        <td colspan="5">{{ $agenda->ciudad_destino }}</td>
        <td colspan="3">ENTIDAD O <br> EMPRESA: </td>
        <td colspan="4">{{ $agenda->entidad_empresa }}</td>
        <td colspan="2">CONTACTO</td>
        <td colspan="6">{{ $agenda->contacto }}</td>
      </tr>


      @php
        use Carbon\Carbon;
        $inicio = Carbon::parse($agenda->fecha_inicio_desplazamiento);
        $fin = Carbon::parse($agenda->fecha_fin_desplazamiento);
      @endphp


      <tr>
        <td colspan="4">FECHA INICIO DEL <br> DESPLAZAMIENTO</td>
        <td colspan="2" class="resaltado">{{ $inicio->day }}</td>
        <td colspan="1" class="resaltado">{{ $inicio->month }}</td>
        <td colspan="2" class="resaltado">{{ $inicio->year }}</td>

        <td colspan="3">FECHA FIN <br> DESPLAZAMIENTO</td>
        <td colspan="4" class="resaltado">{{ $fin->day }}</td>
        <td colspan="2" class="resaltado">{{ $fin->month }}</td>
        <td colspan="6" class="resaltado">{{ $fin->year }}</td>
      </tr>

      <tr>
        <td colspan="4" class="fecha-venc">OBJETIVO DEL DESPLAZAMIENTO</td>
        <td colspan="20">{{ $agenda->objetivo_desplazamiento }}</td>
      </tr>

      <tr>
        <td colspan="24" class="fecha-venc">OBLIGACIONES DEL CONTRATO</td>
      </tr>

      @if(!empty($agenda->obligaciones_contrato))
        @foreach ($agenda->obligaciones_contrato as $index => $obligacion)
          <tr>
            <td colspan="1">{{ $index + 1 }}</td>
            <td colspan="23">{{ $obligacion }}</td>
          </tr>
        @endforeach
      @endif

      <!-- <tr>
        <td colspan="1">1</td>
        <td colspan="23">Cumplir a cabalidad el objeto del contrato en los programas y niveles de formación en el Centro
          Textil y de Gestión Industrial con seriedad, responsabilidad, profesionalismo, eficiencia, oportunidad y
          calidad de conformidad con la necesidad del servicio.</td>
      </tr>

      <tr>
        <td colspan="1">2</td>
        <td colspan="23">Diseñar, programar y ejecutar las estrategias de enseñanza - aprendizaje – evaluación
          correspondiente al programa y nivel de formación profesional bajo el enfoque metodológico adoptado por el SENA
          y según orientaciones de la Coordinación Académica.</td>
      </tr>

      <tr>
        <td colspan="1">3</td>
        <td colspan="23">Cumplir a cabalidad el objeto del contrato en los programas y niveles de formación en el Centro
          Textil y de Gestión Industrial con seriedad, responsabilidad, profesionalismo, eficiencia, oportunidad y
          calidad de conformidad con la necesidad del servicio.</td>
      </tr> -->

      <tr>
        <td colspan="24" class="fecha-venc">AGENDA</td>
      </tr>

      <tr>
        <td colspan="24" class="fecha-venc">ACTIVIDADES ( (Deberá contener información detallada de las tareas a
          realizar día a día)</td>
      </tr>

      @foreach ($agenda->actividades as $index => $actividad)
        <tr class="tralalero">
          <td colspan="24">
            Día {{ $index + 1 }}: {{ $actividad->fecha_reporte->format('d/m/Y') }}<br>
            Desplazamientos ruta de ida: {{ $actividad->ruta_ida }}<br>
            Medio de transporte:
            {{ is_array($actividad->medios_transporte) ? implode(', ', $actividad->medios_transporte) : $actividad->medios_transporte }}<br>
            Actividades a ejecutar: {{ $actividad->actividades_ejecutar }}<br>
            Desplazamientos Internos: {{ $actividad->desplazamientos_internos ?? 'N/A' }}<br>
            desplazamientos Ruta de regreso: {{ $actividad->ruta_regreso }}<br><br>

            Observaciones: {{ $actividad->observaciones ?? 'Ninguna' }}
          </td>
        </tr>
      @endforeach

      <tr>
        <td colspan="24" class="enca">FIRMAS</td>
      </tr>

      <tr style="height: 80px;">
        <td colspan="8" class="fecha-venc">FIRMA ORDENADOR DE GASTO:
          @if(!empty($data['firma']))
            <img src="{{ asset('storage/' . $data['firma_ordenador']) }}" height="70">
          @endif


        </td>
        <td colspan="8" class="fecha-venc">FIRMA SUPERVISOR DEL CONTRATO :
          @if(!empty($data['firma']))
            <img src="{{ asset('storage/' . $data['firma_supervisor']) }}" height="70">
          @endif
        </td>
        <td colspan="8" rowspan="2" class="fecha-venc">FIRMA DEL CONTRATISTA:
          @if($agenda->firma_contratista)
            <img src="{{ asset('storage/' . $agenda->firma_contratista) }}" style="width:150px; height:auto;">
          @endif
        </td>
      </tr>

      <tr style="height: 60px;">
        <td colspan="8" class="fecha-venc">Nombres y Apellidos:</td>
        <td colspan="8" class="fecha-venc">Nombres y Apellidos:</td>
      </tr>

      <tr style="height: 60px;">
        <td colspan="8" class="fecha-venc">
          Cargo: SUBDIRECTOR ENCARGADO<br>
          DERLYS MARGOTH MADERA SOTO
        </td>
        <td colspan="8" class="fecha-venc" style="height: 80px; text-align:center;">
          Cargo: COORDINADOR ACADEMICO<br>
          FREDDY CAMACHO GARCÍA
          @if(!empty($data['firma']))
            <img src="{{ asset('storage/' . $data['firma']) }}" height="70">
          @endif
        </td>
        <td colspan="8" class="fecha-venc">
          <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span>Nombres y Apellidos:</span>
            <span style="font-weight: bold;">DIANA</span>
          </div>
          JANETH BOLIVAR
        </td>
      </tr>

      <tr>
        <td colspan="24" style="text-align: right; font-size: 10px;">GTH-F-090 V.04</td>
      </tr>


    </table>


  </div>

  <button id="btnPdf">Generar PDF</button>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>