import "./crear-registro.js";
import "./editar-registro.js";
import "./eliminar-registro.js";
import "./mostrar-registro.js";

const formItems = document.querySelector(".modal form");
const cantidadElementos = formItems.children.length;
formItems.setAttribute("data-items-form", cantidadElementos);

const modal = document.getElementById("modalContent");
modal.setAttribute("data-items-modal", cantidadElementos);
