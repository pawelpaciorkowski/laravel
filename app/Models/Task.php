<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'Id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Title',
        'IsDone',
        'StartDateTime',
        'Description',
        'Deadline',
        'InternalEventId',
        'CreationDateTime',
        'EditDateTime',
        'Notes',
        'IsActive',
    ];

    /**
     * Get the internal event that owns the task.
     */
    public function internalEvent(): BelongsTo
    {
        return $this->belongsTo(InternalEvent::class, 'InternalEventId');
    }
}
