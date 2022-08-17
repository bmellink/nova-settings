<?php

namespace bmellink\NovaSettings\Http\Middleware;


use bmellink\NovaSettings\NovaSettings;

class SettingsPathExists
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        $path = $request->get('path') ?: $request->route('path');
        $path = !empty($path) ? trim($path) : 'general';
        return NovaSettings::doesPathExist($path) ? $next($request) : abort(404);
    }
}
