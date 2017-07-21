aHotbar - хотбар для MCPE
=========================

**Для разработчиков**:
```
$hotbar = \AlexBrin\aHotbar::getInstance();

// Тут так же работает дефолтное форматирование. Список замен ниже 

/**
 * Устанавливает собственный формат игроку
 *
 * @param Player|string $player Объект игрока или его ник
 * @param string        $format Новый формат для игрока
 */
$hotbar->setCustomFormat($player, $format);

// Удаляет собственный формат у игрока

/**
 * Удаляет собственный формат у игрока
 *
 * @param Player|string $player Объект игрока или его ник
 */
$hotbar->removeCustomFormat($player);

/**
 * Возвращает собственный формат игрока. null при его отсутствии
 * 
 * @param Player|string $player Объект игрока или его ник
 */
$hotbar->getCustomFormat($player);

/**
 * Возвращает менеджера экономики
 *
 * @return AlexBrin\utils\EconomyManager
 */
$hotbar->getEconomyManager();
```

**Менеджер экономики**
```
/**
 * Отнимает деньги у игрока
 *
 * @param Player|string $player
 * @param integer|float $amount
 */
$economyManager->reduceMoney($player, $amount);

/**
 * Прибавляет деньги игроку
 * 
 * @param Player|string $player
 * @param integer|float $amount
 */
$economyManager->addMoney($player, $amount);

/**
 * Возвращает деньги игрока
 * 
 * @param Player|string $player
 */
$economyManager->getMoney($player);

/**
 * Устанавливает деньги игроку
 * 
 * @param Player|string $player
 * @param integer|float $amount
 */
$economyManager->setMoney($player, $amount);
```

**Замена**:
----
```
{randColor} - случайный цвет
{player} - ник текущего игрока
{onlineP} - количество игроков онлайн
{maxP} - максимальное количество игроков
{balance} - баланс игрока
{group} - группа игрока (PurePerms)
{date} - текущая дата
```

----

aHotbar - hotbar for MCPE
=========================

**For developers**:
```
$hotbar = \AlexBrin\aHotbar::getInstance();

// There also works default formatting. List replacements below

/**
 * Sets the player's own format
 *
 * @param Player|string $player Player object or nickname
 * @param string        $format New format for the player
 */
$hotbar->setCustomFormat($player, $format);

/**
 * Deletes the player's own format
 *
 * @param Player | string $ player Player object or nickname
 */
$hotbar->removeCustomFormat($player);

/**
 * Returns the player's own format. Null in its absence
 *
 * @param Player | string $ player Player object or nickname
 */
$hotbar->getCustomFormat($player);

/**
 * Returns the manager of the economy
 *
 * @return AlexBrin\utils\EconomyManager
 */
$hotbar->getEconomyManager();
```

**Manager of the economy**:
```
/**
 * Grabs money from the player
 *
 * @param Player|string $player
 * @param integer|float $amount
 */
$economyManager->reduceMoney($player, $amount);

/**
 * Adds money to the player
 *
 * @param Player|string $player
 * @param integer|float $amount
 */
$economyManager->addMoney($player, $amount);

/**
 * Returns player money
 *
 * @param Player|string $player
 */
$economyManager->getMoney($player);

/**
 * Sets money to the player
 *
 * @param Player|string $player
 * @param integer|float $amount
 */
$economyManager-> setMoney ($player, $amount);
```

**Replace**:
```
{randColor} - random color
{player} - nick of the current player
{onlineP} - number of players online
{maxP} - maximum number of players
{balance} - player balance
{group} - player group (PurePerms)
{date} - current date
```
