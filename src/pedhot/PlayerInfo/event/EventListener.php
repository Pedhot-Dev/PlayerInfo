<?php

namespace pedhot\PlayerInfo\event;

use pedhot\PlayerInfo\PlayerInfo;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\Player;

class EventListener implements Listener
{

    /** @var PlayerInfo */
    private $plugin;

    public function __construct(PlayerInfo $plugin) {
        $this->plugin = $plugin;
    }

    public function onPacketReceived(DataPacketReceiveEvent $event) {
        if($event->getPacket() instanceof LoginPacket){
            if($event->getPacket()->clientData["DeviceOS"] !== null){
                PlayerInfo::getInstance()->getUtils()->playerOs[$event->getPacket()->username] = $event->getPacket()->clientData["DeviceOS"];
                PlayerInfo::getInstance()->getUtils()->playerDevice[$event->getPacket()->username] = $event->getPacket()->clientData["DeviceModel"];
            }
        }
    }

    public function onDamage(EntityDamageEvent $event) {
        $config = PlayerInfo::getInstance()->getConfig();
        if ($event instanceof EntityDamageByEntityEvent) {
            $event->setCancelled($config->getNested("hit-ui.enabled"));
            $damager = $event->getDamager();
            $victim = $event->getEntity();
            if ($damager instanceof Player && $victim instanceof Player) {
                if ($config->getNested("hit-ui.enabled") == true && $config->getNested("hit-ui.world-name") == $damager->getLevel()->getFolderName()) {
                    PlayerInfo::getInstance()->getForm()->targetInit($damager, $victim);
                }
            }
        }
    }

}