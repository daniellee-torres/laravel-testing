<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;

class OrderTest extends \PHPUnit\Framework\TestCase{

    /**
     * @test
     */
    public function an_order_is_composed_of_products()
    {
        $order = $this->create_order_with_products();
        $this->assertCount(2, $order->getProducts());
    }

    /**
     * @test
     */
    public function an_order_can_determine_the_total_cost_of_its_products()
    {
        $order = $this->create_order_with_products();
        $this->assertEquals(75, $order->getTotal());
    }

    public function create_order_with_products()
    {
        $order = new Order;

        $product1 = new Product('Fallout 1', 25);
        $product2 = new Product('Fallout 4', 50);

        $order->add($product1);
        $order->add($product2);

        return $order;
    }

}
