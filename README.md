# PlayerInfo
A PocketMine Plugin to get a Player Information

## API
we have also provided an API for developers

### Require Import for API
```php
use pedhot\PlayerInfo\API;
```

### Basic usage for API
```php
API::getDevice($player);
API::getOs($player);
API::getPlayerRank($player);
API::getMoney($player);
API::getTotalTime($player);
API::getSessionTime($player);
```
And much more

for ```php getPlayerRank($player); ``` require PurePerms plugin
