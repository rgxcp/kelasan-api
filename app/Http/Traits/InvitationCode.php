<?php

namespace App\Http\Traits;

trait InvitationCode
{
    protected function generateInvitationCode()
    {
        $randomBytes = bin2hex(random_bytes(5));

        return substr($randomBytes, 0, 3)
            . '-'
            . substr($randomBytes, 3, 4)
            . '-'
            . substr($randomBytes, 7, 3);
    }
}
