<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $uploader_id
 * @property string $filename
 * @property string $mime_type
 * @property string $timestamp
 */
class Attachment extends Model
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
    protected $fillable = ['uploader_id', 'filename', 'mime_type', 'timestamp'];

}
