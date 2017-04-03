<?php
/**
 * Created by Blend:merk.
 * User: Wietse van Ginkel
 */

namespace Reeleezee;


class RLZConnect
{
    public function __construct($url, $username, $password, $method = "GET")
    {

        $data = array("username" => $username, 'password' => $password);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);

        if ($response === false) {
            $info = curl_getinfo($ch);
            curl_close($ch);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($ch);
        $decoded = json_decode($response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
        }
        return $decoded->value;
    }
}