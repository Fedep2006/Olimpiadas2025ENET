let inputCounter = 0;
export function addDynamicInputs() {
    inputCounter++;

    const container = document.getElementById("dynamicInputsContainer");
    if (!container) {
        console.error("Container 'dynamicInputsContainer' not found");
        return;
    }
    const pathname = window.location.pathname;

    const inputGroup = document.createElement("div");
    inputGroup.className = "dynamic-input-group fade-in";
    inputGroup.id = `inputGroup${inputCounter}`;

    inputGroup.innerHTML = `
        <button type="button" class="btn btn-sm px-3 py-1 btn-outline-danger remove-btn" onclick="removeInputGroup(${inputCounter})">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="row">
            <div class="col-md-6">
                <label for="contenido_type_${inputCounter}" class="form-label">Tipo de Contenido</label>
                <select class="form-select" name="contenido_type_${inputCounter}"
                    id="contenido_type_${inputCounter}" required>
                    <option value"viaje">viaje</option>
                    <option value"hospedaje">hospedaje</option>
                    <option value"vehiculo">vehiculo</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="contenido_id_${inputCounter}" class="form-label">Contenido</label>
                <select class="form-select" name="contenido_type_${inputCounter}"
                    id="contenido_id_${inputCounter}" disabled="disabled" required></select>
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
    const { modalId = "nuevoRegistroModal" } = options;

    const modal = document.getElementById(modalId);
    if (modal) {
        modal.addEventListener("hidden.bs.modal", clearDynamicInputs);
    }
}

if (typeof window !== "undefined") {
    window.removeInputGroup = removeInputGroup;
    window.addDynamicInputs = addDynamicInputs;
}
