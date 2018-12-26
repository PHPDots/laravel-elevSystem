<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $menu_items
 * @property string $role_slug
 * @property string $created
 * @property string $modified
 */
class Menu extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['slug', 'name', 'menu_items', 'role_slug', 'created', 'modified'];

}
