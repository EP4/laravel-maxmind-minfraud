<?php

namespace IC\Laravel\MaxMindMinFraud\Middleware;

use Closure;
use Exception;
use Error;

use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;

use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;

class MaxMindMinFraud
{
    /**
     * The App container
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new middleware instance.
     *
     * @param  Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $fraudDetection = $this->container['maxmind.minfraud'];

        $input = $request->input();

        $mfRequest = $fraudDetection->withDevice([
            'ip_address' => $request->ip()
        ]);

        $insightsResponse = $mfRequest->insights();

        if ($insightsResponse->riskScore > 30) {
            throw new PreconditionFailedHttpException('This transaction has been flagged as fraudulent.');
        }

        return $next($request);
    }
}
