<?php

namespace pedhot\PlayerInfo\utils;

use _64FF00\PurePerms\PurePerms;
use FactionsPro\FactionMain;
use JackMD\KDR\KDR;
use onebone\economyapi\EconomyAPI;
use pedhot\PlayerInfo\PlayerInfo;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use rankup\RankUp;
use room17\SkyBlock\island\RankIds;
use room17\SkyBlock\SkyBlock;
use Zedstar16\OnlineTime\Main;

class DataManager
{
    /** @var PlayerInfo */
    private $plugin;

    /** @var SkyBlock */
    private $skyBlock;
    /** @var EconomyAPI */
    private $economyApi;
    /** @var FactionMain */
    private $factionsPro;
    /** @var KDR */
    private $kdr;
    /** @var PurePerms */
    private $purePerms;
    /** @var Main */
    private $onlineTime;
    /** @var RankUp */
    private $rankUp;
    /** @var \RedCraftPE\RedSkyBlock\SkyBlock */
    private $redSkyBlock;
    /** @var \Itzdvbravo\BravoClan\Main */
    private $bravoClan;

    public function __construct(PlayerInfo $plugin) {
        $this->plugin = $plugin;
        $this->skyBlock = Server::getInstance()->getPluginManager()->getPlugin("SkyBlock");
        $this->economyApi = Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI");
        $this->factionsPro = Server::getInstance()->getPluginManager()->getPlugin("FactionsPro");
        $this->kdr = Server::getInstance()->getPluginManager()->getPlugin("KDR");
        $this->onlineTime = Server::getInstance()->getPluginManager()->getPlugin("OnlineTime");
        $this->purePerms = Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
        $this->rankUp = Server::getInstance()->getPluginManager()->getPlugin("RankUp");
        $this->redSkyBlock = Server::getInstance()->getPluginManager()->getPlugin("RedSkyBlock");
        $this->bravoClan = Server::getInstance()->getPluginManager()->getPlugin("BravoClan");
    }

    /**
     * @param Player $player
     * @return bool|float|string
     */
    public function getPlayerMoney(Player $player) {
        if ($this->economyApi instanceof EconomyAPI){
            return number_format($this->economyApi->myMoney($player));
        }else{
            return "plugin not found";
        }
    }

    /**
     * @param Player $player
     * @return mixed|string
     */
    public function getPlayerRank(Player $player) {
        if ($this->purePerms instanceof PurePerms) {
            $group = $this->purePerms->getUserDataMgr()->getData($player)['group'];
            if($group !== null){
                return $group;
            }else{
                return "No Rank";
            }
        }else{
            return "plugin not found";
        }
    }

    /**
     * @param Player $player
     * @return bool|int|string
     */
    public function getRankUpRank(Player $player) {
        if ($this->rankUp instanceof RankUp) {
            $group = $this->rankUp->getRankUpDoesGroups()->getPlayerGroup($player);
            if($group !== false){
                return $group;
            }else{
                return "No Rank";
            }
        }else{
            return "plugin not found";
        }
    }

    /**
     * @param Player $player
     * @return mixed|string
     */
    public function getRankUpRankPrice(Player $player) {
        if ($this->rankUp instanceof RankUp) {
            $nextRank = $this->rankUp->getRankStore()->getNextRank($player);
            if($nextRank !== false){
                return $nextRank->getPrice();
            }else{
                return "Max Rank";
            }
        }else{
            return "plugin not found";
        }
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getPlayerFaction(Player $player): string {
        if ($this->factionsPro instanceof FactionMain) {
            $factionName = $this->factionsPro->getPlayerFaction($player->getName());
            if($factionName === null){
                return "No Faction";
            }
            return $factionName;
        }else{
            return "plugin not found";
        }
    }

    public function getFactionPower(Player $player){
        if($this->factionsPro instanceof FactionMain){
            $factionName = $this->factionsPro->getPlayerFaction($player->getName());
            if($factionName === null){
                return "No Faction";
            }
            return $this->factionsPro->getFactionPower($factionName);
        }else{
            return "plugin not found";
        }
    }

    /**
     * @param Player $player
     * @return int|string
     */
    public function getPlayerKills(Player $player){
        if($this->kdr instanceof KDR){
            return $this->kdr->getProvider()->getPlayerKillPoints($player);
        }else{
            return "plugin not found";
        }
    }

    /**
     * @param Player $player
     * @return int|string
     */
    public function getPlayerDeaths(Player $player){
        if($this->kdr instanceof KDR){
            return $this->kdr->getProvider()->getPlayerDeathPoints($player);
        }else{
            return "plugin not found";
        }
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getPlayerKillToDeathRatio(Player $player): string{
        if($this->kdr instanceof KDR){
            return $this->kdr->getProvider()->getKillToDeathRatio($player);
        }else{
            return "plugin not found";
        }
    }

    public function getPrefix(Player $player, $levelName = null): string{
        if($this->purePerms instanceof PurePerms){
            $prefix = $this->purePerms->getUserDataMgr()->getNode($player, "prefix");
            if($levelName === null){
                if(($prefix === null) || ($prefix === "")){
                    return "No Prefix";
                }
                return (string) $prefix;
            }else{
                $worldData = $this->purePerms->getUserDataMgr()->getWorldData($player, $levelName);
                if(empty($worldData["prefix"]) || $worldData["prefix"] == null){
                    return "No Prefix";
                }
                return $worldData["prefix"];
            }
        }else{
            return "plugin not found";
        }
    }

    /**
     * @param Player $player
     * @param null   $levelName
     * @return string
     */
    public function getSuffix(Player $player, $levelName = null): string{
        if($this->purePerms instanceof PurePerms){
            $suffix = $this->purePerms->getUserDataMgr()->getNode($player, "suffix");
            if($levelName === null){
                if(($suffix === null) || ($suffix === "")){
                    return "No Suffix";
                }
                return (string) $suffix;
            }else{
                $worldData = $this->purePerms->getUserDataMgr()->getWorldData($player, $levelName);
                if(empty($worldData["suffix"]) || $worldData["suffix"] == null){
                    return "No Suffix";
                }
                return $worldData["suffix"];
            }
        }else{
            return "plugin not found";
        }
    }

    /**
     * @param Player $player
     * @return int|string
     */
    public function getIsleBlocks(Player $player){
        if($this->skyBlock instanceof SkyBlock){
            $session = $this->skyBlock->getSessionManager()->getSession($player);
            if((is_null($session)) || (!$session->hasIsland())){
                return "No Island";
            }
            $isle = $session->getIsland();
            return $isle->getBlocksBuilt();
        }else{
            return "plugin Not Found";
        }
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getIsleSize(Player $player){
        if($this->skyBlock instanceof SkyBlock){
            $session = $this->skyBlock->getSessionManager()->getSession($player);
            if((is_null($session)) || (!$session->hasIsland())){
                return "No Island";
            }
            $isle = $session->getIsland();
            return $isle->getCategory();
        }else{
            return "plugin Not Found";
        }
    }

    /**
     * @param Player $player
     * @return int|string
     */
    public function getIsleMembers(Player $player){
        if($this->skyBlock instanceof SkyBlock){
            $session = $this->skyBlock->getSessionManager()->getSession($player);
            if((is_null($session)) || (!$session->hasIsland())){
                return "No Island";
            }
            $isle = $session->getIsland();
            return count($isle->getMembers());
        }else{
            return "plugin Not Found";
        }
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getIsleState(Player $player){
        if($this->skyBlock instanceof SkyBlock){
            $session = $this->skyBlock->getSessionManager()->getSession($player);
            if((is_null($session)) || (!$session->hasIsland())){
                return "No Island";
            }
            $isle = $session->getIsland();
            return $isle->isLocked() ? "Locked" : "Unlocked";
        }else{
            return "plugin Not Found";
        }
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getIsleRank(Player $player){
        if($this->skyBlock instanceof SkyBlock){
            $session = $this->skyBlock->getSessionManager()->getSession($player);
            if((is_null($session)) || (!$session->hasIsland())){
                return "No Island";
            }
            switch($session->getRank()){
                case RankIds::MEMBER;
                    return "Member";
                case RankIds::OFFICER;
                    return "Officer";
                case RankIds::LEADER;
                    return "Leader";
                case RankIds::FOUNDER;
                    return "Founder";
            }
            return "No Rank";
        }else{
            return "plugin Not Found";
        }
    }

}