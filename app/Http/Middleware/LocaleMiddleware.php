<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class LocaleMiddleware
{
    public static $mainLanguage = 'ru'; //основной язык, который не должен отображаться в URl

    public static $languages = ['uk', 'ru']; // Указываем, какие языки будем использовать в приложении.

    /*
 * Проверяет наличие корректной метки языка в текущем URL
 * Возвращает метку или значеие null, если нет метки
 */
    public static function getLocale()
    {
        $uri = Request::path(); //получаем URI

        $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"
        //Проверяем метку языка  - есть ли она среди доступных языков
       // print_r($segmentsURI);
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
            return $segmentsURI[0];
        } else {
            return  self::$mainLanguage;
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();
        if($locale) App::setLocale($locale);
        return $next($request);

    }
}
