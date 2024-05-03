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
    }, 2500);
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
      <td class="text-center">
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_edit_user" data-iduser="${u.id}"><i class="fa fa-solid fa-pencil"></i></button>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_delete_user" data-iduser="${u.id}"><i class="fa fa-solid fa-trash"></i></button>
      </div>
      </td>
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
$(document).on("show.bs.modal", "#modal_edit_user", modal_edit_open)
$(document).on("show.bs.modal", "#modal_delete_user", modal_delete_open)
function modal_delete_open(e) {
  const id = $(e.relatedTarget).data("iduser");
  $("#user_id_delete").val(id);
}
async function modal_edit_open(e) {
  const id = $(e.relatedTarget).data("iduser");
  const res = await $.ajax({
    url: "/panel/users/getdatamodal/" + id,
    type: "GET",
    dataType: "json",
  });
  if (res.status) {
    $("#modal_edit_user_content").html(res.html)
  }
}
async function deleteUser() {
  const data = $("#delete_user_form").serialize();
  const res = await $.ajax({
    url: "/panel/users/delete",
    type: "POST",
    data,
    dataType: "json",
  });
  if (res.status) {
    toast('Eliminar', 'Usuario eliminado', 'success', 2020);
    setTimeout(() => {
      location.reload();
    }, 2020);
  } else {
    toast('Error', res.message, 'error', 2020);
  }
}

async function saveEdit() {
  const data = $("#form_update").serialize();
  const res = await $.ajax({
    url: "/panel/users/update",
    type: "POST",
    data,
    dataType: "json",
  });
  if (res.status) {
    toast('Actualizado', 'Usuario actualizado', 'success', 2020);
    setTimeout(() => {
      location.reload();
    }, 2000);
  } else {
    toast('Error', res.message, 'error', 2020);
  }
}