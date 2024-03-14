var tabla = null;
$(document).ready(() => {});

$(document).ready(async function () {
    await listar();
});

$(document).on("click", "#lista-user-tab", async () => {
    await listar();
});

$(document).on("submit", "#form_create", async (e) => {
    e.preventDefault();
    const data = $(e.target).serialize();
    try {
        const res = await $.ajax({
            url: "/personal/create",
            type: "POST",
            data,
            dataType: "json",
        });
        $("#user-new")
            .append(`<div class="alert alert-dismissible alert-success" role="alert">
      Persona registrada exitosamente
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
        setTimeout(() => {
            $(".alert").alert("close");
            location.reload();
        }, 2200);
    } catch (error) {
        $("#user-new")
            .append(`<div class="alert alert-dismissible alert-danger" role="alert">
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
        url: "/personal/list",
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
        <button type="button" class="btn btn-info"><i class="fa fa-solid fa-car"></i></button>
        <button type="button" class="btn btn-primary"><i class="fa fa-solid fa-pencil"></i></button>
        <button type="button" class="btn btn-danger"><i class="fa fa-soli fa-trash"></i></button>
      </div>
    </td>
    </tr>`;
    });
    if (html == "")
        html = `<tr class="text-center"><td colspan="5">No exiten registros</td></tr>`;
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
