<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Repositories\Task\TaskRepository;
use App\Http\Resources\Tasks\ViewTaskResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ViewController
 *
 * @OA\Get(
 *     tags={"Tasks"},
 *     path="/api/tasks/{id}",
 *     summary="View task",
 *     @OA\Parameter(
 *         name="id",
 *         required=true,
 *         example="1",
 *         in="path"
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  ref="#/components/schemas/TasksViewResource",
 *              )
 *          )
 *     ),
 *     @OA\Response(response="400", description="Bad request"),
 *     @OA\Response(response="422", description="Error validation"),
 *     @OA\Response(response="500", description="Error server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * @package App\Http\Controllers\Tasks
 */
final class ViewController extends Controller
{
    /**
     * @param int $id
     *
     * @return JsonResource
     */
    public function __invoke(int $id): JsonResource
    {
        $user = auth()->user();
        $repositories = new TaskRepository();
        $task = $repositories->getTask($user->id, $id);

        return ViewTaskResource::make($task);
    }
}
