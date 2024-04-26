<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsLetter extends Model
{
    use HasFactory, SoftDeletes, UuidTrait;

    public $increment = false;

    protected $fillable = [
        'id',
        'name',
        'description'
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'description' => 'string',
        'created_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "newsletter_user", "newsletter_id", "user_id");
    }
}
