# PlayerInfo
A PocketMine Plugin to get a Player Information

## API
we have also provided an API for developers

### Require Import for API
```php
use pedhot\PlayerInfo\API;
```

### Basic API
```php
API::getDevice($player);
API::getOs($player);
API::getPlayerRank($player);
API::getMoney($player);
API::getTotalTime($player);
API::getSessionTime($player);
And much more
```

for ```getPlayerRank($player); getMoney($player); ``` and more,  requires third party plugins
