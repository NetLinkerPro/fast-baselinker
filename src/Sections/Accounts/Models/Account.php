<?php

namespace NetLinker\FastBaselinker\Sections\Accounts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use NetLinker\FastBaselinker\Tests\Stubs\Owner;
use Ramsey\Uuid\Uuid;
use Cog\Laravel\Ownership\Traits\HasOwner;
use Cog\Contracts\Ownership\Ownable as OwnableContract;

class Account extends Model implements OwnableContract
{

    use SoftDeletes, HasOwner;

    protected $ownerPrimaryKey = 'uuid';
    protected $ownerForeignKey = 'owner_uuid';

    protected $withDefaultOwnerOnCreate = true;

    /**
     * Get owner model name.
     *
     * @return string
     */
    protected function getOwnerModel()
    {
        return config('fast-baselinker.owner.model');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fast_baselinker_accounts';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['uuid', 'owner_uuid', 'name', 'api_token'];

    public $orderable = [];

    protected $encryptable = ['api_token'];

    /**
     * Resolve entity default owner.
     *
     * @return null|\Cog\Contracts\Ownership\CanBeOwner
     */
    public function resolveDefaultOwner()
    {
        $fieldUuid = config('fast-baselinker.owner.field_auth_user_owner_uuid');
        $model =$this->getOwnerModel();
        return $model::where('uuid', Auth::user()->$fieldUuid)->first();
    }

    /**
     * Binds creating/saving events to create UUIDs (and also prevent them from being overwritten).
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });

        static::saving(function ($model) {
            $original_uuid = $model->getOriginal('uuid');
            if ($original_uuid !== $model->uuid) {
                $model->uuid = $original_uuid;
            }
        });
    }

    /**
     * If the attribute is in the encryptable array
     * then decrypt it.
     *
     * @param  $key
     *
     * @return $value
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (in_array($key, $this->encryptable) && $value !== '') {
            $value = decrypt($value);
        }
        return $value;
    }

    /**
     * If the attribute is in the encryptable array
     * then encrypt it.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable)) {
            $value = encrypt($value);
        }
        return parent::setAttribute($key, $value);
    }
    /**
     * When need to make sure that we iterate through
     * all the keys.
     *
     * @return array
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();
        foreach ($this->encryptable as $key) {
            if (isset($attributes[$key])) {
                $attributes[$key] = decrypt($attributes[$key]);
            }
        }
        return $attributes;
    }
}

