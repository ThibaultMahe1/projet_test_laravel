<?php

namespace Tests\PhpFeature;

use App\Mail\infomail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class InfoMailTest extends TestCase
{
    public function test_mail_route_sends_info_mail()
    {
        Mail::fake();

        $response = $this->get('/mail');

        Mail::assertSent(infomail::class, function ($mail) {
            return $mail->hasTo('destinataire@example.com');
        });
    }

    public function test_info_mail_renders_view()
    {
        $mail = new infomail;

        $rendered = $mail->render();

        $this->assertNotEmpty($rendered);
    }
}
