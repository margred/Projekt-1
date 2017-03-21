<?php

namespace HAWMS\http;

class RequestFactory
{

    /**
     * @return Request
     */
    public function createRequest()
    {
        $request = new Request([
            'uri' => $this->normalizeUri(),
            'params' => $_GET,
            'body' => $_POST,
            'method' => isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET'
        ]);
        return $request;
    }

    private function normalizeUri()
    {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return '/' . trim($uri, '/');
    }
}
