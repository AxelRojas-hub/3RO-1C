<?php
class CookieManager
{
    public static function get($key, $default = null)
    {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }
        return $default;
    }

    public static function getInt($key, $default = 0)
    {
        if (isset($_COOKIE[$key]) && is_numeric($_COOKIE[$key])) {
            return intval($_COOKIE[$key]);
        }
        return $default;
    }

    public static function set($key, $value, $expire = 0, $path = "/")
    {
        setcookie($key, $value, $expire, $path);
        $_COOKIE[$key] = $value;
    }

    public static function delete($key, $path = "/")
    {
        setcookie($key, '', time() - 3600, $path);
        unset($_COOKIE[$key]);
    }

    public static function resetGameCookies($puntaje = 10, $intentos = 0, $nroPartida = 1)
    {
        self::set('puntaje', $puntaje);
        self::set('intentos', $intentos);
        self::set('partidas', $nroPartida);
    }
}
