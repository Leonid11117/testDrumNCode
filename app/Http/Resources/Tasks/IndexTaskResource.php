<?php

namespace App\Http\Resources\Tasks;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class IndexTaskResource
 *
 * @OA\Schema(
 *     schema="IndexTaskResource",
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="user_id", type="integer", example="1"),
 *     @OA\Property(property="parent_task_id", type="integer", example="1"),
 *     @OA\Property(property="status", type="string", format="date", enum={"todo", "done"}),
 *     @OA\Property(property="priority", type="null|integer", example="null|1"),
 *     @OA\Property(property="title", type="string", example="test"),
 *     @OA\Property(property="description", type="strig", example="test"),
 *     @OA\Property(property="completed_at", type="string", format="date", example="2023-12-19T19:47:23.000000Z"),
 * )
 *
 * @property-read Task $resource
 *
 * @package App\Http\Resources\Tasks
 */
final class IndexTaskResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'user_id' => $this->resource->user_id,
            'parent_task_id' => $this->resource->parent_task_id,
            'status' => $this->resource->status,
            'priority' => $this->resource->priority,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'completed_at' => $this->resource->completed_at,
        ];
    }
}
