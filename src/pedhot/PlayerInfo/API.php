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

    public static function getPlayerRank(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getPlayerRank($player);
    }

    public static function getPlayerMoney(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getPlayerMoney($player);
    }

    public static function getSuffix(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getSuffix($player);
    }

    public static function getPrefix(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getPrefix($player);
    }

    public static function getRankUpRank(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getRankUpRank($player);
    }

    public static function getRankUpRankPrice(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getRankUpRankPrice($player);
    }

    public static function getPlayerFaction(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getPlayerFaction($player);
    }

    public static function getFactionPower(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getFactionPower($player);
    }

    public static function getPlayerKillToDeathRatio(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getPlayerKillToDeathRatio($player);
    }

    public static function getPlayerKill(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getPlayerKills($player);
    }

    public static function getPlayerDeath(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getPlayerDeaths($player);
    }

    public static function getIslandBlock(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getIsleBlocks($player);
    }

    public static function getIslandSize(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getIsleSize($player);
    }

    public static function getIslandRank(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getIsleRank($player);
    }

    public static function getIslandMember(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getIsleMembers($player);
    }

    public static function getIslandState(Player $player) {
        return PlayerInfo::getInstance()->getDataManager()->getIsleState($player);
    }

}