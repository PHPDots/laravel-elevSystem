<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $entity_id
 * @property string $date_selected
 * @property string $location
 * @property string $time_slot
 * @property string $created
 * @property string $modified
 * @property string $form_type
 */
class LiveEdit extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'entity_id', 'date_selected', 'location', 'time_slot', 'created', 'modified', 'form_type'];

}
