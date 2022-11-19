<?php

namespace Simotel\ComponentApi;

class IvrApi extends ComponentApi
{
    /**
     * @param $data
     *
     * @return $this|bool
     */
    public function call($data)
    {
        
        $case = $this->callApp($data);
       
        $this->response = [
            "ok" => "1",
            "case" => $case
        ];

        return $this;
    }
}
