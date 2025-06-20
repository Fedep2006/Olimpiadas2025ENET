import { updateTable, showToast } from "./utils";
setTimeout(function () {
    // Search functionality
    let searchTimeout;

    const form = document.getElementById("searchForm");
    let inputs;

    if (typeof form.dataset.inputs === "string") {
        try {
            inputs = JSON.parse(form.dataset.inputs);
        } catch (e) {
            console.error("Error al buscar:", e);
            return;
        }
    }

    let inputsElementos = [];
    for (let i = 0; i < inputs.length; i++) {
        inputsElementos[i] = document.getElementById(inputs[i].id);

        switch (inputsElementos[i].type) {
            case "date":
                inputsElementos[i].addEventListener("change", function () {
                    performSearch();
                });
                break;
            default:
                inputsElementos[i].addEventListener("input", function () {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(performSearch, 200);
                });
                break;
        }
    }

    const pathname = window.location.pathname;

    // Function to perform search
    function performSearch() {
        const formData = new FormData(form);
        const searchParams = new URLSearchParams(formData);

        console.log(searchParams);

        fetch(pathname + `?${searchParams.toString()}`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                updateTable(data);
                window.history.pushState(
                    {},
                    "",
                    pathname + `?${searchParams.toString()}`
                );
            })
            .catch((error) => {
                console.error("Error:", error);
                showToast("Error al buscar", "error");
            });
    }

    // Handle form submission
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        performSearch();
    });

    // Clear all filters
    document
        .getElementById("clearFilters")
        .addEventListener("click", function () {
            for (let i = 0; i < inputsElementos.length; i++) {
                inputsElementos[i].value = "";
            }
            performSearch();
        });
}, 50);
