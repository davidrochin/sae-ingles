<?php

namespace App;

use App\Role;
use App\Student;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    protected $guarded = [
        'student_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function authorizeRoles($roles) {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyRole($roles) {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role) {
        if ($this->role()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function isRoleSuperiorThan($role){

        $userRole = $this->role->name;

        if(is_string($role)){
            if($userRole == 'admin' && $role != 'admin'){
                return true;
            }
            if($userRole == 'coordinator' && ($role == 'professor')){
                return true;
            }
            if($userRole == 'student'){
                return false;
            }
        }
        return false;
    }

    public function isSuperiorThan($user){
        return $this->isRoleSuperiorThan($user->role->name);
    }

    public function student(){
        return $this->hasOne(Student::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public static function professors(){
        $professorRoleId = Role::where('name', 'professor')->first()->id;
        return User::where('role_id', $professorRoleId);
    }

    public static function authorities(){
     $users = User::whereIn('role_id', [3,2,4]);
  
    return $users;
    }



    //Para buscar en los nombres
    public function scopeSearchName($query, $keyword){
        return $query->where('name', 'LIKE', '%'.$keyword.'%');
    }
}
