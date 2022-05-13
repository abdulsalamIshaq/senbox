<?php

namespace AbdulsalamIshaq\Sendbox\Api;

class Shipment extends AbstractApi
{
    /**
     * Get the shipment information
     * 
     * @since 1.0
     * @param string $shipment_id
     * @return Array
     */
    public function getShipments(String $shipment_id = null): Array 
    {
        $response = $this->get("shipping/shipments/" . ($shipment_id ? "/$shipment_id" : ""));

        return $this->responseArray($response);
    }

    /**
     * Get the shipment quotes
     * 
     * @since 1.0
     * @param Array $body
     * @return Array
     */
    public function quotes(Array $body): Array 
    {
        $response = $this->post("shipping/shipment_delivery_quote", $body);
        return $this->responseArray($response);
    }

    /**
     * Create a shipment
     * 
     * @since 1.0
     * @param Array $body
     * @return Array
     */
    public function create(Array $body): Array 
    {
        $response = $this->post("shipping/shipments", $body);

        return $this->responseArray($response);
    }

    /**
     * Tracking a shipment
     * 
     * @since 1.0
     * @param String $shipment_code
     * @return Array
     */
    public function tracking(String $shipment_code): Array 
    {
        $response = $this->get("shipping/tracking", [
            'code' => $shipment_code
        ]);
        return $this->responseArray($response);
    }

    /**
     * Get the saved addresses
     * 
     * @since 1.0
     * @return Array
     */
    public function addresses(): Array 
    {
        $response = $this->get("auth/addresses");
        return $this->responseArray($response);
    }
}
