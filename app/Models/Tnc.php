<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TncUser;

/**
 * @property integer $id
 * @property string $title
 * @property string $terms
 * @property string $created
 * @property string $modified
 * @property TncUser[] $tncUsers
 */
class Tnc extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    protected $table = TBL_TNCS;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    /**
     * @var array
     */
    protected $fillable = ['title', 'terms', 'created', 'modified'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tncUsers()
    {
        return $this->hasMany('App\Models\TncUser');
    }

    public static function notificationCount($userId,$type = 'both')
    {
        $TncUser = new TncUser();
        
        $notification['count'] = TncUser::where('user_id',$userId)
                            ->where('agree',0)
                            ->count();

        if($type == 'both'){
            
            $conditions['TncUser.user_id']  = $userId;
        
            $notification['details'] = Tnc::leftJoin(TBL_TNC_USERS,TBL_TNCS.'.id',TBL_TNC_USERS.'.tnc_id')
                ->where(TBL_TNC_USERS.'.user_id',$userId)
                ->where(TBL_TNC_USERS.'.agree',0)
                ->get();
        }

        return $notification;
    } 
}
