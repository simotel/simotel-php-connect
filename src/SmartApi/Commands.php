<?php

namespace Simotel\SmartApi;

trait Commands
{
    /**
     * User insterted commands in array
     *
     * @var array
     */
    private $commands;

    /**
     * Insert user commands in commands set.
     *
     * @param string $command
     * @return void
     */
    private function addCommand($command):void
    {
        $this->commands[] = $command;
    }


    /**
     * Implode all commands into string.
     *
     * @return string 
     */
    private function implodeUserCommands():string
    {
        $commands = implode(';', $this->commands);
        $this->commands = [];

        return $commands;
    }

    /**
     * Make successfull response with user inserted commands as simotel response 
     * @see https://doc.mysup.ir/docs/api/callcenter_api/APIComponents/smart_api
     * 
     * @return array
     */
    private function makeOkResponse():array
    {
        return [
            'ok' => 1,
            'commands' => $this->implodeUserCommands(),
        ];
    }

    /**
     * Make unsuccessed response as simotel response 
     * @see https://doc.mysup.ir/docs/api/callcenter_api/APIComponents/smart_api
     * 
     * @return array
     */
    private function makeNokResponse():array
    {
        return ['ok' => 0];
    }

    
    /**
     * Simotel SmartApi command: 'PlayAnnouncement'
     *
     * @param string $announceName simotel announcement file name.
     * @return void
     */
    private function cmdPlayAnnouncement($announceName):void
    {
        $this->addCommand("PlayAnnouncement('$announceName')");
    }

   
    /**
     * Simotel SmartApi command: 'Playback'
     *
     * @param string $announceName
     * @return void
     */
    private function cmdPlayback($announceName):void
    {
        $this->addCommand("Playback('$announceName')");
    }

    /**
     * Simotel SmartApi command: 'SayDigit'
     *
     * @param integer $number
     * @return void
     */
    private function cmdSayDigit($number):void
    {
        $this->addCommand("SayDigit($number)");
    }

    /**
     * Simotel SmartApi command: 'SayNumber'
     *
     * @param integer $number
     * @return void
     */
    private function cmdSayNumber($number):void
    {
        $this->addCommand("SayNumber($number)");
    }

    /**
     * Simotel SmartApi command: 'SayDuration'
     *
     * @param integer $duration
     * @return void
     */
    private function cmdSayDuration($duration):void
    {
        $this->addCommand("SayDuration('$duration')");
    }

    /**
     * Simotel SmartApi command: 'SayClock'
     *
     * @param string $clock
     * @return void
     */
    private function cmdSayClock($clock):void
    {
        $this->addCommand("SayClock($clock)");
    }

    /**
     * Simotel SmartApi command: 'SayDate'
     *
     * @param string $date
     * @param string $calender
     * @return void
     */
    private function cmdSayDate($date, $calender):void
    {
        $this->addCommand("SayDate('$date','$calender')");
    }

    /**
     * Simotel SmartApi command: 'GetData'
     *
     * @param string  $announceName
     * @param integer $timeout
     * @param integer $digitsCount
     * @return void
     */
    private function cmdGetData($announceName, $timeout, $digitsCount):void
    {
        $this->addCommand("GetData('$announceName',$timeout,$digitsCount)");
    }

    /**
     * Simotel SmartApi command: 'SetExten'
     *
     * @param integer $exten
     * @param boolean $clearUserData
     * @return void
     */
    private function cmdSetExten($exten, $clearUserData = true):void
    {
        if ($clearUserData)
            $this->addCommand("ClearUserData()");
        
        $this->addCommand("SetExten('$exten')");
    }

    /**
     * Simotel SmartApi command: 'ClearUserData'
     *
     * @return void
     */
    private function cmdClearUserData():void
    {
        $this->addCommand("ClearUserData()");
    }

    /**
     * Simotel SmartApi command: 'SetLimitOnCall'
     *
     * @param integer $seconds
     * @return void
     */
    private function cmdSetLimitOnCall($seconds):void
    {
        $this->addCommand("SetLimitOnCall($seconds)");
    }
    
    /**
     * Simotel SmartApi command: 'MusicOnHold'
     *
     * @param [type] $announceName
     * @param [type] $duration
     * @return void
     */
    private function MusicOnHold($announceName, $duration):void
    {
        $this->addCommand("MusicOnHold('$announceName',$duration);");
    }

    /**
     * Simotel SmartApi command: 'Exit'
     *
     * @param [type] $exitRoute
     * @return void
     */
    private function cmdExit($exitRoute):void
    {
        $this->addCommand("Exit('$exitRoute')");
    }
}
