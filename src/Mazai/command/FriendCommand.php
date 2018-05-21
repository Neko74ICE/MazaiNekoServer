<?php

/**
* The MIT License
* Copyright (c) 2018 MazaiCrafty
*/

namespace Mazai\command;

use pocketmine\Player;

use Mazai\command\Command;

class FriendCommand implements Command{

    private $sender;

    public function __construct(Player $sender){
        $this->sender = $sender;
    }

    public function execute(){

    }
}