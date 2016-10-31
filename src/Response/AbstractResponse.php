<?php
namespace GdePosylka\Client\Response;

abstract class AbstractResponse
{
    /**
     * @var array
     */
    protected $data;

    public function __construct($data)
    {
        if ($data['result'] != 'error') {
            $this->data = $data;
        } else {
            throw new Exception\ResponseException(join(' ', $data['messages']));
        }
    }
}