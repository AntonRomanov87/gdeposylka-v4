<?php
namespace GdePosylka\Client\Response;

use GdePosylka\Client\Checkpoint;

class TrackingInfoResponse extends AbstractResponse
{
    /**
     * @var Checkpoint[]
     */
    private $checkpoints = [ ];

    /**
     * @var TrackingExtraResponse[]
     */
    private $extra = [ ];

    public function __construct($data)
    {
        parent::__construct($data);

        foreach ($this->data['data']['checkpoints'] as $checkpoint) {
            $this->checkpoints[] = $this->makeCheckpoint($checkpoint);
        }
    }

    /**
     * @return Checkpoint[]
     */
    public function getCheckpoints()
    {
        return $this->checkpoints;
    }

    /**
     * @return TrackingExtraResponse[]
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @return string
     */
    public function getCourierSlug()
    {
        return $this->data['courier_slug'];
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->data['tracking_number'];
    }

    /**
     * @return string
     */
    public function isDelivered()
    {
        return $this->data['is_delivered'];
    }

    /**
     * @return \DateTime
     */
    public function getLastCheck()
    {
        return new \DateTime($this->data['last_check']);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return !empty($this->data['title']) ? $this->data['title'] : '';
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->data['status'];
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->data['is_active'];
    }

    private function makeCheckpoint(array $data)
    {
        $courier = new Checkpoint();
        $courier->setTime($data['time']);
        $courier->setStatusCode($data['status_code']);
        $courier->setStatusName($data['status_name']);

        return $courier;
    }
}