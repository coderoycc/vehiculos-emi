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
  if (res.status) {
    const resqr = await $.ajax({
      url: `/api/qr/getqr/${res.data.id}`,
      type: 'GET',
      dataType: 'JSON'
    });
    const svgData = resqr.svg.replace('<?xml version="1.0" encoding="UTF-8"?>', '')
    console.log(svgData)
    if (resqr.status) {
      $("#qr_ver").html(svgData);
      $("#modal_ver_qr").modal('show')
    }
  }
}

async function descargarQr() {
  const data = document.querySelector('#qr_ver>svg')
  const res = await saveSvgAsPng(data, "qrcode.png", { scale: 1.1 });
  console.log(res)
}