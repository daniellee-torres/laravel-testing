<?php

namespace Tests\Feature;

use App\Models\Expression;
use Tests\TestCase;

class ExpressionTest extends TestCase
{
    /**
     * @test
     */
    public function it_finds_a_string()
    {
        $regex = Expression::make()->find('www');
        $this->assertTrue($regex->test('www'));
    }

    /**
     * @test
     */
    public function it_checks_for_anything()
    {
        $regex = Expression::make()->anything('foo');
        $this->assertMatchesRegularExpression((string)$regex, 'foo');
    }

    /**
     * @test
     */
    public function it_maybe_has_a_value()
    {
        $regex = Expression::make()->maybe('http');

        $this->assertTrue($regex->test('http'));
        $this->assertTrue($regex->test(''));
    }

    /**
     * @test
     */
    public function it_can_chain_method_calls()
    {
        $regex = Expression::make()->find('www')->maybe('.')->then('laracasts');
        $this->assertTrue($regex->test('www.laracasts'));
        $this->assertTrue($regex->test('wwwXlaracasts'));
    }
}
