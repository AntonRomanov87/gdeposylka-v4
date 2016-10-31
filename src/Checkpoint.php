<?php
namespace GdePosylka\Client;

class Checkpoint
{
    protected $time;
    protected $status_code;
    protected $status_name;

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     *
     * @return Checkpoint
     */
    public function setTime($time)
    {
        $this->time = new \DateTime($time);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param mixed $status_code
     *
     * @return Checkpoint
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusName()
    {
        return $this->status_name;
    }

    /**
     * @param mixed $status_name
     *
     * @return Checkpoint
     */
    public function setStatusName($status_name)
    {
        $this->status_name = $status_name;

        return $this;
    }

}