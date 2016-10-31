<?php
namespace GdePosylka\Client\Response;

use GdePosylka\Client\Courier;

class CourierDetectResponse extends AbstractResponse
{
    /**
     * @var Courier[]
     */
    private $couriers;

    public function __construct($data)
    {
        parent::__construct($data);

        if (is_array($data['data'])) {
            foreach ($this->data['data'] as $courier) {
                $this->couriers[] = $this->makeCourier($courier['courier'], $courier['tracking_number']);
            }
        } else {
            throw new Exception\ResponseException('Tracking result unknown');
        }
    }

    /**
     * @return Courier[]
     */
    public function getCouriers()
    {
        return $this->couriers;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->data['length'];
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->data['tracking_number'];
    }

    private function makeCourier(array $data, string $trackingNumber)
    {
        $courier = new Courier();
        $courier->setCountryCode($data['country_code']);
        $courier->setName($data['name']);
        $courier->setSlug($data['slug']);
        $courier->setTrackingNumber($trackingNumber);

        return $courier;
    }
}