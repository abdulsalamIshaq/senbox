<?php

namespace AbdulsalamIshaq\Sendbox\Api;

class Payment extends AbstractApi
{
    /**
     * Get the payment details
     * 
     * @since 1.0
     * 
     * @return Array
     */
    public function profile(): Array
    {
        $response = $this->get('payments/profile');
        return $this->responseArray($response);
    }

    /**
     * Get virtual accounts
     * 
     * @since 1.0
     * @return Array
     */
    public function virtualAccounts(): Array 
    {
        $response = $this->get('payments/virtual_accounts');
        return $this->responseArray($response);
    }
}