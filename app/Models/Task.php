<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $parent_task_id
 * @property string $status
 * @property int $priority
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $completed_at
 */
class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = [
        'user_id',
        'parent_task_id',
        'status',
        'priority',
        'title',
        'description',
        'completed_at',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
