<?php
require_once 'PHPUnit/Framework.php';
require_once 'Recordshelf/Service/Isgd.php';

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
        $this->assertEquals('http://is.gd/1NOQ8', 
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
        $this->assertEquals('http://zendframework.com', 
            $this->_service->unshorten('http://is.gd/1NOQ8'));
    }
}