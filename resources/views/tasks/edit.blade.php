@extends('main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">✏️ Edytuj zadanie: {{ $task->Title }}</h1>

    <form action="{{ route('tasks.update', $task->Id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Title" class="form-label">Tytuł</label>
            <input type="text" class="form-control" id="Title" name="Title" value="{{ $task->Title }}" required>
        </div>

        <div class="mb-3">
            <label for="Description" class="form-label">Opis</label>
            <textarea class="form-control" id="Description" name="Description" rows="3" required>{{ $task->Description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="InternalEventId" class="form-label">Wydarzenie wewnętrzne</label>
            <select class="form-select" id="InternalEventId" name="InternalEventId" required>
                @foreach($internalEvents as $event)
                <option value="{{ $event->Id }}" {{ $task->InternalEventId == $event->Id ? 'selected' : '' }}>
                    {{ $event->Title }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="StartDateTime" class="form-label">Data rozpoczęcia</label>
                <input type="datetime-local" class="form-control" id="StartDateTime" name="StartDateTime"
                    value="{{ \Carbon\Carbon::parse($task->StartDateTime)->format('Y-m-d\TH:i') }}" required>
            </div>
            <div class="col-md-6">
                <label for="Deadline" class="form-label">Deadline</label>
                <input type="datetime-local" class="form-control" id="Deadline" name="Deadline"
                    value="{{ \Carbon\Carbon::parse($task->Deadline)->format('Y-m-d\TH:i') }}" required>
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="IsDone" name="IsDone" value="1" {{ $task->IsDone ? 'checked' : '' }}>
            <label class="form-check-label" for="IsDone">Oznacz jako wykonane</label>
        </div>

        <div class="mb-3">
            <label for="Notes" class="form-label">Notatki</label>
            <textarea class="form-control" id="Notes" name="Notes" rows="2">{{ $task->Notes }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">💾 Zapisz zmiany</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">↩️ Anuluj</a>
        </div>
    </form>
</div>
@endsection