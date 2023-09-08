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
class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'name',
        'description',
        'image'
    ];

    public $timestamps = true;

    // protected $casts = [
    //     'updated_at' => 'array',
    //     'created_at' => 'array'
    // ];
}
