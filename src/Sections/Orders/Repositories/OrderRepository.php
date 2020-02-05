<?php


namespace NetLinker\FastBaselinker\Sections\Orders\Repositories;



use Carbon\Carbon;
use Illuminate\Support\Collection;
use NetLinker\FastBaselinker\Clients\ClientApi;
use NetLinker\FastBaselinker\Methods\MethodBaselinker;

class OrderRepository
{
    /**
     * Get orders
     *
     * @param Carbon $subMonth
     * @return Collection
     * @throws \NetLinker\FastBaselinker\Exceptions\FastBaselinkerException
     */
    public function get(ClientApi $clientApi, Carbon $fromDate)
    {
        $all = collect();

        $fromTimestamp = $fromDate->timestamp;

        while(true){

            $orders = $this->getLimit($clientApi, $fromTimestamp);
            $all = $all->merge($orders);

            if ($orders->count() < 100){
                break;
            }

            $lastOrder = $orders->last();
            $fromTimestamp = $lastOrder['date_confirmed'];

        }

        return $all;

    }

    /**
     * Get orders with limit
     *
     * @param ClientApi $clientApi
     * @param int $fromTimestamp
     * @return Collection
     * @throws \NetLinker\FastBaselinker\Exceptions\FastBaselinkerException
     */
    public function getLimit(ClientApi $clientApi, int $fromTimestamp)
    {
        $resp = $clientApi->request(MethodBaselinker::GET_ORDERS, [
            'date_confirmed_from' => $fromTimestamp,
        ]);

        return collect($resp['orders']);
    }
}