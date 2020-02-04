<?php

namespace NetLinker\FastBaselinker\Sections\Accounts\Repositories;

use AwesIO\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Auth;
use NetLinker\FastBaselinker\Sections\Accounts\Models\Account;
use NetLinker\FastBaselinker\Sections\Accounts\Scopes\AccountScopes;

class AccountRepository extends BaseRepository
{
    protected $searchable = [

    ];

    public function entity()
    {
        return Account::class;
    }

    public function scope($request)
    {
        // apply build-in scopes
        parent::scope($request);

        // apply custom scopes
        $this->entity = (new AccountScopes($request))->scope($this->entity);

        return $this;
    }

    public function scopeOwner()
    {
        $fieldUuid = config('fast-baselinker.owner.field_auth_user_owner_uuid');
        $ownerUuid = Auth::user()->$fieldUuid;

        $this->entity = $this->entity->where('owner_uuid', $ownerUuid);

        return $this;
    }

    /**
     * Delete a record by id.
     *
     * @param  int  $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $results = $this->entity->where('id', $id)->delete();

        $this->reset();

        return $results;
    }

}
