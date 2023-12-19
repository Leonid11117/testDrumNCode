<?php

namespace App\Http\Controllers\Tasks;

use App\DTO\Task\TaskItem;
use App\Services\Task\TaskService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\TaskRequest;
use App\Http\Resources\Tasks\ViewTaskResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CreateController
 *
 * @OA\Post(
 *     path="/api/tasks",
 *     operationId="createTask",
 *     tags={"Tasks"},
 *     summary="Create a new task",
 *    @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(ref="#/components/schemas/TasksRequest")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="OK",
 *           @OA\JsonContent(
 *                @OA\Property(
 *                    property="data",
 *                    type="object",
 *                    ref="#/components/schemas/TasksViewResource",
 *                )
 *            )
 *      ),
 *     @OA\Response(response="422", description="Error validation"),
 *     @OA\Response(response="500", description="Error server"),
 *     security={{"bearerAuth": {}}},
 * )
 *
 * @package App\Http\Controllers\Tasks
 */
final class CreateController extends Controller
{
    public function __invoke(TaskRequest $taskRequest): JsonResource
    {
        $user = \auth()->user();

        $service = new TaskService();

        $item = new TaskItem(
            userId: $user->id,
            parentTaskId: $taskRequest->parentTaskId,
            status: $taskRequest->status,
            priority: $taskRequest->priority,
            title: $taskRequest->title,
            description: $taskRequest->description
        );

        $task = $service->add($item);

        return ViewTaskResource::make($task);
    }
}
