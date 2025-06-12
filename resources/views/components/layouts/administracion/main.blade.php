<!DOCTYPE html>
<html lang="en">

<head>
    @include('administracion.partials.head')
    <style>
        .dashboard-content {
            padding: 30px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--despegar-light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--despegar-blue);
            font-weight: bold;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-header h4 {
            color: var(--despegar-blue);
            margin: 0;
        }

        .top-navbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="main-content" id="mainContent">
        <div class="top-navbar">
            <div class="admin-header">
                <h4>{{ $nameHeader }}</h4>
            </div>

            <div class="admin-user">
                <div class="user-avatar">{{ substr(Auth::user()->name, 0, 2) }}</div>
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="text-muted">{{ Auth::user()->role }}</small>
                </div>
            </div>
        </div>
        <div class="dashboard-content">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
