document.addEventListener("DOMContentLoaded", function () {
    const mainContent = document.getElementById("mainContent");
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebar");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
        mainContent.classList.toggle("collapsed");
    });

    // Cerrar el menú al hacer clic fuera de él en dispositivos móviles
    document.addEventListener("click", function (event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnToggle = toggleBtn.contains(event.target);

        if (
            !isClickInsideSidebar &&
            !isClickOnToggle &&
            window.innerWidth < 768
        ) {
            sidebar.classList.add("collapsed");
            mainContent.classList.add("collapsed");
        }
    });
});
