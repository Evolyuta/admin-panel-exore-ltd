<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'image_path',
        'employee_id',
        'category_id',
    ];

    /**
     * Relationship with category
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }

    /**
     * Relationship with user
     *
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
