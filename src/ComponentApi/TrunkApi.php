<?php

namespace Simotel\ComponentApi;

class TrunkApi extends ComponentApi
{

    /**
     * @param $data
     *
     * @return $this|bool
     */
    public function call($data)
    {
       
        $trunk = $this->callApp($data);
        if (!is_array($trunk)) {
            return $this->fail('Returned data must be type of array');
        }

        $this->response = [
            "ok" => "1",
            "trunk" => $trunk["trunk"],
            "extension" => $trunk["extension"],
            "call_limit" => $trunk["call_limit"],
        ];

        return $this;
    }
}
