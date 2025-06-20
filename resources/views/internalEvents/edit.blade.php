@extends('main')

@section('content')
<div class="container mt-5">
    <a href="{{ url('/internal-events') }}" class="btn btn-secondary mb-3">
        ⬅️ Strona główna
    </a>
    <h1>Edytuj wydarzenie</h1>

    <form action="{{ route('internal-events.update', $event->Id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Wystąpiły błędy:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="mb-3">
            <label>Tytuł</label>
            <input type="text" name="Title" class="form-control" value="{{ old('Title', $event->Title) }}" required>
        </div>

        <div class="mb-3">
            <label>Opis skrócony</label>
            <textarea name="ShortDescription" class="form-control">{{ old('ShortDescription', $event->ShortDescription) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Content HTML</label>
            <textarea name="ContentHTML" class="form-control">{{ old('ContentHTML', $event->ContentHTML) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Data wydarzenia</label>
            <input type="datetime-local" name="EventDateTime" class="form-control" value="{{ old('EventDateTime', $event->EventDateTime) }}">
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="IsPublic" id="isPublic" {{ old('IsPublic', $event->IsPublic) ? 'checked' : '' }}>
            <label class="form-check-label" for="isPublic">Publiczne</label>
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="IsCancelled" id="isCancelled" {{ old('IsCancelled', $event->IsCancelled) ? 'checked' : '' }}>
            <label class="form-check-label" for="isCancelled">Anulowane</label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="IsActive" id="isActive" {{ old('IsActive', $event->IsActive) ? 'checked' : '' }}>
            <label class="form-check-label" for="isActive">Aktywne</label>
        </div>

        <button type="submit" class="btn btn-primary">💾 Zapisz zmiany</button>
        <a href="{{ route('internal-events.index') }}" class="btn btn-secondary">↩️ Anuluj</a>
    </form>
</div>
@endsection