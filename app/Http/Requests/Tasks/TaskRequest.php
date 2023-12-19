<?php

namespace App\Http\Requests\Tasks;

use App\Enums\Tasks\TaskStatusEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TaskRequest
 *
 * @OA\Schema(
 *      schema="TasksRequest",
 *      required={"parent_task_id", "status", "priority", "title", "description"},
 *      @OA\Property(property="parent_task_id", type="integer", example="1"),
 *      @OA\Property(property="status", type="string", format="date", enum={"todo", "done"}),
 *      @OA\Property(property="priority", type="null|integer", example="null|1"),
 *      @OA\Property(property="title", type="string", example="test"),
 *      @OA\Property(property="description", type="strig", example="test"),
 *  )
 * @property int $parentTaskId
 * @property string $status
 * @property int $priority
 * @property string $title
 * @property string $description
 */
final class TaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'parent_task_id' => ['required', 'integer'],
            'status' => ['required', 'string', new Enum(TaskStatusEnum::class)],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'string',],
            'description' => ['nullable', 'string'],
        ];
    }
}
