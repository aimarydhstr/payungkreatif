<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats';

    protected $fillable = ['case_chat_id','user_id','role','message','metadata','status'];

    protected $casts = ['metadata' => 'array'];

    public function case() {
        return $this->belongsTo(CaseChat::class, 'case_chat_id');
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function review() {
        return $this->hasOne(Review::class);
    }

}
