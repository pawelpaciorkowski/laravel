@extends('main')

@section('content')
<div class="container mt-5">
    <h1>Internal Events</h1>

    <div class="d-flex  align-items-center mb-4 flex-wrap gap-2">
        <a href="{{ route('internal-events.create') }}" class="btn btn-success">
            ➕ Dodaj nowe wydarzenie
        </a>

        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
            📋 Lista zadań
        </a>


        <form method="GET" action="{{ route('internal-events.index') }}">
            <div class="input-group">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Wszystkie</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktywne</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nieaktywne</option>
                </select>
            </div>
        </form>
    </div>


    @if ($models->isEmpty())
    <div class="alert alert-info">Brak wydarzeń.</div>
    @else
    <div class="row gy-4">
        @foreach ($models as $model)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $model->Title ?? 'Bez tytułu' }}</h5>
                    <p class="card-text">
                        <strong>Short description:</strong><br>
                        {!! $model->ShortDescription ?? 'Brak opisu' !!}
                    </p>
                </div>

                <div class="card-footer bg-white d-flex gap-2">
                    <form action="{{ route('internal-events.edit', $model->Id) }}" method="GET" style="display:inline-block;">
                        <button type="submit" class="btn btn-primary btn-sm">✏️ Edytuj</button>
                    </form>

                    <!-- Przycisk otwierający modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $model->Id }}">
                        🗑️ Usuń
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal{{ $model->Id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $model->Id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $model->Id }}">Potwierdzenie usunięcia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
                                </div>
                                <div class="modal-body">
                                    Czy na pewno chcesz usunąć wydarzenie: <strong>{{ $model->Title }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>

                                    <!-- Form wewnątrz modala -->
                                    <form action="{{ route('internal-events.destroy', $model->Id) }}" method="POST">
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