<?php

namespace Mazai;

/**
* The MIT License
* Copyright (c) 2018 MazaiCrafty
*/

use Mazai\Main;

class Provider{

    private $config;

    public static function getConfig(string $str){
        $config = new Config(Main::getInstance()->getDataFolder() . "Config.yml", Config::YAML);
        return $config->get($str);
    }

}
