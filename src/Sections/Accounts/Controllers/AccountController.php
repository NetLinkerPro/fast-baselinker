<?php

namespace NetLinker\FastBaselinker\Sections\Accounts\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use NetLinker\FastBaselinker\Sections\Accounts\Requests\StoreAccount;
use NetLinker\FastBaselinker\Sections\Accounts\Resources\Account;
use NetLinker\FastBaselinker\Sections\Accounts\Repositories\AccountRepository;

class AccountController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var AccountRepository $accounts */
    protected $accounts;

    /**
     * Constructor
     *
     * @param AccountRepository $accounts
     */
    public function __construct(AccountRepository $accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * Request index
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('fast-baselinker::sections.accounts.index', [
            'h1' => __('fast-baselinker::accounts.baselinker_accounts'),
            'accounts' => $this->scope($request)->response()->getData()
        ]);
    }

    /**
     * Request scope
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function scope(Request $request)
    {

        return Account::collection(
            $this->accounts->scope($request)
                ->scopeOwner()
                ->latest()->smartPaginate()
        );
    }
//
//    public function show(Request $request, $id)
//    {
//        $lead = $this->saleInvoices->findOrFail($id);
//
//        return view('sections.saleInvoices.show', [
//            'h1' => $lead->name,
//            'lead' => $lead
//        ]);
//    }
//
    /**
     * Request store
     *
     * @param StoreAccount $request
     * @return array
     */
    public function store(StoreAccount $request)
    {
        $this->accounts->create($request->all());

        return notify(__('fast-baselinker::accounts.new_account_was_successfully_added'));
    }

    /**
 * Update
 *
 * @param StoreAccount $request
 * @param $id
 * @return array
 */
    public function update(StoreAccount $request, $id)
    {
        $this->accounts->scopeOwner()->update($request->all(), $id);

        return notify(
            __('fast-baselinker::accounts.account_was_successfully_updated'),
            new Account($this->accounts->find($id))
        );
    }

    /**
     * Destroy
     *
     * @param StoreAccount $request
     * @param $id
     * @return array
     */
    public function destroy(Request $request, $id)
    {
        $this->accounts->scopeOwner()->destroy($id);

        return notify(__('fast-baselinker::accounts.account_was_successfully_deleted'));
    }
}
