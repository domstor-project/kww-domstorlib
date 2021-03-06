<?php

/**
 * Description of DetailDataTest
 *
 * @author pahhan
 */
class DetailDataTest extends PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $array = array('foo' => 1, 'bar' => 2, 'baz' => array());
        $data = new Ds_Detail_DetailData($array);

        $this->assertEquals($data->foo, 1);
        $this->assertEquals($data->get('bar'), 2);


        $this->assertInstanceOf('Ds_Detail_DetailData', $data->baz);
    }
}

