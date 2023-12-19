<?php

namespace App\Http\Controllers\Tasks;

use App\DTO\Task\TaskItem;
use App\Services\Task\TaskService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\TaskRequest;
use App\Http\Resources\Tasks\ViewTaskResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UpdateController
 *
 * @OA\Put(
 *     tags={"Tasks"},
 *     path="/api/tasks/{id}",
 *     summary="Update task",
 *     @OA\Parameter(
 *         name="id",
 *         required=true,
 *         example="1",
 *         in="path"
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(ref="#/components/schemas/TasksRequest")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *               @OA\Property(
 *                   property="data",
 *                   type="object",
 *                   ref="#/components/schemas/TasksViewResource",
 *               )
 *           )
 *     ),
 *     @OA\Response(response="400", description="Bad request"),
 *     @OA\Response(response="422", description="Error validation"),
 *     @OA\Response(response="500", description="Error server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * @package App\Http\Controllers\Tasks
 */
final class UpdateController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function __invoke(int $id, TaskRequest $taskRequest): JsonResource
    {
        $service = new TaskService();

        $item = new TaskItem(
            parentTaskId: $taskRequest->parentTaskId,
            status: $taskRequest->status,
            priority: $taskRequest->priority,
            title: $taskRequest->title,
            description: $taskRequest->description
        );

        $item->setId($id);

        $task = $service->update($item);

        return ViewTaskResource::make($task);
    }
}
