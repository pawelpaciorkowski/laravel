@extends('main')

@section('content')
<div class="container mt-5">
    <a href="{{ url('/internal-events') }}" class="btn btn-outline-secondary mb-3">
        ⬅️ Strona główna
    </a>

    <h2>Dodaj nowe wydarzenie</h2>

    <form method="POST" action="{{ route('internal-events.store') }}">
        @csrf

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

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Tytuł</label>
                <input type="text" name="Title" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Link</label>
                <input type="text" name="Link" class="form-control" required>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Data wydarzenia</label>
                <input type="date" name="EventDateTime" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Data publikacji</label>
                <input type="date" name="PublishDateTime" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Krótki opis</label>
            <textarea name="ShortDescription" class="form-control" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Treść HTML</label>
            <textarea name="ContentHTML" class="form-control" rows="3"></textarea>
        </div>

        {{-- Checkboksy w jednej linii --}}
        <div class="row mb-4">
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="IsPublic" id="isPublic">
                    <label class="form-check-label" for="isPublic">Publiczne</label>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="IsCancelled" id="isCancelled">
                    <label class="form-check-label" for="isCancelled">Anulowane</label>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="IsActive" id="isActive" checked>
                    <label class="form-check-label" for="isActive">Aktywne</label>
                </div>
            </div>
        </div>

        {{-- Przycisk zapisu i anulowania w jednej linii --}}
        <div class="row mb-5">
            <div class="col-auto">
                <button type="submit" class="btn btn-success">
                    💾 Zapisz
                </button>
            </div>
            <div class="col-auto">
                <a href="{{ route('internal-events.index') }}" class="btn btn-outline-secondary">
                    ↩️ Anuluj
                </a>
            </div>
        </div>

    </form>
</div>
@endsection