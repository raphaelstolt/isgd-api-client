isgd-api-client
======
The **isgd-api-client** is a the TDD way developed client to the [is.gd](http://is.gd/api_info.php) API utilizing Zend_ShortUrl_Service_Abstract of the [Zend Framework](http://framework.zend.com/). The is.gd service allows you to shorten URL's.

Requirements
------------
* An installed version of the Zend Framework with the installed/patched in ShortUrl component.

Examples
------------
The following examples show the two edge cases for using the is.gd API programmaticly with the **isgd-api-client**.
#### Usage Example 1:
    
    <?php
    require_once 'Recordshelf/Service/Isgd.php';
    
    $service = new Recordshelf_Service_Isgd();
    $service->shorten('http://zendframework.com'); // http://is.gd/1M9lg
    $service->unshorten('http://is.gd/1M9lg'); // http://zendframework.com 