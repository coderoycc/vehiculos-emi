var tabla = null
$(document).ready(async () => {
  $("#placa").inputmask("mask", {
    mask: "[9{3,4}]-Z{3}", // Acepta 3 o 4 números y 3 letras
    placeholder: "_", // Quitar placeholder predeterminado
    definitions: {
      'Z': { // Definir Z como cualquier letra mayúscula o minúscula
        validator: "[a-zA-Z]",
        casing: "upper" // Mayúsculas por defecto
      }
    }
  });
  await listar();
})

$(document).on('submit', '#form_create', async (e) => {
  e.preventDefault();
  const data = $(e.target).serialize();
  try {
    const res = await $.ajax({
      url: "/panel/vehiculo/create",
      type: "POST",
      data,
      dataType: "json",
    });
    $("#vehiculo-new")
      .append(`<div class="alert alert-dismissible alert-success mt-2" role="alert">
      Vehículo registrado exitosamente
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
    setTimeout(() => {
      $(".alert").alert("close");
      location.reload();
    }, 2200);
  } catch (error) {
    $("#vehiculo-new")
      .append(`<div class="alert alert-dismissible alert-danger mt-2" role="alert">
      Ocurrio un error al registrar vehículo, intente nuevamente.
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
    url: "/panel/vehiculo/list",
    type: "GET",
    dataType: "json",
  });
  if (res.status) {
    tablaHtml(res.data);
  }
}
function tablaHtml(data) {
  let html = '';
  let button_baja = '';
  data.forEach(v => {
    console.log(v.habilitado == "SI")
    button_baja = v.habilitado === "SI" ?
      `<button type="button" data-bs-toggle="modal" data-bs-target="#modal_baja_alta" data-si="${v.habilitado}" class="btn btn-danger" data-id="${v.id}"> DAR BAJA</button>` :
      `<button type="button" data-bs-toggle="modal" data-bs-target="#modal_baja_alta" class="btn btn-success" data-si="${v.habilitado}" data-id="${v.id}"> DAR ALTA</button>`;
    html += `<tr>
      <td>${v.id}</td>
      <td>${v.tipo}</td>
      <td>${v.color}</td>
      <td>${v.placa}</td>
      <td>${v.modelo ?? 'S/M'}</td>
      <td>${v.persona.nombre}</td>
      <td>${v.creado_por.usuario}</td>
      <td class="text-center">
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit_vehiculo" data-id=${v.id}><i class="fa fa-solid fa-pencil"></i></button>
          ${button_baja}
        </div>
      </td>
    </tr>`;
  });

  $("#t_body_vehiculo").html(html);
  tabla = $("#table_vehiculo").DataTable({
    language: lenguaje,
    info: false,
    scrollX: true,
    columnDefs: [
      // { orderable: false, targets: [0, 6, 7] }
    ],
  })
}

$(document).on('show.bs.modal', '#edit_vehiculo', modal_edit_open);
$(document).on('show.bs.modal', '#modal_baja_alta', modal_baja_alta_open)
async function modal_edit_open(e) {
  const id = $(e.relatedTarget).data('id');
  const res = await $.ajax({
    url: `/panel/vehiculo/getdatamodal/${id}`,
    type: "GET",
    dataType: "json",
  });
  if (res.status) {
    $("#modal_edit_vehiculo_data").html(res.data);
    $("#placa_edit").inputmask("mask", {
      mask: "[9{3,4}]-Z{3}", // Acepta 3 o 4 números y 3 letras
      placeholder: "_", // Quitar placeholder predeterminado
      definitions: {
        'Z': { // Definir Z como cualquier letra mayúscula o minúscula
          validator: "[a-zA-Z]",
          casing: "upper" // Mayúsculas por defecto
        }
      }
    });
  }
}
async function editSave() {
  const data = $("#form_edit").serialize();
  const res = await $.ajax({
    url: "/panel/vehiculo/update",
    type: "POST",
    data,
    dataType: "json",
  });
  if (res.status) {
    toast('Actualizado', res.message, 'success', 2000)
  } else {
    toast('Error', res.message, 'error', 2000)
  }
}
function modal_baja_alta_open(e) {
  const val = $(e.relatedTarget).data('si');
  const id = $(e.relatedTarget).data('id');
  $("#baja_alta_id").val(id);
  $("#baja_alta_val").val(val);
  if (val == "SI") {
    $("#header_modal_baja_alta").addClass("bg-success text-white")
    $("#header_modal_baja_alta h1").html("¿Está seguro de dar de alta?")
  } else {
    $("#header_modal_baja_alta").addClass("bg-danger text-white")
    $("#header_modal_baja_alta h1").html("¿Está seguro de dar de baja?")
  }
}
async function baja_alta() {
  const id = $("#baja_alta_id").val();
  const value = $("#baja_alta_val").val();
  const token = $("input[name='_token']").val()
  const res = await $.ajax({
    url: `/panel/vehiculo/baja_alta`,
    data: { id, value, _token: token },
    type: "POST",
    dataType: "json",
  });
  if (res.status) {
    toast('Actualizado', res.message, 'success', 2000)
    setTimeout(() => {
      location.reload();
    }, 2000);
  } else {
    toast('Error', res.message, 'error', 2000)
  }
}