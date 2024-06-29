<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $xid
 * @property string|Carbon|null $createdAt
 * @property string|Carbon|null $updatedAt
 * @property string $imageFileFormat
 * @property string $description
 * @property string $actionDatatable
 */
class Hero extends Model
{
    use HasFactory;
    protected $table = 'home_heroes';
    protected $fillable = [
        'id',
        'title',
        'deskripsi',
        'button',
        'image'
    ];

    public $timestamps = true;
}
