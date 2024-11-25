<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Submission extends Model
{
    use Searchable;

    protected $table = 'dictionaries';
    protected $primaryKey = 'entry_id';
    protected $fillable = [
        'title',
        'description',
        'video_url',
        'submitter',
        'category_id',
    ];

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'description' => $this->description
        ];
    }
}
