<?php

namespace Simotel;

use Simotel\ComponentApi\SmartApi;
use Simotel\ComponentApi\IvrApi;
use Simotel\ComponentApi\ExtensionApi;
use Simotel\ComponentApi\TrunkApi;

class Simotel
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param mixed[] $config Optional.
     */
    public function __construct(array $config = [])
    {
        $this->config = empty($config) ? $this->loadDefaultConfig() : $config;
    }

    /**
     * Connect to simotel api
     * 
     * @param String             $address     SimotelApi url.
     * @param mixed[]            $data        The data to send to Simotel as request body.
     * @param \GuzzleHttp\Client $httpClient  Optional. http guzzle client for 
     *                                        testing or some other reasons.
     * 
     * @return \Simotel\SimotelApi
     */
    public function connect($address, $data = [], $httpClient = null) : SimotelApi
    {
        $config = $this->config["simotelApi"] ?? [];
        $simotelApi = new SimotelApi($config);

        if($httpClient) 
            $simotelApi->setClient($httpClient);

        return $simotelApi->connect($address, $data);

    }

    /**
     * Call SmartApi app.
     * 
     * @param mixed[] $data request data that MUST contain app_name.
     * 
     * @return \Simotel\ComponentApi\SmartApi
     */
    public function smartApi($data)
    {
        $smartApi = new SmartApi($this->config['smartApi'] ?? []);
        return $smartApi->call($data);
    }

    /**
     * Call IvrApi app.
     * 
     * @param mixed[] $data request data that MUST contain app_name.
     * 
     * @return \Simotel\ComponentApi\SmartApi
     */
    public function ivrApi($data)
    {
        $ivrApi = new IvrApi($this->config['ivrApi'] ?? []);

        return $ivrApi->call($data);
    }

    /**
     * Call ExtensionApi app.
     * 
     * @param mixed[] $data request data that MUST contain app_name.
     * 
     * @return \Simotel\ComponentApi\ExtensionApi
     */
    public function extensionApi($data)
    {
        $ivrApi = new ExtensionApi($this->config['extensionApi'] ?? []);
        return $ivrApi->call($data);
    }

    /**
     * Call TrunkApi app.
     * 
     * @param mixed[] $data request data that MUST contain app_name.
     * 
     * @return \Simotel\ComponentApi\TrunkApi
     */
    public function trunkApi($data)
    {
        $ivrApi = new TrunkApi($this->config['trunkApi'] ?? []);
        return $ivrApi->call($data);
    }

    /**
     * @return SimotelEventApi
     */
    public function eventApi()
    {
        return new SimotelEventApi();
    }

    /**
     * Retrieve default config.
     *
     * @return array
     */
    protected function loadDefaultConfig(): array
    {
        return require static::getDefaultConfigPath();
    }

    /**
     * Retrieve Default config's path.
     *
     * @return string
     */
    public static function getDefaultConfigPath(): string
    {
        return dirname(__DIR__) . '/config/simotel.php';
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }
}
