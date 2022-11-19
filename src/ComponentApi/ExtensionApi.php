<?php

namespace Simotel\ComponentApi;

class ExtensionApi extends ComponentApi
{
    /**
     * @param $data
     *
     * @return $this|bool
     */
    public function call($data)
    {
       

        $case = $this->callApp($data);
        if (!is_string($case)) {
            return $this->fail('Returned data must be type of string');
        }

        $this->response = [
            "ok" => "1",
            "extension" => $case
        ];

        return $this;
    }

}
