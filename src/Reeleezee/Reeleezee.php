<?php
/**
 * Created by Blend:merk.
 * User: Wietse van Ginkel
 */

namespace Reeleezee;


class Reeleezee
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
     * @var
     */
    public $url;
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $password;

    /**
     * Reeleezee constructor.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct($url, $username, $password)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * APIRequest constructor.
     *
     * @param string $url
     * @param string $method
     * @param array  $data
     */
    public function request($request, $method = "GET", $data = [])
    {
        $ch = curl_init($this->url . $request);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
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
                return $response['value'];
            }
        }
        catch(APIException $e) {
            throw new APIException('Error response Reeleezee API');
        }

    }
}