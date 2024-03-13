$(document).ready(function () {
  console.log('reg')
});


$(document).on('submit', '#form_create', async (e) => {
  e.preventDefault();
  const data = $(e.target).serialize();
  try {
    const res = await $.ajax({
      url: '/personal/create',
      type: 'POST',
      data,
      dataType: 'json'
    });
    $("#user-new").append(`<div class="alert alert-dismissible alert-success" role="alert">
      Persona registrada exitosamente
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
  } catch (error) {
    $("#user-new").append(`<div class="alert alert-dismissible alert-danger" role="alert">
      Ocurrio un error al registrar la persona, intente nuevamente.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
  }
  setTimeout(() => {
    $(".alert").alert('close');
    $(e.target).trigger('reset');
  }, 2200);
});