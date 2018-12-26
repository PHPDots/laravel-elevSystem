<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer $id
 * @property string $role
 * @property integer $avatar_id
 * @property string $username
 * @property string $password
 * @property string $email_id
 * @property string $firstname
 * @property string $lastname
 * @property string $nick_name_user
 * @property string $nick_name_company
 * @property string $phone_no
 * @property string $status
 * @property string $activation_key
 * @property string $student_number
 * @property string $company
 * @property string $company_id
 * @property string $address
 * @property string $zip
 * @property string $city
 * @property string $other_phone_no
 * @property string $date_of_birth
 * @property int $balance
 * @property string $credit_max
 * @property string $available_balance
 * @property float $last_balance
 * @property string $last_entry_for_balance
 * @property integer $teacher_id
 * @property string $crm_id
 * @property string $assistent_id
 * @property boolean $handed_firstaid_papirs
 * @property string $firstaid_papirs_date
 * @property boolean $theory_test_passed
 * @property string $student_medical_profile
 * @property string $google_token
 * @property boolean $is_login_firsttime
 * @property int $is_completed
 * @property string $expiry_date
 * @property string $created
 * @property Role $role
 * @property Booking[] $bookings
 * @property TncUser[] $tncUsers
 */
class User extends Authenticatable
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    protected $guard = "users";

    /**
     * @var array
     */
    protected $fillable = ['role', 'avatar_id', 'username', 'password', 'email_id', 'firstname', 'lastname', 'nick_name_user', 'nick_name_company', 'phone_no', 'status', 'activation_key', 'student_number', 'company', 'company_id', 'address', 'zip', 'city', 'other_phone_no', 'date_of_birth', 'balance', 'credit_max', 'available_balance', 'last_balance', 'last_entry_for_balance', 'teacher_id', 'crm_id', 'assistent_id', 'handed_firstaid_papirs', 'firstaid_papirs_date', 'theory_test_passed', 'student_medical_profile', 'google_token', 'is_login_firsttime', 'is_completed', 'expiry_date', 'created'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role', 'slug');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tncUsers()
    {
        return $this->hasMany('App\Models\TncUser');
    }
}
