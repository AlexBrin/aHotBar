<?php

	namespace AlexBrin;

	use pocketmine\scheduler\PluginTask;

	use AlexBrin\aHotbar;

	class Task extends PluginTask {
		/**
		 * Конфиг плагина
		 * 
		 * @var pocketmine\utils\Config @config
		 */
		private $config;

		/**
		 * Все цвета Minecraft
		 * 
		 * @var array
		 */
		public static $colors = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'];
		
		/**
		 * Названия месяцев на английском
		 * @var array $monthEn
		 */
		public static $monthEn = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

		/**
		 * Названия месяцев на русском
		 * @var array $monthRu
		 */
		public static $monthRu = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];

		/**
		 * Текст для конфига. В дальнейшем заменяется на символы форматирования даты
		 * @var array $formatCfg
		 */
		public static $formatCfg = ['число', 'месяц', 'год', 'час', 'минута', 'секунда'];

		public function __construct($plugin, $config, &$customFormat) {
			parent::__construct($plugin);
			$this->config = $config;
			$this->customFormat = $customFormat;
		}

		public function onRun($tick) {
			switch($this->config['monthFormat']) {
				case 1:
						$month = 'm';
					break;
				case 2:
				case 3:
						$month = 'F';
					break;
			}
			$dateFormat = str_replace(static::$formatCfg, ['d', $month, 'Y', 'H', 'm', 's'], $this->config['dateFormat']);
			$date = date($dateFormat);

			if($this->config['monthFormat'] == 3)
				$date = str_replace(static::$monthEn, static::$monthRu, $date);

			$plugin = $this->getOwner();
			$server = $plugin->getServer();

			$online = $server->getOnlinePlayers();
			$onlineCount = count($online);
			$maxPlayers = $server->getMaxPlayers();

			$eco = $plugin->getEconomyManager();

			foreach($online as $player) {
				$name = $player->getName();
				$lowerName = mb_strtolower($name);

				if(isset($this->customFormat[$lowerName]))
					$text = $this->customFormat[$lowerName];
				else
					$text = $this->config['text'];

				$balance = $eco->getMoney($lowerName);

				if($plugin->pureperms)
					$group = $plugin->pureperms->getUserDataMgr()->getGroup($player)->getName();
				else
					$group = '*noGroup*';

				$text = str_replace("\\n", "\n", $text);
				$text = str_replace("{randColor}", "§".static::$colors[array_rand(static::$colors)], $text);
				$text = str_replace("{player}", $player->getName(), $text);
				$text = str_replace("{onlineP}", $onlineCount, $text);
				$text = str_replace("{maxP}", $maxPlayers, $text);
				$text = str_replace("{balance}", $balance, $text);
				$text = str_replace("{group}", $group, $text);
				$text = str_replace("{date}", $date, $text);
				$player->sendPopup($text);
			}
		}

	}

?>