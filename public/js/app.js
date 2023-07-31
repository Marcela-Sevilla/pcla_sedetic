(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
})()

$('#showPassword').click(function () {
  if ($('#showPassword').is(':checked')) {
    $('#password').attr('type', 'text');
  } else {
    $('#password').attr('type', 'password');
  }
});

$(document).ready(function () {
  $('#informationTable').DataTable({
    responsive: true,
    info: false,
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros por páginas",
        "zeroRecords": "No se encontro ningun registro - Disculpa",
        "infoEmpty": "No records available",
        "search": "Buscar Regional:",
        "loadingRecords": "Cargando Registros...",
        "paginate": {
          "first":      "Primera",
          "last":       "Última",
          "next":       "Siguiente",
          "previous":   "Previa"
        }
    },
  });
});

$(document).ready(function () {
  $('#historialTable').DataTable({
    responsive: true,
    info: false,
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros por páginas",
        "zeroRecords": "No se encontro ningun registro - Disculpa",
        "infoEmpty": "No records available",
        "search": "Buscar Regional:",
        "loadingRecords": "Cargando Registros...",
        "paginate": {
          "first":      "Primera",
          "last":       "Última",
          "next":       "Siguiente",
          "previous":   "Previa"
        }
    },
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'excelHtml5',
        text: 'Exportar Ecxel <i class="bi bi-filetype-exe"></i> ',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-send shadow-sm fw-semibold mt-3'
      }
    ],
  });
});