<?php
namespace GdePosylka\Client;

class Client
{
    protected $request;

    /**
     * @param string $apiKey
     * @param string $apiUrl
     * @param array $guzzlePlugins
     */
    public function __construct($apiKey, $apiUrl = '', $guzzlePlugins = array())
    {
        $this->request = new Request($apiKey, $apiUrl, $guzzlePlugins);
    }

    /**
     * @return Request
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Response\CourierListResponse
     */
    public function getCouriers()
    {
        return new Response\CourierListResponse($this->getRequest()->call('couriers'));
    }

    /**
     * @param $trackingNumber
     * @return Response\CourierDetectResponse
     * @throws Exception\EmptyTrackingNumber
     */
    public function detectCourier($trackingNumber)
    {
        if (empty($trackingNumber)) {
            throw new Exception\EmptyTrackingNumber();
        }
        return new Response\CourierDetectResponse($this->getRequest()->call('tracker/detect/', array(
            'tracking_number' => $trackingNumber
        )));
    }

    /**
     * @param $trackingNumber
     * @return Response\CourierDetectResponse
     * @throws Exception\EmptyTrackingNumber
     */
    public function getValidCouriers($trackingNumber)
    {
        if (empty($trackingNumber)) {
            throw new Exception\EmptyTrackingNumber();
        }
        return new Response\CourierDetectResponse($this->getRequest()->call('getValidCouriers', array(
            'tracking_number' => $trackingNumber
        )));
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @param TrackingFields $fields
     * @throws Exception\EmptyCourierSlug
     * @throws Exception\EmptyTrackingNumber
     * @return Response\TrackingResponse
     */
    public function addTracking($courierSlug, $trackingNumber, TrackingFields $fields = null)
    {
        if (empty($courierSlug)) {
            throw new Exception\EmptyCourierSlug;
        }
        if (empty($trackingNumber)) {
            throw new Exception\EmptyTrackingNumber;
        }
        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);

        return new Response\TrackingResponse($this->getRequest()->call('tracker/' . $courierSlug . '/', $tracking));
    }

    /**
     * @param string $filter
     * @param int $page
     * @return Response\TrackingListResponse
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function getTrackingList($filter = 'default', $page = 1)
    {
        $tracking = array('filter' => $filter, 'page' => $page);
        return new Response\TrackingListResponse($this->getRequest()->call('getTrackingList', $tracking));
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @throws Exception\EmptyCourierSlug
     * @throws Exception\EmptyTrackingNumber
     * @return Response\TrackingInfoResponse
     */
    public function getTrackingInfo($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new Exception\EmptyCourierSlug;
        }
        if (empty($trackingNumber)) {
            throw new Exception\EmptyTrackingNumber;
        }
        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);

        return new Response\TrackingInfoResponse($this->getRequest()->call('tracker/' . $courierSlug . '/', $tracking));
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @param TrackingFields $fields
     * @return Response\TrackingResponse
     * @throws Exception\EmptyCourierSlug
     * @throws Exception\EmptyTrackingNumber
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function updateTracking($courierSlug, $trackingNumber, TrackingFields $fields = null)
    {
        if (empty($courierSlug)) {
            throw new Exception\EmptyCourierSlug;
        }
        if (empty($trackingNumber)) {
            throw new Exception\EmptyTrackingNumber;
        }
        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        if (!empty($fields)) {
            $tracking = array_merge($tracking, $fields->toArray());
        }
        return new Response\TrackingResponse($this->getRequest()->call('updateTracking', array('tracking' => $tracking)));
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @return Response\TrackingResponse
     * @throws Exception\EmptyCourierSlug
     * @throws Exception\EmptyTrackingNumber
     */
    public function archiveTracking($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new Exception\EmptyCourierSlug;
        }
        if (empty($trackingNumber)) {
            throw new Exception\EmptyTrackingNumber;
        }
        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        return new Response\TrackingResponse($this->getRequest()->call('archiveTracking', array('tracking' => $tracking)));
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @return Response\TrackingResponse
     * @throws Exception\EmptyCourierSlug
     * @throws Exception\EmptyTrackingNumber
     */
    public function restoreTracking($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new Exception\EmptyCourierSlug;
        }
        if (empty($trackingNumber)) {
            throw new Exception\EmptyTrackingNumber;
        }
        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        return new Response\TrackingResponse($this->getRequest()->call('restoreTracking', array('tracking' => $tracking)));
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @return Response\TrackingResponse
     * @throws Exception\EmptyCourierSlug
     * @throws Exception\EmptyTrackingNumber
     */
    public function deleteTracking($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new Exception\EmptyCourierSlug;
        }
        if (empty($trackingNumber)) {
            throw new Exception\EmptyTrackingNumber;
        }
        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        return new Response\TrackingResponse($this->getRequest()->call('deleteTracking', array('tracking' => $tracking)));
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @return Response\TrackingResponse
     * @throws Exception\EmptyCourierSlug
     * @throws Exception\EmptyTrackingNumber
     */
    public function reactivateTracking($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new Exception\EmptyCourierSlug;
        }
        if (empty($trackingNumber)) {
            throw new Exception\EmptyTrackingNumber;
        }
        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        return new Response\TrackingResponse($this->getRequest()->call('reactivateTracking', array('tracking' => $tracking)));
    }
}
