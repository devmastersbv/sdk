<?php

class ServiceTest extends PHPUnit_Framework_TestCase
{
    private $testApiResult;

    protected function setUp()
    {
        $this->testApiResult = file_get_contents(__DIR__.'/dummyData/getService.json');
        \Paynl\Config::setServiceId('SL-1234-5678');
        \Paynl\Config::setApiToken('123456789012345678901234567890');
        $curl = new \Paynl\Curl\Dummy();
        $curl->setResult($this->testApiResult);
        \Paynl\Config::setCurl($curl);
    }

    public function testGetService(){
      $request = (new \Paynl\Api\Transaction\GetService())->doRequest();
      $this->assertNotEmpty($request['service']['basePath']);
    }
}
