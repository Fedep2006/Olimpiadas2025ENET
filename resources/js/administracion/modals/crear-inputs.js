let inputCounter = 0;

export function addDynamicInputs() {
    inputCounter++;

    const container = document.getElementById("dynamicInputsContainer");
    if (!container) {
        console.error("Container 'dynamicInputsContainer' not found");
        return;
    }

    const inputGroup = document.createElement("div");
    inputGroup.className = "dynamic-input-group fade-in";
    inputGroup.id = `inputGroup${inputCounter}`;

    inputGroup.innerHTML = `
        <button type="button" class="btn btn-sm btn-outline-danger remove-btn" onclick="removeInputGroup(${inputCounter})">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="row">
            <div class="col-md-6">
                <label for="contenido_type_${inputCounter}" class="form-label">Tipo de Contenido</label>
                <input 
                    type="select" 
                    class="form-control" 
                    id="contenido_type_${inputCounter}" 
                    name="contenido_type_${inputCounter}" 
                    placeholder="Tipo del contenido"
                >
            </div>
            <div class="col-md-6">
                <label for="contenido_id_${inputCounter}" class="form-label">Contenido</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="contenido_id_${inputCounter}" 
                    name="contenido_id_${inputCounter}" 
                    placeholder="Contenido a Ingresar"
                >
            </div>
        </div>
    `;

    container.appendChild(inputGroup);

    inputGroup.scrollIntoView({ behavior: "smooth", block: "nearest" });
}

export function removeInputGroup(groupId) {
    const element = document.getElementById(`inputGroup${groupId}`);
    if (element) {
        element.style.animation = "fadeOut 0.3s ease";
        setTimeout(() => {
            element.remove();
        }, 300);
    }
}

export function clearDynamicInputs() {
    const container = document.getElementById("dynamicInputsContainer");
    if (container) {
        container.innerHTML = "";
    }
    inputCounter = 0;
}
export function initDynamicInputs(options = {}) {
    const { addButtonId = "addInputsBtn", modalId = "nuevoRegistroModal" } =
        options;

    const addButton = document.getElementById(addButtonId);
    if (addButton) {
        addButton.addEventListener("click", addDynamicInputs);
    }

    const modal = document.getElementById(modalId);
    if (modal) {
        modal.addEventListener("hidden.bs.modal", clearDynamicInputs);
    }

    addStyles();
}

function addStyles() {
    if (document.getElementById("dynamic-inputs-styles")) {
        return;
    }

    const style = document.createElement("style");
    style.id = "dynamic-inputs-styles";
    style.textContent = `
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-10px); }
        }
        
        .dynamic-input-group {
            position: relative;
            margin-bottom: 1rem;
            padding: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            background-color: #f8f9fa;
        }
        
        .dynamic-input-group .remove-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
}

if (typeof window !== "undefined") {
    window.removeInputGroup = removeInputGroup;
    window.addDynamicInputs = addDynamicInputs;
}
