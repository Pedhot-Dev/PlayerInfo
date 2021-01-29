<?php

namespace pedhot\PlayerInfo\form;

use pedhot\PlayerInfo\API;
use pedhot\PlayerInfo\libs\jojoe77777\FormAPI\SimpleForm;
use pocketmine\Player;
use pocketmine\Server;

class PlayerInfoForm
{

    public function init(Player $player) {
        $form = new SimpleForm(function (Player $player, $data = null){
            if ($data == null){
                return;
            }
            if ($data == "Exit"){
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
        });
        $form->setTitle($target->getName() . "'s Info");
        $form->setContent(
            "Os: " . API::getOs($target) .
            "\nDevice: " . API::getDevice($target) .
            "\nRank: " . API::getPlayerRank($target) .
            "\nMoney: " . API::getPlayerMoney($target));
        $form->addButton("Exit", 0, "textures/blocks/barrier");
        $form->sendToPlayer($player);
    }

}