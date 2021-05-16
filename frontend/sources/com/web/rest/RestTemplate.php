<?php

namespace com\web\rest;

/**
 * Template to make REST requests. Made to look like a Java Rest Template but being more tied to application-specific
 * configuration.
 *
 * @author Andy Gabler
 * @since 2021/05/15
 */
class RestTemplate {

    public $config;

    public function __construct(string $aConfigPath = null) {
        $configPath = $aConfigPath;

        if ($configPath == null) {
            $configPath = dirname(__FILE__) . "\\..\\..\\..\\..\\config\\";
        }

        $environment = parse_ini_file($configPath . "env-config.ini")["env"];
        $this->config = parse_ini_file($configPath . "connection-config.ini", true)[$environment];
    }

    function makeRequest(string $path, $data) {
        $json = json_encode($data);

        $baseUri = $this->config["connHost"] . ":" . $this->config["connPort"];
        $url = $baseUri . $path;

        $curl = curl_init($url);
        curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

        $responseBody = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($responseBody, true);
        return $response;
    }
}
