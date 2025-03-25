<?php
namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{
    public function performRequest($method, $requestUrl, $form_params = [], $headers = [])
{
    $client = new Client(['base_uri' => $this->baseUri]);

    $options = ['headers' => $headers];

    if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
        $options['form_params'] = $form_params;
    }

    $response = $client->request($method, $requestUrl, $options);

    return $response->getBody()->getContents();
}

}