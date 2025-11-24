<?php

use App\Mail\infomail;

it('has expected envelope subject and view', function () {
    $m = new infomail;

    $envelope = $m->envelope();
    $content = $m->content();

    expect($envelope->subject)->toBe('Infomail');
    expect($content->view)->toBe('mail');
});
