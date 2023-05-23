<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Mail;

class ExampleTest extends TestCase
{
    public function createApplication()
    {
        $app = require '/Users/danielletorres/Documents/lumiio/laravel-testing/bootstrap/app.php';
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        return $app;
    }

    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
    }

    /**
     * @test
     */
    public function email_test()
    {
        Mail::raw('Hello World', function ($message) {
            $message->to('foo@bar.com');
            $message->from('bar@foo.com');
        });

        Mail::assertSent(function (\Illuminate\Mail\Mailable $mail) {
            return $mail->hasTo('foo@bar.com') &&
                $mail->hasFrom('bar@foo.com');
        });
    }
}
