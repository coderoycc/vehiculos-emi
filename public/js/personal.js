var tabla = null;
$(document).ready(() => { });

$(document).ready(async function () {
  await listar();
});

// $(document).on("click", "#lista-user-tab", async () => {
//   tabla = null
//   await listar();
// });

$(document).on("submit", "#form_create", async (e) => {
  e.preventDefault();
  const data = $(e.target).serialize();
  try {
    const res = await $.ajax({
      url: "/panel/personal/create",
      type: "POST",
      data,
      dataType: "json",
    });
    $("#user-new")
      .append(`<div class="alert alert-dismissible alert-success mt-2" role="alert">
      Persona registrada exitosamente
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
    setTimeout(() => {
      $(".alert").alert("close");
      location.reload();
    }, 2200);
  } catch (error) {
    $("#user-new")
      .append(`<div class="alert alert-dismissible alert-danger mt-2" role="alert">
      Ocurrio un error al registrar la persona, intente nuevamente.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
    setTimeout(() => {
      $(".alert").alert("close");
      $(e.target).trigger("reset");
    }, 2200);
  }
});

async function listar() {
  const res = await $.ajax({
    url: "/panel/personal/list",
    type: "GET",
    dataType: "json",
  });
  console.log(res);
  if (res.status) {
    tablaHtml(res.personas);
  }
}

function tablaHtml(data) {
  let html = "";
  data.forEach((element) => {
    html += `<tr>
    <td>${element.id}</td>
    <td>${element.nombre}</td>
    <td>${element.ci}</td>
    <td>${element.celular}</td>
    <td class="text-center">
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal_cars_user" data-iduser="${element.id}"><i class="fa fa-solid fa-car"></i></button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_edit_user" data-iduser="${element.id}"><i class="fa fa-solid fa-pencil"></i></button>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_delete_user" data-iduser="${element.id}"><i class="fa fa-soli fa-trash"></i></button>
      </div>
    </td>
    </tr>`;
  });
  $("#t_body_personal").html(html);
  tabla = $("#table_personal").DataTable({
    language: lenguaje,
    info: false,
    scrollX: true,
    columnDefs: [
      { orderable: false, targets: [2, 4] }
    ],
  });
}

$(document).on("show.bs.modal", "#modal_edit_user", modal_edit_open);
$(document).on("show.bs.modal", "#modal_delete_user", modal_delete_open);
$(document).on('show.bs.modal', "#modal_cars_user", modal_cars_open);
function modal_delete_open(e) {
  const id = $(e.relatedTarget).data("iduser");
  $("#user_id_delete").val(id);
}
async function modal_edit_open(e) {
  const id = $(e.relatedTarget).data("iduser");
  const res = await $.ajax({
    url: "/panel/personal/getdatamodal/" + id,
    type: "GET",
    dataType: "json",
  });
  if (res.status) {
    $("#modal_edit_user_content").html(res.html)
  }
}
async function modal_cars_open(e) {
  const id = $(e.relatedTarget).data("iduser");
  const res = await $.ajax({
    url: "/panel/personal/cars_user_modal/" + id,
    type: "GET",
    data: { id },
    dataType: "json",
  });
  if (res.status) {
    $("#modal_cars_user_content").html(res.html)
  }
}
async function deleteUser() {
  const data = $("#delete_user_form").serialize();
  const res = await $.ajax({
    url: "/panel/personal/delete",
    type: "POST",
    data,
    dataType: "json",
  });
  if (res.status) {
    toast('Eliminado', 'Usuario eliminado', 'success', 2020);
    setTimeout(() => {
      location.reload();
    }, 2000);
  } else {
    toast('Error', res.message, 'error', 2020);
  }
}
async function saveEdit() {
  const data = $("#form_update").serialize();
  const res = await $.ajax({
    url: "/panel/personal/update",
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