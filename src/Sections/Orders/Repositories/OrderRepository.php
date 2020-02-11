<?php


namespace NetLinker\FastBaselinker\Sections\Orders\Repositories;



use Carbon\Carbon;
use Illuminate\Support\Collection;
use NetLinker\FastBaselinker\Clients\ClientApi;
use NetLinker\FastBaselinker\Methods\MethodBaselinker;

class OrderRepository
{

    /** @var string $lastDateOrderKey */
    protected $lastDateOrderKey = 'date_add';

    /** @var string $dateFromParameter */
    protected $dateFromParameter = 'date_from';

    /** @var array $parameters */
    protected $parameters = ['get_unconfirmed_orders' => true];

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
            $fromTimestamp = $lastOrder[$this->lastDateOrderKey];

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
        $resp = $clientApi->request(MethodBaselinker::GET_ORDERS, array_merge([
            $this->dateFromParameter => $fromTimestamp,
        ], $this->parameters));

        return collect($resp['orders']);
    }

    /**
     * Set last date order key
     *
     * @param string $lastDateOrderKey
     * @return $this
     */
    public function setLastDateOrderKey(string $lastDateOrderKey)
    {
        $this->lastDateOrderKey = $lastDateOrderKey;
        return $this;
    }

    /**
     * Set parameters
     *
     * @param array $parameters
     * @return $this
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * Set date from parameter
     *
     * @param string $dateFromParameter
     * @return $this
     */
    public function setDateFromParameter(string $dateFromParameter)
    {
        $this->dateFromParameter = $dateFromParameter;
        return $this;
    }

}