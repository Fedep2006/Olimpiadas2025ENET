import "./crear-registro.js";
import "./editar-registro.js";
import "./eliminar-registro.js";

const formItems = document.querySelector(".modal form");
const cantidadElementos = formItems.children.length;
formItems.setAttribute("data-items", cantidadElementos);
document
    .querySelector(".modal-content")
    .setAttribute("data-items", cantidadElementos);
