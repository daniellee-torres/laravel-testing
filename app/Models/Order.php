<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    private array $products = [];

    public function __construct()
    {
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function add($products): void
    {
        $this->products[] = $products;
    }

    public function getTotal()
    {
        return array_reduce($this->products, function($carry, $product){
            return $carry + $product->getCost();
        });
    }


}
