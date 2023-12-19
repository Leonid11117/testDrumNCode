<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;

class TaskRepository
{
    /**
     * @param int $userId
     * @param int $id
     *
     * @return Model|null
     */
    public function getTask(int $userId, int $id): ?Model
    {
        return Task::query()->where('user_id', '=', $userId)
            ->where('id', '=', $id)
            ->first();
    }
}
