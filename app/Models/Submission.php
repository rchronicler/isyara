<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'dictionaries';
    protected $primaryKey = 'entry_id';

    protected $fillable = [
        'title',
        'description',
        'video_url',
        'submitter',
        'category_id',
    ];
}
