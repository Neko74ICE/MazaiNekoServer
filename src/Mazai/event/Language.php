<?php

/**
* The MIT License
* Copyright (c) 2018 MazaiCrafty
*/

namespace Mazai\event;

use pocketmine\Player;

class Language{

    public static function getLanguage(Player $player){
        switch ($player->getLocale()){
            case 'ja_JP':
            return 'ja';

            case 'en_US':
            case 'en_GB':
            return 'en';

            case 'ko_KR':
            return 'ko';

            case 'zh_CN':
            case 'zh_TW':
            return 'zh';

            default:
            return 'en';
        }
    }
}
