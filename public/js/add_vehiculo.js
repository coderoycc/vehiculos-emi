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
})