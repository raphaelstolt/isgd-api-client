<?php
require_once 'PHPUnit/Framework.php';
require_once 'Recordshelf/Service/Isgd.php';
require_once 'Zend/Http/Client/Adapter/Test.php';

class IsgdTest extends PHPUnit_Framework_TestCase
{
    protected $_service = null;

    protected function setUp()
    {
        $this->_service = new Recordshelf_Service_Isgd();
    }
    protected function tearDown()
    {
        $this->_service = null;
    }
    /**
     * @test 
     * @expectedException Zend_ShortUrl_Service_Exception
     */
    public function shouldThrowExceptionWhenInvalidUrlIsGiven()
    {
        $this->_service->shorten('abc');
    }
    /**
     * @test
     */
    public function shouldShortenAGivenUrl()
    {
        $adapter = new Zend_Http_Client_Adapter_Test();
        $client = new Zend_Http_Client('http://is.gd/api.php', array(
            'adapter' => $adapter
        ));
        $adapter->setResponse(
            "HTTP/1.1 200 OK" . "\r\n" .
            "Content-type: text/html" . "\r\n" .
                                       "\r\n" .
            'http://is.gd/1T35Q');
        $this->_service = new Recordshelf_Service_Isgd($client);
        $this->assertEquals('http://is.gd/1T35Q', 
            $this->_service->shorten('http://zendframework.com'));
    }
    /**
     * @test
     * @expectedException Zend_ShortUrl_Service_Exception
     */
    public function shouldThrowExceptionWhenShortenedUrlOfAnotherServiceIsGiven()
    {
        $this->_service->unshorten('http://rubyurl.com/LM84');  
    }
    /**
     * @test
     */
    public function shouldUnshortenAGivenShortenedUrl()
    {
        $adapter = new Zend_Http_Client_Adapter_Test();
        $client = new Zend_Http_Client('http://is.gd/1T35Q', array(
            'adapter' => $adapter
        ));
        $adapter->setResponse(
            "HTTP/1.1 302 Found" . "\r\n" .
            "Location: http://zendframework.com" . "\r\n");
        $this->_service = new Recordshelf_Service_Isgd($client);
        $this->assertEquals('http://zendframework.com', 
            $this->_service->unshorten('http://is.gd/1T35Q'));
    }
}