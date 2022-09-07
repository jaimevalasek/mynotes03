<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Note $note
 * 
 */
class NoteItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'note_id',
    ];
}
