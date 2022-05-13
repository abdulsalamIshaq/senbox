<?php

namespace AbdulsalamIshaq\Sendbox\Api;

class Shipment extends AbstractApi
{
    /**
     * Get the shipment information
     * 
     * @since 1.0
     * @return Array
     */
    public function getShipments(String $shipment_id = null) {
        $response = $this->get("shipping/shipments/" . ($shipment_id ? "/$shipment_id" : ""));

        return $this->responseArray($response);
    }

    /**
     * Get the shipment quotes
     * 
     * @since 1.0
     * @return Array
     */
    public function quotes(Array $body) {
        $response = $this->post("shipping/shipment_delivery_quote", $body);
        return $this->responseArray($response);
    }

    /**
     * Create a shipment
     * 
     * @since 1.0
     * @return Array
     */
    public function create(Array $body) {
        $response = $this->post("shipping/shipments", $body);

        return $this->responseArray($response);
    }
}
