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
}
