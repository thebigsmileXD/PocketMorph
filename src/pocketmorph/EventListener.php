<?php

namespace pocketmorph;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\math\Vector3;
use pocketmorph\PocketMorph;
use pocketmorph\morph\Morph;
use pocketmine\player\Player;

class EventListener implements Listener {
	
	private $plugin;
	
	public function __construct(PocketMorph $plugin) {
		$this->plugin = $plugin;	
	}
	
	private function getPlugin() {
		return $this->plugin;
	}
	
	public function onDamage(EntityDamageEvent $event) {
		if($event->getEntity() instanceof Morph) {
			$event->setCancelled(true);
			if($entity instanceof Player){
				$event->setCancelled(false);
			}
		}
	}
	
	public function onQuit(PlayerQuitEvent $event) {
		$player = $event->getPlayer();
		
		if($this->getPlugin()->getMorphManager()->isMorphed($player)) {
			$this->getPlugin()->getMorphManager()->removeMorph($player);
		}
	}
	
	public function onMove(PlayerMoveEvent $event) {
		
		$player = $event->getPlayer();
		
		if($this->getPlugin()->getMorphManager()->isMorphed($player)) {
			$morph = $this->getPlugin()->getMorphManager()->getMorph($player);
			
			$this->getPlugin()->getMorphManager()->moveEntity($player, $morph->getId());
		}
	}
}
