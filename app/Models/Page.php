<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $category_code
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $file
 * @property string $created
 * @property string $modified
 */
class Page extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    protected $table = TBL_PAGES;

    /**
     * @var array
     */
    protected $fillable = ['category_code', 'title', 'slug', 'body', 'file', 'created', 'modified'];

}
