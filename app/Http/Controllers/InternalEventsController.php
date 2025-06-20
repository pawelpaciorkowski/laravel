<?php

namespace App\Http\Controllers;

use App\Models\InternalEvent;
use Illuminate\Http\Request;
use App\Http\Services\InternalEventsServices;


class InternalEventsController extends Controller
{
    private InternalEventsServices $service;
    public function __construct()
    {
        $this->service = new InternalEventsServices();
    }
    public function index(Request $request)
    {
        $status = $request->get('status');

        $query = InternalEvent::query();

        if ($status === 'active') {
            $query->where('IsActive', 1);
        } elseif ($status === 'inactive') {
            $query->where('IsActive', 0);
        }

        $models = $query->get();

        return view("internalEvents.index", compact('models', 'status'));
    }


    public function create()
    {
        return view("internalEvents.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'ShortDescription' => 'required|string',
            'ContentHTML' => 'required|string',
            'EventDateTime' => 'required|date',
            'Link' => 'nullable|string|max:255',
            'PublishDateTime' => 'required|date',
        ], [
            'EventDateTime.required' => 'Pole "Data wydarzenia" jest wymagane.',
            'EventDateTime.date' => 'Pole "Data wydarzenia" musi być poprawną datą.',
            'PublishDateTime.required' => 'Pole "Data publikacji" jest wymagane.',
            'PublishDateTime.date' => 'Pole "Data publikacji" musi być poprawną datą.',
        ]);

        // Dodaj obsługę checkboxów z wartościami domyślnymi
        $validated['IsPublic'] = $request->has('IsPublic') ? 1 : 0;
        $validated['IsCancelled'] = $request->has('IsCancelled') ? 1 : 0;
        $validated['IsActive'] = $request->has('IsActive') ? 1 : 0;


        $validated['CreationDateTime'] = now();
        $validated['EditDateTime'] = now();

        InternalEvent::create($validated);

        return redirect()->route('internal-events.index')->with('success', 'Dodano wydarzenie.');
    }


    public function edit($id)
    {
        $event = InternalEvent::findOrFail($id);
        return view('internalEvents.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'ShortDescription' => 'required|string',
            'ContentHTML' => 'required|string',
            'EventDateTime' => 'required|date',
            'Link' => 'nullable|string|max:255',
        ], [
            'EventDateTime.required' => 'Pole "Data wydarzenia" jest wymagane.',
            'EventDateTime.date' => 'Pole "Data wydarzenia" musi być poprawną datą.',

        ]);

        $validated['IsPublic'] = $request->has('IsPublic') ? 1 : 0;
        $validated['IsCancelled'] = $request->has('IsCancelled') ? 1 : 0;
        $validated['IsActive'] = $request->has('IsActive') ? 1 : 0;

        $validated['EditDateTime'] = now();

        InternalEvent::where('Id', $id)->update($validated);

        return redirect()->route('internal-events.index')->with('success', 'Zaktualizowano wydarzenie.');
    }


    public function destroy($id)
    {
        InternalEvent::destroy($id);
        return redirect()->route('internal-events.index')->with('success', 'Usunięto wydarzenie.');
    }
}
