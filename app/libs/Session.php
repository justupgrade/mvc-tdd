<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 19.12.15
 * Time: 20:56
 */

class Session
{
    static public function init()
    {
        if (!isset($_SESSION))
        {
            // If we are run from the command line interface then we do not care
            // about headers sent using the session_start.
            if (PHP_SAPI === 'cli')
            {
                $_SESSION = array();
            }
            elseif (!headers_sent())
            {
                if (!session_start())
                {
                    throw new Exception(__METHOD__ . 'session_start failed.');
                }
            }
            else
            {
                throw new Exception(
                    __METHOD__ . 'Session started after headers sent.');
            }
        }
    }

    static public function set($key, $value)
    {
        $_SESSION[$key] = serialize($value);
    }

    static public function get($key)
    {
        return isset($_SESSION[$key]) ? unserialize($_SESSION[$key]) : null;
    }
}