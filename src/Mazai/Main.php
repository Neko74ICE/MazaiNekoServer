<?php

/**
* The MIT License
* Copyright (c) 2018 MazaiCrafty
*/

namespace Mazai;

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

use Mazai\event\Language;

use jojoe77777\FormAPI\FormAPI;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener{

    const VERSION = 1.0;
    const API = '3.0.0-ALPHA11';
    const CODENAME = 'Hosta';

    /** @var $this */
    private static $instance;

    private $economy_api;
    private $form_api;
    
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

        /** API */
        $this->economy_api = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->form_api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
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
        $lang = Language::getLanguage($player);
        switch ($lang){
            case 'ja':
            $player->sendMessage("ようこそ猫鯖へ"); // センスいいのでてこい
            break;

            case 'en':
            $player->sendMessage("Welcome to NekoServer JP");
            break;

            case 'ko':
            $player->sendMessage("NekoServer JP에 오신 것을 환영합니다");
            break;

            case 'zh':
            $player->sendMessage("欢迎来到NekoServer JP");
            break;
        }

        foreach ($this->getServer()->getOnlinePlayers() as $players){
            $event->setJoinMessage("");

            switch ($lang){
                case 'ja':
                $players->sendMessage($player->getName() . "が世界にやってきた");
                break;
    
                case 'en':
                $players->sendMessage($player->getName() . " join the game");
                break;

                case 'ko':
                $players->sendMessage($player->getName() . "는 게임에 참가했습니다");
                break;

                case 'zh':
                $players->sendMessage($player->getName() . "加入了游戏");
                break;
            }
        }
    }

    public function onQuit(PlayerQuitEvent $event): void{
        $player = $event->getPlayer();
        $lang = Language::getLanguage($player);

        foreach ($this->getServer()->getOnlinePlayers() as $players){
            $event->setQuitMessage("");

            switch ($lang){
                case 'ja':
                $players->sendMessage($player->getName() . "が退出しました");
                break;
    
                case 'en':
                $players->sendMessage($player->getName() . " left the game");
                break;

                case 'ko':
                $players->sendMessage($player->getName() . "가 퇴출했습니다");
                break;

                case 'zh':
                $players->sendMessage($player->getName() . "已经离开了");
                break;
            }
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
    * @return EconomyAPI 
    */
    public function getEconomyAPI(): EconomyAPI{
        return $this->economy_api;
    }

    /**
    * @return FormAPI 
    */
    public function getFormAPI(): FormAPI{
        return $this->form_api;
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
