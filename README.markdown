isgd-api-client
======
The **isgd-api-client** is a the TDD way developed client to the [is.gd](http://is.gd/api_info.php) API utilizing Zend_ShortUrl_Service_Abstract of the [Zend Framework](http://framework.zend.com/). The is.gd service allows you to shorten URL's.

Requirements
------------
* An installed version of the Zend Framework with the installed/patched in Zend_ShortUrl component which currently drowses in the [incubator](http://framework.zend.com/svn/framework/standard/incubator/library/Zend/ShortUrl/).

Examples
------------
The following example shows the two edge cases for using the is.gd API programmaticly with the **isgd-api-client**.
#### Usage Example:
    
    <?php
    require_once 'Recordshelf/Service/Isgd.php';
    
    $service = new Recordshelf_Service_Isgd();
    $service->shorten('http://zendframework.com'); // http://is.gd/1M9lg
    $service->unshorten('http://is.gd/1M9lg'); // http://zendframework.com 