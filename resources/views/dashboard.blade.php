<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app') {{-- o el layout que uses --}}
@section('content')
  <div class="container">
    <h1>¡Bienvenido, {{ auth()->user()->name }}!</h1>
    <p>Estás dentro de tu dashboard.</p>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="btn btn-secondary">Cerrar sesión</button>
    </form>
  </div>
@endsection
