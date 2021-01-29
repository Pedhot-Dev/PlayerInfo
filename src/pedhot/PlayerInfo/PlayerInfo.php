<?php

namespace pedhot\PlayerInfo;

use pedhot\PlayerInfo\command\PlayerInfoCommand;
use pedhot\PlayerInfo\event\EventListener;
use pedhot\PlayerInfo\form\PlayerInfoForm;
use pedhot\PlayerInfo\libs\jojoe77777\FormAPI\SimpleForm;
use pedhot\PlayerInfo\utils\DataManager;
use pedhot\PlayerInfo\utils\Utils;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class PlayerInfo extends PluginBase
{

    public const PREFIX = TextFormat::BOLD.TextFormat::WHITE."PlayerInfo ".TextFormat::BLUE.">> ".TextFormat::RESET;

    private $spoon = [
        SimpleForm::class
    ];

    /** @var PlayerInfo */
    private static $instance;

    /** @var Utils */
    private $utils;

    /** @var PlayerInfoForm */
    private $form;

    /** @var DataManager */
    private $dataManager;

    public static function getInstance(): PlayerInfo {
        return self::$instance;
    }

    public function onLoad() {
        self::$instance = $this;
        @mkdir($this->getDataFolder());
        $this->utils = new Utils();
        $this->dataManager = new DataManager($this);
        $this->form = new PlayerInfoForm();
        $this->saveDefaultConfig();
    }

    public function onEnable() {
        $this->getLogger()->info("Plugin enabled");
        Server::getInstance()->getCommandMap()->register("PlayerInfo", new PlayerInfoCommand($this));
        Server::getInstance()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }

    public function getUtils(): Utils {
        return $this->utils;
    }

    public function getForm(): PlayerInfoForm {
        return $this->form;
    }

    public function getDataManager(): DataManager {
        return $this->dataManager;
    }

}