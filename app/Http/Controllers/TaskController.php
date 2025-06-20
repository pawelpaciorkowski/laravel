<?php

namespace App\Http\Controllers;

use App\Http\Services\InternalEventsServices;
use App\Http\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;
    protected $internalEventsService;

    public function __construct(TaskService $taskService, InternalEventsServices $internalEventsService)
    {
        $this->taskService = $taskService;
        $this->internalEventsService = $internalEventsService;
    }

    /**
     * Wyświetla listę zadań.
     */
    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        return view('tasks.index', ['list' => $tasks]);
    }

    /**
     * Wyświetla formularz do tworzenia nowego zadania.
     */
    public function create()
    {
        // Pobieramy wydarzenia, aby móc je wyświetlić w dropdownie w formularzu
        $internalEvents = $this->internalEventsService->getInternalEvents();
        return view('tasks.create', ['internalEvents' => $internalEvents]);
    }

    /**
     * Zapisuje nowe zadanie w bazie danych.
     */
    public function store(Request $request)
    {
        $this->taskService->create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Nowe zadanie zostało pomyślnie dodane!');
    }

    /**
     * Wyświetla formularz do edycji zadania.
     */
    public function edit(string $id)
    {
        $task = $this->taskService->getTaskById((int)$id);
        $internalEvents = $this->internalEventsService->getInternalEvents();
        return view('tasks.edit', ['task' => $task, 'internalEvents' => $internalEvents]);
    }

    /**
     * Aktualizuje zadanie w bazie danych.
     */
    public function update(Request $request, string $id)
    {
        $this->taskService->update((int)$id, $request->all());
        return redirect()->route('tasks.index')->with('success', 'Zadanie zostało pomyślnie zaktualizowane!');
    }

    /**
     * "Usuwa" zadanie (deaktywuje je).
     */
    public function destroy(string $id)
    {
        $this->taskService->delete((int)$id);
        return redirect()->route('tasks.index');
    }

    /**
     * Wyświetla listę zadań w koszu.
     */
    public function trash()
    {
        $tasks = $this->taskService->getInactiveTasks();
        return view('tasks.trash', ['list' => $tasks]);
    }

    /**
     * Przywraca zadanie z kosza.
     */
    public function restore(string $id)
    {
        $this->taskService->restore((int)$id);
        // Po przywróceniu, wróć na stronę kosza z komunikatem o sukcesie
        return redirect()->route('tasks.trash')->with('success', 'Zadanie zostało pomyślnie przywrócone!');
    }

    /**
     * Trwale usuwa zadanie z bazy.
     */
    public function forceDelete(string $id)
    {
        $this->taskService->forceDelete((int)$id);
        return redirect()->route('tasks.trash')->with('success', 'Zadanie zostało trwale usunięte.');
    }
}
