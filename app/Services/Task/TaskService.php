<?php

namespace App\Services\Task;

use App\Models\Task;
use App\DTO\Task\TaskItem;
use App\Helpers\ArrayHelper;
use Illuminate\Database\Eloquent\Model;

class TaskService
{
    /**
     * @param TaskItem $item
     *
     * @return array
     */
    private function formDataArray(TaskItem $item): array
    {
        return ArrayHelper::filterEmpty([
            'user_id' => $item->getUserId(),
            'parent_task_id' => $item->getParentTaskId(),
            'status' => $item->getStatus(),
            'priority' => $item->getPriority(),
            'title' => $item->getTitle(),
            'description' => $item->getDescription(),
            'created_at' => $item->getCreatedAt(),
            'updated_at' => $item->getUpdatedAt(),
            'completed_at' => $item->getCompletedAt(),
        ]);
    }

    /**
     * Task creation method
     *
     * @param TaskItem $item
     *
     * @return Model|null
     */
    public function add(TaskItem $item): ?Model
    {
        $user = auth()->user();

        return Task::query()->where('user_id', '=', $user->id)->create($this->formDataArray($item));
    }

    /**
     * Task update method
     *
     * @param TaskItem $item
     *
     * @return bool
     */
    public function update(TaskItem $item): bool
    {
        $user = auth()->user();

        return Task::query()->where('user_id', '=', $user->id)
            ->where('id', '=', $item->getId())
            ->update($this->formDataArray($item));
    }

    /**
     * Task delete method
     *
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        $user = auth()->user();

        return Task::query()->where('user_id', '=', $user->id)
            ->where('id', '=', $id)
            ->whereNull('parent_task_id')
            ->whereNotNull('completed_at')
            ->delete();
    }
}
