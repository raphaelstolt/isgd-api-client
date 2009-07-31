<?php
require_once 'Zend/ShortUrl/Service/Abstract.php';

class Recordshelf_Service_Isgd extends Zend_ShortUrl_Service_Abstract
{
    /**
     * Base URI of the shortening service
     *
     * @var string
     */
    protected $_baseUri = 'http://is.gd';

    /**
     * Constructor allowing to inject a new client and adapter
     *
     * @param Zend_Http_Client $client Zend_Http_Client with possible attached
     * adapter
     */
    public function __construct(Zend_Http_Client $client = null)
    {
        if (!is_null($client)) {
            $this->setHttpClient($client);
        }
    }

    /**
     * Shortens long URL
     *
     * @param string $url URL to Shorten
     * @throws Zend_ShortUrl_Service_Exception
     * @return string
     */
    public function shorten($url)
    {
        $this->_validateUri($url);
        $serviceUri = "{$this->_baseUri}/api.php";
        $this->getHttpClient()->setUri($serviceUri);
        $this->getHttpClient()->setParameterGet('longurl', $url);
        $response = $this->getHttpClient()->request();
        return $response->getBody();
    }
    /**
     * Determine original URL for a is.gd shortend URL
     *
     * @param string $shortenedUrl is.gd shortend URL
     * @throws Zend_ShortUrl_Service_Exception
     * @return string
     */
    public function unshorten($shortenedUrl)
    { 
        $this->_validateUri($shortenedUrl);
        $this->_verifyBaseUri($shortenedUrl);
        $this->setHttpClient(new Zend_Http_Client($shortenedUrl));
        $this->getHttpClient()->setConfig(array('strictredirects' => true));
        $response = $this->getHttpClient()->request();
        return str_replace(':' . $this->getHttpClient()->getUri()->getPort(), '', 
            $this->getHttpClient()->getUri(true));
    }
}