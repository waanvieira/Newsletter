<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes, UuidTrait;

    public $increment = false;

    protected $fillable = [
        'id',
        'newletter_id',
        'title',
        'message',
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
        'newletter_id' => 'string',
        'title' => 'string',
        'message' => 'string',
        'created_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->belongsTo(NewsLetter::class);
    }

    // public function creator()
    // {
    //     return $this->belongsTo(User::class, 'creator_id', 'id');
    // }
}
