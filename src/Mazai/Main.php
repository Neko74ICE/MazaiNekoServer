<?php

namespace Mazai;

/**
* The MIT License
* Copyright (c) 2018 MazaiCrafty
*/

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerPreLoginEvent;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

use Mazai\command\TestCommand;

class Main extends PluginBase implements Listener{

    const VERSION = 1.0;
    const API = '3.0.0-ALPHA11';
    const CODENAME = 'Hosta';

    /** @var $this */
    private static $instance;
    
    public function onLoad(): void{
        $this->getLogger()->info("プラグインを読み込みます...");
    }

    public function onEnable(): void{
        date_default_timezone_set('Asia/Tokyo');
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->logo();
        $this->getLogger()->info("プラグインを有効にします...");

        if(!file_exists($this->getDataFolder())){
			$this->getLogger()->info("設定ファイルを生成します...");
			@mkdir($this->getDataFolder() , 0777);
			$this->saveResource("Config.yml");
		}
    }

    /**
    * 遊び心でやてしもうた...
    */
    public function logo(): void{
        $this->getLogger()->info(TF::GREEN . "
             JMm,  .+MN,\n
            .NNMN. dMNMN\n
            ,MNNM[ MNNMF\n
         .., WMNM! VMNM!.JNm.\n
        (MNMk ?\"(..,-! .MMMM}\n
        ,NNMM) dNNNMNp (NNNF\n
         (HM`.MMMFTMNN,\"\"'\n
            .gNMD`  -WMNN,\n
          .MNNMF      (MMM}\n
          .MMNMNJ-,    ,NF\n
           TMNMMY\"    ,=
        ");
    }

    public function onJoin(PlayerJoinEvent $event): void{
        $player = $event->getPlayer();
        $lang = $player->getLocale();
        switch ($lang){
            case "ja_JP":
            $player->sendMessage("さてはオメー日本語使いだな");
            break;

            case "en_US":
            $player->sendMessage("You use English");
            break;
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
        switch ($cmd->getName()){
            case "test":
            $test = new TestCommand($sender);
            $test->execute();
            return true;
        }
        return false;
    }

    /**
     * @return $this
     */
    public static function getInstance(){
        if (!self::$instance){
            self::$instance = new Main();
        }
        return self::$instance;
	}

}

