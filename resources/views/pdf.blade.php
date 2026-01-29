<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formato Agenda Desplazamiento</title>
  <style>
    body { background: #ccc; font-family: Arial, sans-serif; }
    .hoja { width: 210mm; min-height: 297mm; padding: 10mm; margin: auto; background: white; box-sizing: border-box; font-size: 11px; }
    table { width: 100%; border-collapse: collapse; table-layout: fixed; margin-bottom: -1px; }
    td, th { border: 1px solid #000; padding: 3px; word-wrap: break-word; font-size: 10px; }
    tr { page-break-inside: avoid; }
    .barra td { background-color: #5f5f5f; color: white; text-align: center; font-weight: bold; padding: 8px; }
    .enca td { text-align: center; font-weight: bold; background-color: #f2f2f2; }
    .resaltado { font-weight: bold; text-align: center; }
    .fecha-venc { font-weight: bold; vertical-align: top; height: 25px; }

    /* AJUSTE PARA QUE LA FIRMA NO SE SALGA */
    .firma-img { 
        max-width: 95%;     /* No permite que se salga a lo ancho */
        max-height: 75px;    /* No permite que se salga a lo alto */
        width: auto; 
        height: auto; 
        display: block; 
        margin: 2px auto;    /* Centra la imagen en la celda */
    }

    #btnPdf { position: fixed; bottom: 20px; right: 20px; padding: 10px 20px; background: #39a900; color: white; border: none; border-radius: 5px; cursor: pointer; }
    @media print { #btnPdf { display: none; } .hoja { margin: 0; box-shadow: none; } }
  </style>
</head>
<body>

  <div class="hoja" id="area-pdf">
    <table>
      <tr>
        <td colspan="4" rowspan="2" style="text-align: center;">
          <img src="{{ asset('img/logo-sena-verde.png') }}" alt="SENA" width="70">
        </td>
        <td colspan="20" style="text-align: center; font-weight: bold;">Versión: 04</td>
      </tr>
      <tr>
        <td colspan="20" style="text-align: center; font-weight: bold;">Código: GTH-F-090</td>
      </tr>
      <tr class="barra"><td colspan="24">GESTIÓN DE TALENTO HUMANO</td></tr>
      <tr class="barra"><td colspan="24">FORMATO AGENDA DESPLAZAMIENTO CONTRATISTA</td></tr>
    </table>

    <table>
      <tr class="enca"><td colspan="24">DATOS DEL CONTRATISTA QUE SE DESPLAZA</td></tr>
      <tr>
        <td colspan="12" class="fecha-venc">FECHA DE ELABORACIÓN DE AGENDA</td>
        <td colspan="12" class="resaltado">{{ $agenda->fecha_elaboracion }}</td>
      </tr>
      <tr class="resaltado">
        <td colspan="12">NOMBRES Y APELLIDOS</td>
        <td colspan="12">IDENTIFICACIÓN</td>
      </tr>
      <tr>
        <td colspan="12" class="resaltado" style="font-size: 12px;">{{ $agenda->nombre_completo }}</td>
        <td colspan="2" class="resaltado">Tipo</td>
        <td colspan="2" class="resaltado">{{ $agenda->tipo_documento }}</td>
        <td colspan="2" class="resaltado">No.</td>
        <td colspan="6" class="resaltado">{{ $agenda->numero_documento }}</td>
      </tr>
      <tr>
        <td colspan="3" class="resaltado">CONTRATO</td>
        <td colspan="2" class="resaltado">No.</td>
        <td colspan="4" class="resaltado">{{ $agenda->numero_contrato }}</td>
        <td colspan="2" class="resaltado">AÑO</td>
        <td colspan="2" class="resaltado">{{ $agenda->anio_contrato }}</td>
        <td colspan="4" style="font-size: 8px; font-weight: bold;">FECHA VENCIMIENTO DEL CONTRATO</td>
        <td colspan="7" class="resaltado">{{ $agenda->fecha_vencimiento }}</td>
      </tr>
      <tr>
        <td colspan="4" class="fecha-venc">OBJETO CONTRACTUAL:</td>
        <td colspan="20" style="font-size: 8px;">{{ $agenda->objetivo_contractual }}</td>
      </tr>
      <tr>
        <td colspan="4" class="fecha-venc">DIRECCIÓN GENERAL/ REGIONAL</td>
        <td colspan="8">{{ $agenda->direccion_general ?? 'ANTIOQUIA' }}</td>
        <td colspan="4" class="fecha-venc">DEPENDENCIA/ CENTRO</td>
        <td colspan="8">{{ $agenda->dependencia_centro ?? 'CENTRO TEXTIL Y DE GESTION INDUSTRIAL' }}</td>
      </tr>
      <tr>
        <td colspan="4" class="fecha-venc">NOMBRE DEL ORDENADOR DEL GASTO</td>
        <td colspan="8">DERLYS MARGOTH MADERA SOTO</td>
        <td colspan="4" class="fecha-venc">CARGO</td>
        <td colspan="8">SUBDIRECTOR ENCARGADA</td>
      </tr>
      <tr>
        <td colspan="4" class="fecha-venc">NOMBRE DEL SUPERVISOR(A) DEL CONTRATO</td>
        <td colspan="8">FREDDY CAMACHO GARCÍA</td>
        <td colspan="4" class="fecha-venc">CARGO</td>
        <td colspan="8">COORDINADOR ACADEMICO</td>
      </tr>

      <tr class="enca"><td colspan="24">INFORMACIÓN DEL DESPLAZAMIENTO</td></tr>
      <tr>
        <td colspan="4" class="fecha-venc">RUTA</td>
        <td colspan="20" class="resaltado">{{ $agenda->ruta }}</td>
      </tr>
      <tr>
        <td colspan="4" class="fecha-venc">CIUDAD/MUNICIPIO DESTINO</td>
        <td colspan="5">{{ $agenda->ciudad_destino }}</td>
        <td colspan="3" class="resaltado">ENTIDAD O EMPRESA:</td>
        <td colspan="4">{{ $agenda->entidad_empresa }}</td>
        <td colspan="2" class="resaltado">CONTACTO</td>
        <td colspan="6">{{ $agenda->contacto }}</td>
      </tr>
      <tr>
        <td colspan="4" class="fecha-venc">FECHA INICIO</td>
        <td colspan="8" class="resaltado">{{ $agenda->fecha_inicio_desplazamiento }}</td>
        <td colspan="4" class="fecha-venc">FECHA FIN</td>
        <td colspan="8" class="resaltado">{{ $agenda->fecha_fin_desplazamiento }}</td>
      </tr>
      <tr>
        <td colspan="4" class="fecha-venc">OBJETIVO DEL DESPLAZAMIENTO</td>
        <td colspan="20">{{ $agenda->objetivo_desplazamiento }}</td>
      </tr>
      
      <tr class="enca"><td colspan="24">AGENDA DE ACTIVIDADES</td></tr>
      @foreach ($agenda->actividades as $index => $actividad)
      <tr>
        <td colspan="24" style="text-align: left; padding: 10px;">
          <strong>Día {{ $index + 1 }}:</strong> {{ \Carbon\Carbon::parse($actividad->fecha_reporte)->format('d/m/Y') }}<br>
          <strong>Ruta ida:</strong> {{ $actividad->ruta_ida }} | <strong>Ruta regreso:</strong> {{ $actividad->ruta_regreso }}<br>
          <strong>Transporte:</strong> {{ is_array($actividad->medios_transporte) ? implode(', ', $actividad->medios_transporte) : $actividad->medios_transporte }}<br>
          <strong>Actividades:</strong> {{ $actividad->actividades_ejecutar }}
        </td>
      </tr>
      @endforeach

      <tr class="enca"><td colspan="24">FIRMAS</td></tr>
      <tr style="height: 100px;"> <td colspan="8" class="fecha-venc" style="vertical-align: top;">
          FIRMA ORDENADOR DE GASTO:
          @if($agenda->estado == 'APROBADA_SUBDIRECTOR' && $agenda->firma_ordenador)
            <img src="{{ asset('storage/' . $agenda->firma_ordenador) }}" class="firma-img">
          @endif
        </td>
        <td colspan="8" class="fecha-venc" style="vertical-align: top;">
          FIRMA SUPERVISOR DEL CONTRATO:
          @if($agenda->firma_supervisor)
            <img src="{{ asset('storage/' . $agenda->firma_supervisor) }}" class="firma-img">
          @endif
        </td>
        <td colspan="8" class="fecha-venc" style="vertical-align: top;">
          FIRMA DEL CONTRATISTA:
          @if($agenda->firma_contratista)
            <img src="{{ asset('storage/' . $agenda->firma_contratista) }}" class="firma-img">
          @endif
        </td>
      </tr>
      <tr style="height: 40px;">
        <td colspan="8">DERLYS MARGOTH MADERA SOTO<br>Subdirector(a) Encargado(a)</td>
        <td colspan="8">FREDDY CAMACHO GARCÍA<br>Coordinador Académico</td>
        <td colspan="8">{{ $agenda->nombre_completo }}<br>Contratista</td>
      </tr>
    </table>
    <div style="text-align: right; font-size: 9px; margin-top: 5px;">GTH-F-090 V.04</div>
  </div>

  <button id="btnPdf">Descargar PDF Formateado</button>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script>
    document.getElementById('btnPdf').addEventListener('click', function() {
      const element = document.getElementById('area-pdf');
      html2pdf().from(element).set({
        margin: 5,
        filename: 'Agenda_SENA_{{ $agenda->id }}.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 3, useCORS: true }, 
        jsPDF: { unit: 'mm', format: 'letter', orientation: 'portrait' }
      }).save();
    });
  </script>
</body>
</html>