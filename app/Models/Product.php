<?php

namespace App\Models;

class Product
{

    private string $name;
    private $cost;

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function __construct(String $name, $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }


}
