<?php
namespace GdePosylka\Client\Response;

use GdePosylka\Client\Courier;

class CourierListResponse extends AbstractResponse
{
    /**
     * @var Courier[]
     */
    private $couriers;

    public function __construct($data)
    {
        parent::__construct($data);

        foreach ($this->data as $courier) {
            $this->couriers[] = new Courier(array('result' => $courier));
        }
    }

    /**
     * @return Courier[]
     */
    public function getCouriers()
    {
        return $this->couriers;
    }
}