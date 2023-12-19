<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Tasks\IndexTaskResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class IndexController
 *
 * @OA\Get(
 *     tags={"Tasks"},
 *     path="/api/tasks",
 *     summary="Task list",
 *     @OA\Parameter(
 *         name="filter[status]",
 *         example="todo",
 *         in="query",
 *         allowReserved={"todo", "done"}
 *     ),
 *     @OA\Parameter(
 *          name="filter[priority]",
 *          example="1",
 *          in="query",
 *          allowReserved={"todo", "done"}
 *      ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(ref="#/components/schemas/TasksViewResource")
 *              ),
 *          )
 *     ),
 *     @OA\Response(response="500", description="Error server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * @package App\Http\Controllers\Tasks
 */
final class IndexController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke(): AnonymousResourceCollection
    {
        $user = \auth()->user();

        $tasks = QueryBuilder::for(Task::class)
            ->where('user_id', '=', $user->id)
            ->allowedFilters(['status', 'priority', 'title', 'description'])
            ->allowedSorts(['created_at', 'completed_at', 'priority'])
            ->paginate();

        return IndexTaskResource::collection($tasks);
    }
}
