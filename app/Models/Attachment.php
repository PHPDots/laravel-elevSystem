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
    protected $table = TBL_ATTACHMENTS;

    /**
     * @var array
     */
    protected $fillable = ['uploader_id', 'filename', 'mime_type', 'timestamp'];

    public static function getAttachment($attachment_id)
    {
        $img = '';
        $fileEntry      = Attachment::find($attachment_id);
       // $file           = Attachment::getUploadPath('attachment') .'/'. Attachment::getFileName($attachment_id);
        if($fileEntry)
        {
            $img = asset('uploads/users/'.$fileEntry->filename);
        }
        else{
            $img = asset('/img/default-medium.png');
        }
        return $img;
    }

    public static function getUploadPath($objectType)
    {
        switch ($objectType){

            case 'attachment':

                return asset(LISABETHDATAATTACHMENT);

                break;
        }
    }

    public static function getFileName($id,$type = '')
    {
        return "AT_{$id}.lisabethattach";
    }

}
