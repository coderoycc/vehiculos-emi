// ---------Responsive-navbar-active-animation-----------
function test() {
  var tabsNewAnim = $("#navbarSupportedContent");
  var selectorNewAnim = $("#navbarSupportedContent").find("li").length;
  var activeItemNewAnim = tabsNewAnim.find(".active");
  var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
  var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
  var itemPosNewAnimTop = activeItemNewAnim.position();
  var itemPosNewAnimLeft = activeItemNewAnim.position();

  $(".hori-selector").css({
    top: itemPosNewAnimTop.top + "px",
    left: itemPosNewAnimLeft.left + "px",
    height: activeWidthNewAnimHeight + "px",
    width: activeWidthNewAnimWidth + "px"
  });

  $("#navbarSupportedContent").on("click", "li", function (e) {
    $("#navbarSupportedContent ul li").removeClass("active");
    console.log($(this).data().page)
    $(this).addClass("active");
    var activeWidthNewAnimHeight = $(this).innerHeight();
    var activeWidthNewAnimWidth = $(this).innerWidth();
    var itemPosNewAnimTop = $(this).position();
    var itemPosNewAnimLeft = $(this).position();

    $(".hori-selector").css({
      top: itemPosNewAnimTop.top + "px",
      left: itemPosNewAnimLeft.left + "px",
      height: activeWidthNewAnimHeight + "px",
      width: activeWidthNewAnimWidth + "px"
    });
  });
}

$(document).ready(async function () {
  setTimeout(function () {
    test();
  });
});

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

$(".navbar-toggler").click(function () {
  $(".navbar-collapse").slideToggle(300);

  setTimeout(function () {
    test();
  });
});

// --------------add active class-on another-page move----------
jQuery(document).ready(function ($) {
  // Get current path and find target link
  var path = window.location.pathname.split("/").pop();
  // Account for home page with empty path
  if (path == "") {
    path = "vehiculo";
  }
  var target = $('#navbarSupportedContent ul li a[href="/' + path + '"]');
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