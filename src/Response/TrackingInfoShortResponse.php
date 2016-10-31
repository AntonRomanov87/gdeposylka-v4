<?php
namespace GdePosylka\Client\Response;

use GdePosylka\Client\Checkpoint;

class TrackingInfoShortResponse extends AbstractResponse
{
    /**
     * @var Checkpoint|null
     */
    private $lastCheckpoint = null;

    public function __construct($data)
    {
        parent::__construct($data);

        if ($this->data['last_checkpoint']) {
            $this->lastCheckpoint = new Checkpoint(array('result' => $this->data['last_checkpoint']));
        }
    }

    /**
     * @return Checkpoint|null
     */
    public function getLastCheckpoint()
    {
        return $this->lastCheckpoint;
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
}