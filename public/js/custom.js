$(document).ready(async function () { });

async function getPage(page) {
  try {
    const res = await $.ajax({
      url: `/page/${page}`,
      type: 'GET',
      dataType: 'json',
    });
    $('#container').html(res.html)
  } catch (error) {
    console.log(error)
  }
}

// --------------add active class-on another-page move----------
jQuery(document).ready(function ($) {
  // Get current path and find target link
  var path = window.location.pathname.split("/").pop();
  // Account for home page with empty path
  if (path == "") {
    path = "vehiculo";
  }
  var target = $('#navbarSupportedContent ul li a[href="/panel/' + path + '"]');
  // Add active class to target link
  target.parent().addClass("active");
});

$(document).on('click', '#logout_btn', async () => {
  const token = $('input[name="_token"]').val()
  console.log(token)
  const res = await $.ajax({
    url: '/logout',
    type: 'POST',
    data: {
      _csrf: token
    }
  })
  console.log(res)
})

const lenguaje = {
  processing: "Procesando...",
  search: "Buscar en la tabla",
  lengthMenu: "Mostrar  _MENU_ filas ",
  paginate: {
    first: "Primero",
    previous: "Ant.",
    next: "Sig.",
    last: "Último",
  },
  emptyTable: "No hay registros...",
  infoEmpty: "No hay resultados",
  zeroRecords: "No hay registros...",
};

function toast(title, text, icon, time = 1600) {
  $.toast({
    heading: title,
    icon,
    text,
    showHideTransition: 'slide',
    position: 'top-right',
    hideAfter: time
  })
}