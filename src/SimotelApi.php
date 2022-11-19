<?php

namespace Simotel;

use GuzzleHttp\Client;
class SimotelApi
{
    /**
     * @var array simotelApi config
     */
    private $config;

    /**
     * @var \GuzzleHttp\Client 
     */
    private $client;

    /**
     * @var \GuzzleHttp\Psr7\Response
     */
    private $response;

    /**
     * SimotelApi constructor.
     *
     * @param array $config simotelApi config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new Client(["base_uri" => $config["server_address"] ?? ""]);
    }

    /**
     * set custom guzzleHttp client
     *
     * @param Client $client
     * @return void
     */
    public function setClient(Client $client){
        $this->client = $client;
    }

    /**
     * connect to simotel api
     *
     * @param string $action simotel api action like: pbx/users/add or pbx/trunks/add.
     * @param array $data data to send to simotel as request body.
     * @return SimotelApi
     */
    public function connect($action, $data)
    {
        $this->response = $this->client->request(
            "post",
            $action,
            $this->httpRequestOptions($data)
        );

        return $this;
    }

    /**
     * cast Simotel response to json string.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->response->getBody();
    }

    /**
     * return 'message' part of Simotel response.
     *
     * @return void
     */
    public function getMessage(){
        return $this->toArray()["message"] ?? "";
    }

    /**
     * if success part of Simotel response is true.
     *
     * @return boolean
     */
    public function isSuccess(){
        return (bool) $this->toArray()["success"] ?? false; 
    }
    
    /**
     * return 'data' part of simotel response.
     *
     * @return array
     */
    public function getData(){
        return $this->toArray()["data"] ?? [];
    }

    /**
     * return guzzleHttp response of SimotelApi.
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getResponse(){
        return $this->response;
    }

    /**
     * if response status code is between 200~299.
     *
     * @return boolean
     */
    public function isOk(){
        return $this->response->getReasonPhrase() === "OK" ;
    }

    /**
     * return response status code.
     *
     * @return integer
     */
    public function getStatusCode(){
        return $this->response->getStatusCode() ;
    }

    /**
     * return Simotel response body as array. 
     *
     * @return array
     */
    public function toArray(){
        return json_decode($this->response->getBody(),true);
    }


    /**
     * prepare httpRequest options
     * 
     * @param array $data user data
     *  
     * @return array
     */
    private function httpRequestOptions($data)
    {

        $apiAuth = $this->config["api_auth"] ?? "basic";
        $apiUser = $this->config["api_user"] ?? "";
        $apiPass = $this->config["api_pass"] ?? "";
        $apiKey  = $this->config["api_key"]  ?? "";

        $options = [
            "json"=>$data,
            "headers"=>[
                "Content-Type"=>"application/json"
            ],
        ];

        if(in_array($apiAuth,["basic","both"])){
            $options['auth'] = [$apiUser, $apiPass];
        }

        if(in_array($apiAuth,["token","both"])){
            $options['headers']['X-APIKEY'] = $apiKey;
        }

        return $options;
    }
}
