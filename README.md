A custom module for [shiftsst.com](https://shiftsst.com) (Magento 2).  

## How to install
```
bin/magento maintenance:enable
rm -rf composer.lock
composer clear-cache
composer require shiftsst/core:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy \
	--area adminhtml \
	--theme Magento/backend \
	-f en_US
bin/magento setup:static-content:deploy \
	--area frontend \
	--theme Sm/autostore \
	-f en_US
bin/magento maintenance:disable
```

## How to upgrade
```
bin/magento maintenance:enable
composer remove shiftsst/core
rm -rf composer.lock
composer clear-cache
composer require shiftsst/core:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy \
	--area adminhtml \
	--theme Magento/backend \
	-f en_US
bin/magento setup:static-content:deploy \
	--area frontend \
	--theme Sm/autostore \
	-f en_US
bin/magento maintenance:disable
```