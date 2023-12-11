<?php

namespace App\Models;

use App\Acl\AccessControl;
use App\Helpers\FileUtility;
use App\Helpers\Util;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'email',
        'password',
        'profile_image',
        'uid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public array $child_model_class = [
        UserRole::class => [
            "foreignKey" => "user_id",
            "preventDelete" => false,
        ],
    ];

    public function userRole()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    public function role()
    {
        return $this->hasManyThrough(Role::class, UserRole::class);
    }

    public function setNewRoles($id, $new_role_id_list)
    {
        $exist_user_role_list = UserRole::where("user_id", "=", $id)->pluck("role_id", "id")->toArray();

        $is_change_in_role = false;

        foreach ($exist_user_role_list as $exist_role_id) {
            if (!in_array($exist_role_id, $new_role_id_list)) {
                //NEW ROLE
                $is_change_in_role = true;
            }
        }

        foreach ($new_role_id_list as $role_id) {
            if (!in_array($role_id, $exist_user_role_list)) {
                $is_change_in_role = true;
            }
        }

        $userRole = new UserRole();
        foreach ($new_role_id_list as $role_id) {
            $user_role_id = $userRole->insertIgnoreIfExist([
                'user_id' => $id,
                'role_id' => $role_id
            ]);

            unset($exist_user_role_list[$user_role_id]);
        }

        if ($exist_user_role_list) {
            UserRole::withoutEvents(function () use ($exist_user_role_list) {
                UserRole::destroy($exist_user_role_list);
            });
        }

        if ($is_change_in_role) {
            $accessControl = AccessControl::init();
            $accessControl->clearMenuCache([$id]);
        }
    }

    public function getProfileImage()
    {
        if ($this->profile_image)
        {
            return FileUtility::get($this->profile_image);
        }

        if ($this->avatar)
        {
            return $this->avatar;
        }
        
        return null;
    }

    public static function generateUID()
    {
        return Util::getRandomString(10) . time();
    }
}
