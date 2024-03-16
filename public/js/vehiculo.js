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
      `<button type="button" data-si="${v.habilitado}" class="btn btn-danger"> DAR BAJA</button>` :
      `<button type="button" class="btn btn-success" data-si="${v.habilitado}"> DAR ALTA</button>`;
    html += `<tr>
      <td>${v.id}</td>
      <td>${v.tipo}</td>
      <td>${v.color}</td>
      <td>${v.placa}</td>
      <td>${v.modelo ?? 'S/M'}</td>
      <td>${v.persona.nombre}</td>
      <td>${v.creado_por.usuario}</td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary"><i class="fa fa-solid fa-qrcode"></i></button>
          <button type="button" class="btn btn-info"><i class="fa fa-solid fa-pencil"></i></button>
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