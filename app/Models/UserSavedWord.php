<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSavedWord extends Model
{
    protected $table = 'user_saved_words';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'dictionary_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function word()
    {
        return $this->belongsTo(Submission::class, 'dictionary_id');
    }

    public function dictionary()
    {
        return $this->belongsTo(Submission::class, 'dictionary_id');
    }
}
