<?php

namespace App\Models;

class Expression
{
    protected string $expression = '';

    public static function make(): static
    {
        return new static;
    }

    public function find($value)
    {
        $value = preg_quote($value, '/');

        $this->expression .= $value;

        return $this;
    }

    public function then($value): string
    {
        $this->find($value);
        return $this;
    }

    public function anything(string $string)
    {
        $this->expression .= '.*';
        return $this;
    }

    public function maybe(string $string)
    {
        $string = preg_quote($string, '/');
        $this->expression .= '(?:' . $string . ')?';
        return $this;
    }

    public function getRegex()
    {
     return '/'. $this->expression.'/';
    }

    public function __toString()
    {
        return $this->getRegex();
    }

    protected function sanitize($value){
        return preg_quote($value, '/');
    }

    public function test($value)
    {
        return (bool) preg_match($this->getRegex(), $value);
    }
}
