// Menu responsivo

// funcao responsável por exibir ou esconder o menu dropdown ao clicar no botão de menu

function menu() {
  document.getElementById("dropdown").classList.toggle("show");
}

// evento que escuta qualquer clique na janela
window.onclick = function (event) {
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};
