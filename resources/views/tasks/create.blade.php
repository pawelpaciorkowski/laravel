@extends('main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">📝 Dodaj nowe zadanie</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="Title" class="form-label">Tytuł</label>
            <input type="text" class="form-control" id="Title" name="Title" required>
        </div>

        <div class="mb-3">
            <label for="Description" class="form-label">Opis</label>
            <textarea class="form-control" id="Description" name="Description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="InternalEventId" class="form-label">Wydarzenie wewnętrzne</label>
            <select class="form-select" id="InternalEventId" name="InternalEventId" required>
                <option selected disabled value="">Wybierz wydarzenie...</option>
                @foreach($internalEvents as $event)
                <option value="{{ $event->Id }}">{{ $event->Title }}</option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="StartDateTime" class="form-label">Data rozpoczęcia</label>
                <input type="datetime-local" class="form-control" id="StartDateTime" name="StartDateTime" required>
            </div>
            <div class="col-md-6">
                <label for="Deadline" class="form-label">Deadline</label>
                <input type="datetime-local" class="form-control" id="Deadline" name="Deadline" required>
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="IsDone" name="IsDone" value="1">
            <label class="form-check-label" for="IsDone">Oznacz jako wykonane</label>
        </div>

        <div class="mb-3">
            <label for="Notes" class="form-label">Notatki</label>
            <textarea class="form-control" id="Notes" name="Notes" rows="2"></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">💾 Zapisz</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">↩️ Anuluj</a>
        </div>
    </form>
</div>
@endsection