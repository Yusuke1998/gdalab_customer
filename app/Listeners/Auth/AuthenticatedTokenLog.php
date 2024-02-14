<?php

namespace App\Listeners\Auth;

use App\Events\Auth\TokenAuthenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AuthenticatedTokenLog implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  TokenAuthenticated  $event
     * @return void
     */
    public function handle(TokenAuthenticated $event)
    {
        if ($event->token) {
            $event->token->tokenStatistic()->create([
                'date'          => time(),
                'success'       => true,
                'ip_address'    => $event->ip,
                'request'       => $event->request,
                'response'      => $event->response
            ]);
        }
    }
}
