<?php

namespace pedhot\PlayerInfo\utils;

use pocketmine\Player;

class Utils
{

    public $playerDevice;
    public $playerOs;

    public function getDevice(Player $player) {
        if(!isset($this->playerDevice[$player->getName()])) return 404;
        if($this->playerDevice[$player->getName()] == null) return 404;
        return $this->playerDevice[$player->getName()];
    }

    public function getOs(Player $player) {
        if(!isset($this->playerOs[$player->getName()])) return 404;
        if($this->playerOs[$player->getName()] == null) return 404;
        $hirss = $this->playerOs[$player->getName()];
        if(is_int($hirss)) return $this->translateVersion($hirss);
        else return $hirss;
    }

    private function translateVersion($fdp){
        switch($fdp){
            case 1:
                $akha = "Android";
                break;
            case 2:
                $akha = "IOS";
                break;
            case 3:
                $akha = "Mac";
                break;
            case 4:
                $akha = "FireOS"; #After forks of pmmp Forks of Android.. By Amazon
                break;
            case 5:
                $akha = "GearVR";
                break;
            case 6:
                $akha = "Hololens";
                break;
            case 7:
                $akha = "Windows_10";
                break;
            case 8:
                $akha = "Windows_32,Educal_version"; # Minecraft help people with learning programmation waaaaw waaaaw And?
                break;
            case 9:
                $akha = "NoName"; #If you have the Name of that send me a mp
                break;
            case 10:
                $akha = "Playstation_4";
                break;
            case 11:
                $akha = "NX"; #NX no name... wollah c vrai
                break;

            default:
                $akha = "Unknown"; # Maybe i missed one
                break;
        }
        return $akha;
    }

}