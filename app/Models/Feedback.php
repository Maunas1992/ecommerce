<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    public $table = 'feedbacks';
    public $fillable = [
        'user_id',
        'name',
        'email',
        'mobile_no',
        'subject',
        'message'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
