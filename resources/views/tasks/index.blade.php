@extends('main')

@section('content')
<div class="container mt-5">
    <h1>Lista Zadań</h1>

    <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
        <a href="{{ route('tasks.create') }}" class="btn btn-success">
            ➕ Dodaj nowe zadanie
        </a>
        <a href="{{ route('tasks.trash') }}" class="btn btn-outline-secondary">
            🗑️ Kosz
        </a>



        <a href="{{ route('internal-events.index') }}" class="btn btn-outline-secondary">
            📋 Powrót do wydarzeń
        </a>
    </div>

    @if($list->isEmpty())
    <div class="alert alert-info">Brak zadań do wyświetlenia.</div>
    @else
    <div class="row gy-4">
        @foreach($list as $task)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $task->Title ?? 'Bez tytułu' }}</h5>
                    <p class="card-text">
                        <strong>Wydarzenie:</strong> {{ $task->internalEvent->Title ?? 'Brak' }}<br>
                        <strong>Status:</strong> {{ $task->IsDone ? '✅ Zakończone' : '⌛ W trakcie' }}<br>
                        <strong>Deadline:</strong> {{ $task->Deadline }}
                    </p>
                </div>
                <div class="card-footer bg-white d-flex gap-2">
                    <a href="{{ route('tasks.edit', $task->Id) }}" class="btn btn-primary btn-sm">✏️ Edytuj</a>

                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTaskModal{{ $task->Id }}">
                        🗑️ Usuń
                    </button>

                    <div class="modal fade" id="deleteTaskModal{{ $task->Id }}" tabindex="-1" aria-labelledby="deleteTaskModalLabel{{ $task->Id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteTaskModalLabel{{ $task->Id }}">Potwierdzenie usunięcia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
                                </div>
                                <div class="modal-body">
                                    Czy na pewno chcesz usunąć zadanie: <strong>{{ $task->Title }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                                    <form action="{{ route('tasks.destroy', $task->Id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">🗑️ Usuń</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection