<?php
/**
 * Copyright (c) 2014 Ebizu Sdn. Bhd.
 */

namespace api\tests\unit\modules\v1\repositories;

use api\modules\v1\repositories\shipment\ArShipmentRepository;
use api\tests\unit\DbTestCase;


/**
 * Active Record Shipment Repository Test
 *
 * @author Budi Irawan <budi@ebizu.com>
 */
class ArShipmentRepositoryTest extends DbTestCase
{
    protected $shipmentRepo;
    
    public function fixtures()
    {
        return [
            //'users' => UserFixture::className()
        ];
    }
    
    public function testFindActiveBids()
    {
        // arrange
        $shipmentId = 5;

        // act
        $activeBids = $this->shipmentRepo->findActiveBidsByShipment($shipmentId);

        // assert
        $this->assertNotEmpty($activeBids);
        $this->assertEquals(count($activeBids), 1);

    }
    
    protected function _before()
    {
        $this->shipmentRepo = new ArShipmentRepository();
    }
}
