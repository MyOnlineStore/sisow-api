<?php

namespace Sisow\API;

abstract class Method
{
    /** @var Client */
    private $client;

    /** @var string */
    private $endpoint = 'https://www.sisow.nl/Sisow/iDeal/RestHandler.ashx';

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     * @throws Exception
     */
    public function setEndpoint($endpoint)
    {
        if (!filter_var($endpoint, FILTER_VALIDATE_URL)) {
            throw new Exception('The endpoint must be a valid address (scheme included!)');
        }
        $this->endpoint = $endpoint;
    }

    /**
     * @param array $parameters
     * @return mixed
     */
    protected function execute(array $parameters = array())
    {
        $requestMethod = ltrim(str_replace(get_class(), '', get_called_class()), '\\');
        $testMode = $this->client->getEnviroment() == Client::ENVIRONMENT_TESTING ? 'true' : 'false';
        $parameters = array_merge($parameters, array('testmode' => $testMode));
        $requestResult = $this->curlRequest("{$this->endpoint}/{$requestMethod}?test={$testMode}", $parameters);
        return $this->parseRequestResult($requestResult);
    }

    /**
     * @param $requestResult
     * @return mixed
     * @throws Exception
     */
    private function parseRequestResult($requestResult)
    {
        $dom = new \DOMDocument();
        $dom->loadXML($requestResult);
        $array = call_user_func_array('array_merge', $this->convertXmlToArray($dom));
        if (isset($array['error'], $array['error']['errormessage'], $array['error']['errorcode'])) {
            throw new Exception("[{$array['error']['errorcode']}] {$array['error']['errormessage']}");
        }
        return call_user_func_array('array_merge', $array);
    }

    /**
     * @param \DOMDocument|\DOMElement $dom
     * @return array
     */
    private function convertXmlToArray($dom)
    {
        $result = array();

        if ($dom->hasChildNodes()) {
            $children = $dom->childNodes;
            if ($children->length == 1) {
                $child = $children->item(0);
                if ($child->nodeType == XML_TEXT_NODE) {
                    $result['_value'] = $child->nodeValue;
                    return urldecode(count($result) == 1 ? $result['_value'] : $result);
                }
            }
            $groups = array();
            foreach ($children as $child) {
                if (!isset($result[$child->nodeName])) {
                    $result[$child->nodeName] = $this->convertXmlToArray($child);
                } else {
                    if (!isset($groups[$child->nodeName])) {
                        $result[$child->nodeName] = array($result[$child->nodeName]);
                        $groups[$child->nodeName] = 1;
                    }
                    $result[$child->nodeName][] = $this->convertXmlToArray($child);
                }
            }
        }
        return $result;
    }

    /**
     * @param string $targetUrl
     * @param array $parameters
     * @return string
     * @throws Exception
     */
    private function curlRequest($targetUrl, array $parameters)
    {
        $curlHandler = curl_init($targetUrl);
        curl_setopt($curlHandler, CURLOPT_POST, true);
        curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($curlHandler, CURLOPT_HEADER, false);
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
        $requestResult = curl_exec($curlHandler);
        if (curl_error($curlHandler)) {
            throw new Exception(curl_error($curlHandler), curl_errno($curlHandler));
        }
        curl_close($curlHandler);
        return $requestResult;
    }
} 
