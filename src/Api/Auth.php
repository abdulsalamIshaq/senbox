<?php 

namespace AbdulsalamIshaq\Sendbox\Api;

class Auth extends AbstractApi
{
    /**
     * Get the access token
     * 
     * @since 1.0
     * 
     * @return Array
     */
    public function getAccessToken(): Array 
    {
        $response = $this->get('oauth/access/access_token', [
            'app_id' => $this->app_id,
            'client_secret' => $this->client_secret,
            'redirect_url' => $this->redirect_url,
            'code' => $this->code
        ]);
        return $this->responseArray($response);
    }
    /**
     * Get new access token
     * 
     * @since 1.0
     * 
     * @return Array
     */
    public function getNewAccessToken(): Array 
    {
        die(print_r($this));
        $response = $this->get(`oauth/access/{$this->app_id}/refresh`, [
            'app_id' => $this->app_id,
            'client_secret' => $this->client_secret,
            // 'refresh_token' => $this->refresh_token
        ]);
        return $this->responseArray($response);
    }
}