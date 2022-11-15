<?php

namespace NasimTelecom\Simotel\ComponentApi;

class SmartApi extends ComponentApi
{

    /**
     * @param mixed[] $data Simotel request data
     *
     * @return \NasimTelecom\Simotel\SmartApi
     * 
     * @throws \Exception
     */
    public function call($data)
    {
        $this->callApp($data);
        return $this;
    }
}
