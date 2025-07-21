<?php
// app/Services/XeroService.php
namespace App\Services;

use App\Models\XeroToken;
use GuzzleHttp\Client;

class XeroService
{
    public function getProvider()
    {
        return new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => config('services.xero.client_id'),
            'clientSecret'            => config('services.xero.client_secret'),
            'redirectUri'             => config('services.xero.redirect_uri'),
            'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
            'urlAccessToken'          => 'https://identity.xero.com/connect/token',
            'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation',
            'scopes' => 'openid profile email accounting.transactions accounting.settings'
        ]);
    }

   public function getAccessTokenUrl()
{
    $provider = $this->getProvider();

    return $provider->getAuthorizationUrl([
        'scope' => [
            'openid',
            'profile',
            'email',
            'offline_access',
            'accounting.transactions',
            'accounting.contacts'
        ]
    ]);
}


    public function handleCallback($code)
    {
        $provider = $this->getProvider();
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $code,
        ]);

        $response = (new Client())->get("https://api.xero.com/connections", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token->getToken()
            ]
        ]);

        $connections = json_decode((string) $response->getBody(), true);
        $tenantId = $connections[0]['tenantId'];

        XeroToken::updateOrCreate([], [
            'access_token' => $token->getToken(),
            'refresh_token' => $token->getRefreshToken(),
            'id_token' => $token->getValues()['id_token'] ?? null,
            'expires' => $token->getExpires(),
            'tenant_id' => $tenantId
        ]);
    }
}

?>