.admin-sidebar {
position: fixed;
top: 0;
left: 0;
height: 100vh;
width: var(--sidebar-width);
background: linear-gradient(180deg, var(--despegar-blue) 0%, #004499 100%);
color: white;
z-index: 1000;
overflow-y: auto;
transition: all 0.3s ease;
}

.admin-sidebar.collapsed {
width: 70px;
}

.admin-sidebar.collapsed .menu-text {
display: none;
}

.admin-sidebar.collapsed .sidebar-brand span {
display: none;
}

.admin-sidebar.collapsed .menu-item {
text-align: center;
padding: 12px 0;
}

.admin-sidebar.collapsed .menu-item i {
margin-right: 0;
font-size: 1.2rem;
}

.main-content {
margin-left: var(--sidebar-width);
min-height: 100vh;
transition: margin-left 0.3s ease;
}

.main-content.collapsed {
margin-left: 70px;
}

.menu-item {
display: flex;
align-items: center;
padding: 12px 20px;
color: rgba(255, 255, 255, 0.8);
text-decoration: none;
transition: all 0.3s ease;
border-left: 3px solid transparent;
white-space: nowrap;
}

.menu-item i {
width: 20px;
margin-right: 15px;
text-align: center;
}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleSidebar');

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
        });

        // Cerrar el menú al hacer clic fuera de él en dispositivos móviles
        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = toggleBtn.contains(event.target);

            if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth < 768) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('collapsed');
            }
        });
    });
</script>
