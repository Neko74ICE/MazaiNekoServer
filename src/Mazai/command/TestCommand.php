<?php

/**
* The MIT License
* Copyright (c) 2018 MazaiCrafty
*/

namespace Mazai\command;

use pocketmine\Player;

class TestCommand{

    public function __construct(Player $sender){
        $this->sender = $sender;
    }

    public function execute(){
        if (!$this->sender instanceof Player){
            $this->sender->sendMessage("ゲーム内で実行してください");
            return;
        }

        $this->sender->sendMessage(
            "IP Address: ". $this->sender->getAddress() .
            "\nPing: " . $this->sender->getPing() .
            "\nX座標: " . $this->sender->getX() .
            "\nY座標: " . $this->sender->getY() .
            "\nZ座標: " . $this->sender->getZ()
        );
        return;
    }
}
