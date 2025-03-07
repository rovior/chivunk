const celularCheckbox = document.getElementById("celular");
const celularInput = document.getElementById("cellAdd");

celularCheckbox.addEventListener("change", function () {
  if (celularCheckbox.checked) {
    celularInput.style.display = "block";  // Exibe o campo de celular
  } else {
    celularInput.style.display = "none";  // Oculta o campo de celular
    celularInput.value = "";  // Limpa o valor
  }
});

$("#opcao").change(function () {
  var valor = $(this).val();
  alert("O valor selecionado é: " + valor);
});
