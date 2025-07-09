@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des tâches</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a class="btn btn-primary mb-3" href="{{ route('tasks.create') }}">Ajouter une tâche</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('tasks.edit', $task->id) }}">Modifier</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette tâche ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Aucune tâche trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
