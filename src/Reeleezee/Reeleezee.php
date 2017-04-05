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
    public function request($route, $method = "GET", $data = [])
    {
        $data = json_encode($data);
        $ch = curl_init($this->url . $route);
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

    /**
     * @return mixed
     */
    public function getAdministrations()
    {
        return $this->request('administrations');
    }

    public function guid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}