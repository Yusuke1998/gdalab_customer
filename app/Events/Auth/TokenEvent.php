<?php

namespace App\Events\Auth;

class TokenEvent
{
    /**
     * The authenticated token.
     *
     * @var \App\Models\Token
     */
    public $token;

    /**
     * The data to persist to mem.
     *
     * @var array
     */
    public $request = [];

    /**
     * The data to persist to mem.
     *
     * @var array
     */
    public $response = [];

    /**
     * The IP address of the client
     * @var string $ip
     */
    public $ip;

    /**
     * Create a new event instance.
     *
     * @param  string  $ip
     * @param  \App\Models\Token $token
     * @param  array $request
     * @param  array $response
     * @return void
     */
    public function __construct($ip, $token, $request, $response)
    {
        $this->ip = $ip;
        $this->token = $token;
        $this->request = $request;
        $this->response = $response;
    }
}
