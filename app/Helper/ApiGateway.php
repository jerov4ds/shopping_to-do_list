<?php

namespace App\Helper
{

    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Log;

    class ApiGateway {

        public static function getHimsBaseUrl()
        {
            $url = config('app.base_url');

            return rtrim($url, '/') . '/';
        }

        public static function cleanUrl($url)
        {
            return self::getHimsBaseUrl().ltrim($url, '/');
        }

        public static function callBackend($method, $url, $payload=[])
        {
            $url = self::cleanUrl($url);
            if (!is_array($payload)) {
                $payload = [];
            }

            return Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->withOptions([
                'verify' => false,
            ])->{$method}($url, $payload);
        }

        public static function getAction($url, $params=[], $noAuth=false)
        {
            return self::callBackend('GET', $url, $params, $noAuth);
        }

        public static function postAction($url, $payload=[], $noAuth=false)
        {
            return self::callBackend('POST', $url, $payload, $noAuth);
        }

        public static function putAction($url, $payload=[], $noAuth=false)
        {
            return self::callBackend('PUT', $url, $payload, $noAuth);
        }

        public static function deleteAction($url, $payload=[], $noAuth=false)
        {
            return self::callBackend('DELETE', $url, $payload, $noAuth);
        }

        public static function patchAction($url, $payload=[], $noAuth=false)
        {
            return self::callBackend('PATCH', $url, $payload, $noAuth);
        }
    }
}
