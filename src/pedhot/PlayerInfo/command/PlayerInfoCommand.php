<?php

namespace pedhot\PlayerInfo\command;

use pedhot\PlayerInfo\form\PlayerInfoForm;
use pedhot\PlayerInfo\PlayerInfo;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class PlayerInfoCommand extends Command
{

    private $cmd = [
        "/pi help" => ""
    ];

    public function __construct(PlayerInfo $main) {
        parent::__construct("playerinfo", "Get Player Information", "Usage: /playerinfo <player name>", []);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$this->testPermission($sender)) return;
        if (!$sender instanceof Player) {
            $sender->sendMessage(PlayerInfo::PREFIX . TextFormat::RED . "Execute this command in game");
            return;
        }
        if (!$sender->hasPermission("playerinfo.command.playerinfo")) {
            $sender->sendMessage(PlayerInfo::PREFIX . TextFormat::RED . "You dont have permission to use this command");
        }
        $form = new PlayerInfoForm();
        if (count($args) !== 1) {
            $form->init($sender);
            return;
        }
        $tn = strtolower($args[0]);
        $target = Server::getInstance()->getPlayer($tn);
        if (!$target instanceof Player) return;
        $form->targetInit($sender, $target);
        return;
    }

}