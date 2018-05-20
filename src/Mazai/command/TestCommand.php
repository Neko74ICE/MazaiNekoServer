<?php

/**
 * The MIT License
 * Copyright (c) 2018 MazaiCrafty
 */

namespace Mazai\command;

use pocketmine\Player;

class Test{

    public function __construct(Player $sender){
        $this->sender = $sender;
    }

    public function execute(){
        $sender->sendMessage(
            "IP Address: ". $this->sender->getAddress() .
            "\nPing: " . $this->sender->getPing() .
            "\nX座標: " . $this->sender->getX() .
            "\nY座標: " . $this->sender->getY() .
            "\nZ座標: " . $this->sender->getZ()
        );
    }
}
