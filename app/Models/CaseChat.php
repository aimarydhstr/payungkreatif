<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaseChat extends Model
{
    use HasFactory;

    protected $table = 'case_chats';

    protected $fillable = ['user_id', 'title', 'status'];

    public function chats() {
        return $this->hasMany(Chat::class, 'case_chat_id');
    }
}
