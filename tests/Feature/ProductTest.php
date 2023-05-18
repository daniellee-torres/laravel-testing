<?php

namespace Tests\Feature;
use App\Models\Product;

class ProductTest extends \PHPUnit\Framework\TestCase {

    public function setUp(): void
    {
        $this->product = new Product('Fallout', 50);
    }

    /**
     * @test
     */
    public function a_product_has_a_name()
    {
        $this->assertEquals('Fallout', $this->product->getName());
    }

    /**
     * @test
     */
    public function a_product_has_a_cost()
    {
        $this->assertEquals('50', $this->product->getCost());
    }
}
