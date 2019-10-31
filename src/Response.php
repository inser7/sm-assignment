<?php

namespace SuperMetrics;

/**
 * The response object.
 *
 * Becomes a text json object in case of string representation.
 *
 */
class Response
{
    public $status;
    public $data;

    public function __construct($status, $data)
    {
        $this->status = (bool) $status;
        $this->data = $data;
    }

    public function __toString()
    {
        if ( ! $this->status) {
            header('Content-Type: application/json');
            return json_encode($this);
        }

        return $this->data;
    }
}
