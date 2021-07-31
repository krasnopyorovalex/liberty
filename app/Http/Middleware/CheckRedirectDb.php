<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Domain\Redirect\Queries\GetRedirectByUriQuery;
use App\Models\Redirect;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class CheckRedirectDb
 * @package App\Http\Middleware
 */
class CheckRedirectDb
{
    use DispatchesJobs;

    /**
     * @param $request
     * @param Closure $next
     * @return Application|RedirectResponse|Redirector|mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * @var $existedInDb Redirect
         */
        $existedInDb = $this->dispatch(new GetRedirectByUriQuery($request->getRequestUri()));

        if ($existedInDb) {
           return redirect($existedInDb->url_new, 301);
        }

        if ((strpos($request->getPathInfo(), '//') !== false) || (substr($request->getPathInfo(), -1) == '/' && $request->getPathInfo() != '/')) {

            $actualUrl = preg_replace("/\/+/","/", $request->getPathInfo());

            if( substr($actualUrl, -1) == '/' ){
                while( substr($actualUrl, -1) == '/' ){
                    $actualUrl = substr($actualUrl, 0, -1);
                }
            }
            return redirect($actualUrl, 301);
        }

        if (strstr($request->fullUrl(), 'index.')) {
            $actualUrl = preg_replace('#index\.(\w)*(\/)?#', '', $request->fullUrl());
            return redirect($actualUrl, 301);
        }

        return $next($request);
    }
}
