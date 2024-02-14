<?php

namespace App\Listeners\Auth;

use App\Events\Auth\TokenFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FailedTokenLog implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  TokenFailed  $event
     * @return void
     */
    public function handle(TokenFailed $event)
    {
        if ($event->token) {
            $event->token->tokenStatistic()->create([
                'date'          => time(),
                'success'       => false,
                'ip_address'    => $event->ip,
                'request'       => $event->request,
            ]);
        }
    }
}
