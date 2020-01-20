<?php


namespace NetLinker\FastBaselinker\Clients;


use GuzzleHttp\Client;

class ClientBuilder
{

    /**
     * Create
     *
     * @param bool $verifySsl
     * @return $this
     */
    public static function create()
    {
        $instance = new static();
        return $instance;
    }

    /**
     * Build
     *
     * @return Client
     */
    public function build()
    {
        return new Client([
            'verify' => config('fast-baselinker.api.verify_ssl')
        ]);
    }


}