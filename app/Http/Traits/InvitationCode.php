<?php

namespace App\Http\Traits;

trait InvitationCode
{
    public function generateInvitationCode()
    {
        $randomString = bin2hex(random_bytes(5));

        $invitationCode = substr($randomString, 0, 3)
            . '-'
            . substr($randomString, 3, 4)
            . '-'
            . substr($randomString, 7, 3);

        return $invitationCode;
    }
}
