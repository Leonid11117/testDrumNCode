<?php

namespace App\Http\Controllers\Tasks;

use Illuminate\Http\JsonResponse;
use App\Services\Task\TaskService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 *  Class DeleteController
 *
 * @OA\Delete(
 *     tags={"Tasks"},
 *     path="/api/tasks/{id}",
 *     summary="Delete task",
 *     @OA\Parameter(
 *         name="id",
 *         required=true,
 *         example="1",
 *         in="path"
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="No content",
 *     ),
 *     @OA\Response(response="400", description="Bad request"),
 *     @OA\Response(response="422", description="Error validation"),
 *     @OA\Response(response="500", description="Error server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * @package App\Http\Controllers\Tasks
 */
final class DeleteController extends Controller
{
    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $service = new TaskService();
        $service->delete($id);

        return \response()->json([], ResponseAlias::HTTP_NO_CONTENT);
    }
}
