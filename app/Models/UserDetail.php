<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetail extends Model
{
    protected $table= 'user_details';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'dob',
        'telephone',
        'relation',
        'passport_photo',
        'illness',
        'address',
        'recommended_source',
        'recommended_source_address'
    ];

    /**
     * Get the user that owns the UserDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}