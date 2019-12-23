# JUSebCCK
JUSebCCK - library for SEBLOD (fields and tenplates).

## Global functions

### Bind fields

Save data to cck field:

```php
JUSebCCK\Utils\Data::bind('My new string or data', 'art_title', $config, $fields);
```
**art_title — demo field for documentation*

### Clean cache

Clean all cache from `/cache` folder:

```php
JUSebCCK\Joomla\Cache::clear();
```

Clean cck cache from `/cache/com_cck` folder, `/cache/com_cck/**` and `/cache/com_home`:

```php
JUSebCCK\Joomla\Cache::clear(true);
```