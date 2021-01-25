<?php

namespace App\Http\Traits;

trait InvitationCode
{
    protected function generateInvitationCode()
    {
        $randomString = bin2hex(random_bytes(5));

        return substr($randomString, 0, 3)
            . '-'
            . substr($randomString, 3, 4)
            . '-'
            . substr($randomString, 7, 3);
    }
}
