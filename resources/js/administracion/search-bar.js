import { updateTable, showToast } from "./utils";
setTimeout(function () {
    // Search functionality
    let searchTimeout;
    let inputs = null;
    for(i = 0; i>){

    }
    const searchInput = document.getElementById("searchInput");
    const dateInput = document.querySelector('input[name="registration_date"]');

    const pathname = window.location.pathname;

    // Function to perform search
    function performSearch() {
        const formData = new FormData(document.getElementById("searchForm"));
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

    // Real-time search with debounce
    searchInput.addEventListener("input", function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 500);
    });

    // Date input change handler
    dateInput.addEventListener("change", function () {
        performSearch();
    });

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
