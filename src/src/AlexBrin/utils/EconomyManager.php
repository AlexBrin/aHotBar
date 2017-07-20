<?php

	namespace AlexBrin\utils;

	use pocketmine\Player;

	class EconomyManager {
		const DEFAULT_VALUE = '*noEco*';

		private $eco = null;
		
		public function __construct($plugin) {
			$pManager  = $plugin->getServer()->getPluginManager();
			$this->eco = $pManager->getPlugin("EconomyAPI") ?? $pManager->getPlugin("PocketMoney") ?? $pManager->getPlugin("MassiveEconomy") ?? null;
			if($this->eco === null)
				$plugin->getLogger()->warning('§eПлагин на экономику отсутствует');
			else
				$plugin->getLogger()->info('§aНайден плагин на экономику: §d'.$this->eco->getName());
		}

		public function reduceMoney($player, $amount) {
			if($this->isNull())
				return;
			$this->setMoney($player, $this->getMoney($player) - $amount);
		}

		public function addMoney($player, $amount) {
			if($this->isNull())
				return;
			$this->setMoney($player, $this->getMoney($player) + $amount);
		}

		public function getMoney($player) {
			if($this->isNull())
				return self::DEFAULT_VALUE;

			switch(mb_strtolower($this->eco->getName())) {
				case 'economyapi':
						$balance = $this->eco->myMoney($player);
					break;
				default:
						$balance = $this->eco->getMoney($player);
			}

			return $balance;
		}

		public function setMoney(string $player, int $amount) {
			if($this->isNull())
				return;
			$this->eco->setMoney($player, $amount);
		}

		public function isNull() {
			return $this->eco === null;
		}

	}

?>