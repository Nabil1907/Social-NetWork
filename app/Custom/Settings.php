<?php

namespace App\Custom;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Settings
{
  protected static $instance;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function getSetting($var){
      return env($var, "N/A");
    }
    /**
     * Protected constructor to prevent creating a new instance of the
     * singleton via the `new` operator.
     */
    protected function __construct()
    {
        // your constructor logic here.
    }

    /**
     * Private clone method to prevent cloning of the instance of the singleton instance.
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the singleton instance.
     */
    private function __wakeup()
    {
    }
}
