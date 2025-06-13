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
            case "text":
                inputsElementos[i].addEventListener("input", function () {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(performSearch, 500);
                });
                break;
            default:
                break;
        }
    }
    const searchInput = document.getElementById("searchInput");
    const dateInput = document.querySelector('input[name="registration_date"]');

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
                showToast("Error al buscar usuarios", "error");
            });
    }

    // Handle form submission
    document
        .getElementById("searchForm")
        .addEventListener("submit", function (e) {
            e.preventDefault();
            performSearch();
        });

    // Clear all filters
    document
        .getElementById("clearFilters")
        .addEventListener("click", function () {
            searchInput.value = "";
            dateInput.value = "";
            performSearch();
        });
}, 50);
