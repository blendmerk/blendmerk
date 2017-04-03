<?php
/**
 * Created by Blend:merk.
 * User: Wietse van Ginkel
 */

namespace Reeleezee;


class APIRequest
{
    /**
     * @var array
     */
    protected $headers = [
        'Accept: application/json',
        'Accept-Language: en',
        'Content-Type: application/json; charset=UTF-8',
        'Prefer: return=representation',
    ];

    /**
     * @var
     */
    public $response;

    /**
     * APIRequest constructor.
     *
     * @param string $url
     * @param string $username
     * @param string $password
     * @param string $method
     * @param array  $data
     */
    public function __construct($url, $username, $password, $method = "GET", $data = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else if ($method == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else if ($method == 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $content = curl_exec($ch);
        $result = curl_getinfo($ch);
        curl_close($ch);

        try {
            $response = json_decode($content, true);

            if(isset($response['value'])) {
                $this->response = $response['value'];
            }
        }
        catch(APIException $e) {
            throw new APIException('Error response Reeleezee API');
        }

    }
}