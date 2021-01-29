<?php

namespace pedhot\PlayerInfo\form;

use pedhot\PlayerInfo\libs\jojoe77777\FormAPI\SimpleForm;
use pedhot\PlayerInfo\PlayerInfo;
use pocketmine\Player;
use pocketmine\Server;

class PlayerInfoForm
{

    /** @var array */
    private $selectedPlayer = [];

    public function init(Player $player) {
        $form = new SimpleForm(function (Player $player, $data = null){
            if ($data == null && $data == "Exit"){
                return;
            }
            $target = Server::getInstance()->getPlayer($data);
            $this->targetInit($player, $target);
        });
        $form->setTitle("Player Info");
        foreach (Server::getInstance()->getOnlinePlayers() as $onlinePlayer){
            $form->addButton($onlinePlayer->getName(), 0, "textures/ui/FriendsIcon", $onlinePlayer->getName());
        }
        $form->addButton("Exit", 0, "textures/blocks/barrier", "Exit");
        $form->sendToPlayer($player);
    }

    public function targetInit(Player $player, Player $target = null) {
        $form = new SimpleForm(function (Player $player, $data = null) use ($target){
            if ($data == null){
                return;
            }
            if ($data == 0){
                $this->init($player);
            }
        });
        $form->setTitle($target->getName() . "'s Info");
        $form->setContent("Od: " . PlayerInfo::getInstance()->getUtils()->getOs($target) . "\nDevice: " . PlayerInfo::getInstance()->getUtils()->getDevice($target));
        $form->addButton("Back", 0, "textures/blocks/barrier", "Back");
        $form->sendToPlayer($player);
    }

}