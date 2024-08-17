<?php

require 'vendor/autoload.php';

use Google\Client;
use Google\Service\FirebaseCloudMessaging;
use Google\Exception;

class FireBasePush{

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function notifica($titulo, $mensagem, $imagem)
    {
        $this->CI->db->order_by('id', 'DESC');
        $token = $this->CI->db->get('token')->row_array();
        
        $filePath = RAIZ.'assets/token/notifica-midia-ab6a03d03602.json';
        
        $tokenAcess = $this->get_access_token($filePath);

        $url = "https://fcm.googleapis.com/v1/projects/749588664531/messages:send";
        $data = [
            'message' => [
                "data" => [
                    "title" => $titulo,
                    "body" => $mensagem,
                    "icon" => "",
                    "image" => $imagem,
                    "click_action" => ""
                ],

                'token' => $token['token']
            ]
        ];
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $tokenAcess,
                "Content-Type: application/json",
            ),
            CURLOPT_POSTFIELDS => json_encode($data),
        );
        $curl = curl_init();
        curl_setopt_array($curl, $options);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        print_r($response);
    }
    
    function get_access_token($JSON_file_path) {
        $client = new Client();
        try {
            $client->setAuthConfig($JSON_file_path);
            $client->addScope(FirebaseCloudMessaging::CLOUD_PLATFORM);

            $savedTokenJson = $this->readSavedToken();

            if ($savedTokenJson) {
                // the token exists, set it to the client and check if it's still valid
                $client->setAccessToken($savedTokenJson);
                $accessToken = $savedTokenJson;
                if ($client->isAccessTokenExpired()) {
                    // the token is expired, generate a new token and set it to the client
                    $accessToken = $this->generateToken($client);
                    $client->setAccessToken($accessToken);
                }
            } else {
                // the token doesn't exist, generate a new token and set it to the client
                $accessToken = $this->generateToken($client);
                $client->setAccessToken($accessToken);
            }


            $oauthToken = $accessToken["access_token"];
            return $oauthToken;
        } catch (Exception $e) {
            
        }
        return false;
    }

    //Using a simple file to cache and read the toke, can store it in a databse also
    function readSavedToken() {
        $tk = @file_get_contents('token.cache');
        if ($tk)
            return json_decode($tk, true);
        else
            return false;
    }

    function writeToken($tk) {
        file_put_contents("token.cache", $tk);
    }

    function generateToken($client) {
        $client->fetchAccessTokenWithAssertion();
        $accessToken = $client->getAccessToken();

        $tokenJson = json_encode($accessToken);
        $this->writeToken($tokenJson);

        return $accessToken;
    }
}
