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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'category_name' => 'Tidak memiliki kategori',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'submitter')->withDefault([
            'name' => 'Unknown',
        ]);
    }
}
