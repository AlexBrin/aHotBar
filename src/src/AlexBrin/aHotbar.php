<?php

	namespace AlexBrin;

	use pocketmine\plugin\PluginBase;
	use pocketmine\utils\Config;

	use Player;

	use AlexBrin\utils\EconomyManager;

	class aHotbar extends PluginBase {
		private $config,
						$eco;

		public $pureperms;

		public $customFormat = [];

		public function onEnable() {
			if(!is_dir($this->getDataFolder()))
				@mkdir($this->getDataFolder());
			$this->saveDefaultConfig();
			$this->config = (new Config($this->getDataFolder()."config.yml", Config::YAML))->getAll();
			$this->eco = new EconomyManager($this);
			$this->pureperms = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
			date_default_timezone_set($this->config["timeZone"]);
			$offset = intval($this->config["offset"]);
			if($offset < 0) {
				$off = str_pad("", abs($offset), "  ");
				$this->config["text"] = $this->config["text"].$off;
				$this->config["text"] = str_replace('\n', $off."\n", $this->config["text"]);
			} elseif($offset > 0) {
				$off = str_pad("", $offset, "  ");
				$this->config["text"] = $off.$this->config["text"];
				$this->config["text"] = str_replace('\n', "\n".$off, $this->config["text"]);
			} else 
				$this->config["text"] = str_replace('\n', "\n", $this->config["text"]);

			$this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this, $this->config, $this->customFormat), 20);
		}

		/**
		 * Возвращает менеджер экономики
		 * @return EconomyManager 
		 */
		public function getEconomyManager() {
			return $this->eco;
		}

		/**
		 * Вернет ник игрока в нижнем регистре
		 * 
		 * @param  Player|string $player
		 * @return string
		 */
		public function getPlayer($player) {
			if($player instanceof Player)
				$player = $player->getName();

			return mb_strtolower($player);
		}

		/**
		 * Добавляет кастомный формат для конкретного игрока
		 * 
		 * @param Player|string $player
		 * @param string        $format     
		 */
		public function addCustomFormat($player, $format) {
			$player = $this->getPlayer($player);

			$this->customFormat[$player] = $format;
		}

		/**
		 * Удаляет кастомный формат для конкретного игрока
		 * 
		 * @param  Player|string $player 
		 * @return bool                  если удалено - true, иначе - false
		 */
		public function removeCustomFormat($player) {
			$player = $this->getPlayer($player);
			
			if(!isset($this->customFormat[$player]))
				return false;

			unset($this->customFormat[$player]);
			return true;
		}

		/**
		 * Возвращает кастомный формат для игрока
		 * 
		 * @param  Player|string $player 
		 * @return string|null         
		 */
		public function getCustomFormat($player) {
			$player = $this->getPlayer($player);
			return $this->customFormat[$player] ? $this->customFormat[$player] : null;
		}

	}

?>