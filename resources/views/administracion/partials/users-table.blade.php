@forelse ($users as $user)
    <tr>
        <td>
            <div class="user-profile">
                <div class="user-profile-avatar">
                    {{ substr($user->name, 0, 2) }}
                </div>
                <div class="user-info">
                    <h6>{{ $user->name }}</h6>
                    <small>ID: {{ $user->id }}</small>
                </div>
            </div>
        </td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
        <td>
            <div class="action-buttons">
                <button class="action-btn view" data-user-id="{{ $user->id }}" title="Ver perfil">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="action-btn edit" data-user-id="{{ $user->id }}" title="Editar usuario">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="action-btn message" data-user-id="{{ $user->id }}" title="Enviar mensaje">
                    <i class="fas fa-envelope"></i>
                </button>
                <button class="action-btn delete" data-user-id="{{ $user->id }}" title="Desactivar usuario">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center">No se encontraron usuarios</td>
    </tr>
@endforelse
