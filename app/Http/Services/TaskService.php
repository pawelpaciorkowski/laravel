<?php

namespace App\Http\Services;

use App\Models\Task;
use Illuminate\Support\Collection;

class TaskService
{
    /**
     * Pobiera wszystkie aktywne zadania wraz z powiązanym wydarzeniem.
     *
     * @return Collection
     */
    public function getAllTasks(): Collection
    {
        return Task::with('internalEvent')->where('IsActive', true)->get();
    }

    /**
     * Pobiera pojedyncze zadanie po jego ID.
     *
     * @param int $id
     * @return Task|null
     */
    public function getTaskById(int $id): ?Task
    {
        return Task::find($id);
    }

    /**
     * Tworzy nowe zadanie.
     *
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task
    {
        // Ustawienie wartości domyślnych przy tworzeniu
        $data['CreationDateTime'] = now();
        $data['EditDateTime'] = now();
        $data['IsActive'] = true;
        // Przekształcenie wartości z checkboxa na boolean
        $data['IsDone'] = isset($data['IsDone']);

        return Task::create($data);
    }

    /**
     * Aktualizuje istniejące zadanie.
     *
     * @param int $id
     * @param array $data
     * @return Task|null
     */
    public function update(int $id, array $data): ?Task
    {
        $task = $this->getTaskById($id);
        if ($task) {
            $data['EditDateTime'] = now();
            $data['IsDone'] = isset($data['IsDone']);
            $task->update($data);
            return $task;
        }
        return null;
    }

    /**
     * Deaktywuje zadanie (miękkie usuwanie).
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $task = $this->getTaskById($id);
        if ($task) {
            // Zamiast usuwać, ustawiamy flagę IsActive na false
            $task->update(['IsActive' => false]);
            return true;
        }
        return false;
    }
}
