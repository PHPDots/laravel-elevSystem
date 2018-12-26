<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $email_template_setting_id
 * @property string $template
 * @property string $subject
 * @property string $body
 * @property string $settings
 */
class EmailTemplate extends Model
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
    protected $fillable = ['email_template_setting_id', 'template', 'subject', 'body', 'settings'];

}
