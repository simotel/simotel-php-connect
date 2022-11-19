<?php

namespace Simotel\ComponentApi;

use Exception;

class ComponentApi
{
    protected $config;
    protected $response;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function __toString()
    {
        return $this->toJson();
    }

    public function toJson()
    {
        return json_encode($this->response);
    }

    public function toArray()
    {
        return $this->response;
    }

    public function callApp($data)
    {
        $appName = $data['app_name'] ?? '';
       
        $className = $this->findAppClass($appName);
       

        if(!class_exists($className)){
            $this->fail("class '$className' not exists.");
        }

        $class = new $className();
        if (!method_exists($class, $appName)) {
            $this->fail("method '$appName' not defined in '{$className}'. ");
        }

        $response = $class->$appName($data);

        return $this->response = $response;
        
    }


    /**
     * @param $appName
     *
     * @return |null
     */
    protected function findAppClass($appName)
    {
        if (!$appName) {
            $this->fail("SmartApi data has not 'app_name' index.");
        }

        if (!isset($this->config['apps'])) {
            $this->fail("'appClasses' not defined in config");
        }

        $appClasses = $this->config['apps'];

        if (isset($appClasses[$appName])) {
            return $appClasses[$appName];
        }

        if (isset($appClasses['*'])) {
            return $appClasses['*'];
        }

        return $this->fail('Responsible class for app name not found');
    }

    /**
     * @param null $message
     */
    protected function fail($message = "")
    {
       throw(new Exception($message));
    }
}
