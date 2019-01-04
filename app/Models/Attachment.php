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
        $fileEntry      = Attachment::find($attachment_id);
        $file           = Attachment::getUploadPath('attachment') .'/'. Attachment::getFileName($attachment_id);

        $fileData       = file_get_contents($file);
        

        $contentType = $fileEntry->mime_type; 
        $filesize = strlen($fileData); 
        
        /*header("Content-Type:{$contentType}");
        header("Content-Length:{$filesize}");
        header('Content-Type: application/x-download');
        header('Content-Disposition: attachment; filename="'.$fileEntry->filename.'"');
        die;*/
       // echo '<pre/>'; print_r($fileData); die;
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
