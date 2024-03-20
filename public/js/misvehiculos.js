$(document).on('show.bs.modal', '#modal_generar_qr', (e) => {
  $("#id_vehiculo").val(e.relatedTarget.dataset.id);
  $("#placa_modal").html(e.relatedTarget.dataset.placa);
});

$(document).on('submit', '#form_genqr', sendForm)


async function sendForm(e) {
  e.preventDefault();
  const data = $(e.target).serialize()
  const res = await $.ajax({
    url: '/qrregistro/create',
    type: 'POST',
    data,
    dataType: 'json',
  });
  console.log(res)
}

