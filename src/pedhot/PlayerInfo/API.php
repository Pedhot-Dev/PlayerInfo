<?php

namespace pedhot\PlayerInfo;

use pocketmine\Player;

class API
{

    public static function getDevice(Player $player) {
        return PlayerInfo::getInstance()->getUtils()->getDevice($player);
    }

    public static function getOs(Player $player) {
        return PlayerInfo::getInstance()->getUtils()->getOs($player);
    }

}