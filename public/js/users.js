var tabla = null
$(document).ready(async () => {
  await listar();
})

$(document).on('submit', '#form_create', async (e) => {
  e.preventDefault();
  const data = $(e.target).serialize();
  try {
    const res = await $.ajax({
      url: "/panel/users/create",
      type: "POST",
      data,
      dataType: "json",
    });
    $("#user-new")
      .append(`<div class="alert alert-dismissible alert-success mt-2" role="alert">
      Usuario registrado exitosamente, la contraseña es la misma que el usuario.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
    setTimeout(() => {
      $(".alert").alert("close");
      location.reload();
    }, 3500);
  } catch (error) {
    $("#user-new")
      .append(`<div class="alert alert-dismissible alert-danger mt-2" role="alert">
      Ocurrio un error al registrar al usuario, intente nuevamente.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
    setTimeout(() => {
      $(".alert").alert("close");
      $(e.target).trigger("reset");
    }, 2200);
  }
})

// $(document).on('click', '#lista-user-tab', async () => {
//   tabla = null
//   await listar();
// })

async function listar() {
  const res = await $.ajax({
    url: "/panel/users/list",
    type: "GET",
    dataType: "json",
  });
  if (res.status) {
    tablaHtml(res.data);
  }
}
function tablaHtml(data) {
  let html = '';
  data.forEach(u => {
    html += `<tr>
      <td>${u.id}</td>
      <td>${u.nombre}</td>
      <td>${u.usuario}</td>
      <td>${u.rol}</td>
      <td>${u.ci ?? ''}</td>
      <td></td>
    </tr>`;
  });
  $("#t_body_users").html(html);
  tabla = $("#table_users").DataTable({
    language: lenguaje,
    info: false,
    scrollX: true,
    columnDefs: [
      // { orderable: false, targets: [0, 6, 7] }
    ],
  })
}