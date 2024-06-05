var tabla = null
$(document).ready(async () => { })


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
    setTimeout(() => {
      window.location.reload();
    }, 2100);
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
    $("#header_modal_baja_alta").addClass("bg-danger text-white")
    $("#header_modal_baja_alta h1").html("¿Está seguro de dar de baja?")
  } else {
    $("#header_modal_baja_alta").addClass("bg-success text-white")
    $("#header_modal_baja_alta h1").html("¿Está seguro de dar de alta?")
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