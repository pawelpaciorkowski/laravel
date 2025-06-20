@extends('main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">🗑️ Kosz - Zadania</h1>

    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary mb-4">
        ⬅️ Powrót do listy zadań
    </a>

    @if($list->isEmpty())
    <div class="alert alert-info">Kosz jest pusty.</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tytuł</th>
                    <th>Wydarzenie wewnętrzne</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th class="text-center">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $task)
                <tr>
                    <td>{{ $task->Id }}</td>
                    <td>{{ $task->Title }}</td>
                    <td>{{ $task->internalEvent->Title ?? 'Brak' }}</td>
                    <td>{{ $task->IsDone ? '✅ Zakończone' : '⌛ W trakcie' }}</td>
                    <td>{{ $task->Deadline }}</td>
                    <td class="d-flex gap-2 justify-content-center flex-wrap">
                        <!-- Przywróć -->
                        <form action="{{ route('tasks.restore', $task->Id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">♻️ Przywróć</button>
                        </form>

                        <!-- Usuń na zawsze -->
                        <form action="{{ route('tasks.forceDelete', $task->Id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Usuń na zawsze</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection