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
    public function getNewAccessToken(String $app_id, String $client_secret, String $refresh_token) 
    {
        
        $response = $this->get('oauth/access/{$app_id}/refresh', [
            'app_id' => $app_id,
            'client_secret' => $client_secret,
            // 'refresh_token' => $this->refresh_token
        ], ['refresh_token' => $refresh_token]);
        
        // return $this->responseArray($response);
    }
}