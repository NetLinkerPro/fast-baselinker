<?php


namespace NetLinker\FastBaselinker\Tests\Stubs;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_test';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'owner_uuid', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

}