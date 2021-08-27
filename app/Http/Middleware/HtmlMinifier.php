<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HtmlMinifier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (strpos($contentType, 'text/html') !== false) {
            $response->setContent($this->minify($response->getContent()));
        }

        return $response;
    }
    public function minify($input)
    {
        $replace = array(
            '/<!--[^\[](.*?)[^\]]-->/s' => '',
            "/<\?php/"                  => '<?php ',
            "/\n([\S])/"                => ' $1',
            "/\r/"                      => '',
            "/\n/"                      => '',
            "/\t/"                      => ' ',
            "/ +/"                      => ' ',
        );
        return preg_replace(
            array_keys($replace),
            array_values($replace),
            $input
        );
    }
}
