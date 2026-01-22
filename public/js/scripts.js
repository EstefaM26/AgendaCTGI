document.getElementById('btnPdf').addEventListener('click', () => {

  const elemento = document.querySelector('.hoja');

  const opciones = {
    margin: 0,
    filename: 'Agenda_Desplazamiento_SENA.pdf',
    image: { type: 'jpeg', quality: 1 },
    html2canvas: {
      scale: 2,          // 👈 MEJORA CALIDAD
      useCORS: true,
      scrollY: 0
    },
    jsPDF: {
      unit: 'mm',
      format: 'a4',
      orientation: 'portrait'
    },
    pagebreak: {
      mode: ['css', 'avoid-all']
    }
  };

  html2pdf()
    .set(opciones)
    .from(elemento)
    .save();
});
