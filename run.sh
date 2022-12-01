#!/bin/bash
dbname="mydatabase"
dbuser="myself"
dbpassword="mypasswd"
dbhost="localhost"
clientname="MAN"
clientdomain="manan.com"
oldcomname="manny"
clientid="MY001"
clientsecret="MYSECRETID"
clientsecretid="MYSECRETCLIENT"


cd /var/www/
mv manny.com $clientdomain
cd /var/www/$clientdomain/
mv $oldcomname-public  $clientname-public
mv $oldcomname  $clientname
mv $oldcomname-auth-service  $clientname-auth-service 



sed -i s/manny/$clientname/g /var/www/$clientdomain/$clientname-public/index.php
sed -i s/127.132.0.1/$dbhost/g /var/www/$clientdomain/$clientname-auth-service/.env
sed -i s/mannydb/$dbname/g /var/www/$clientdomain/$clientname-auth-service/.env
sed -i s/mannyusr/$dbuser/g /var/www/$clientdomain/$clientname-auth-service/.env
sed -i s/mannypass/$dbpassword/g /var/www/$clientdomain/$clientname-auth-service/.env

sed -i s/MAN001/$clientid/g /var/www/$clientdomain/gateway/application/modules/aeps2/controllers/PaySprintAepsController.php
sed -i s/MAN001/$clientid/g /var/www/$clientdomain/gateway/application/modules/bank/controllers/Axis_bank.php
sed -i s/MAN001/$clientid/g /var/www/$clientdomain/gateway/application/modules/dmtv2/controllers/DmtvtwoController.php
sed -i s/MAN001/$clientid/g /var/www/$clientdomain/gateway/application/modules/dmtv2deactivated/controllers/DmtvtwoController.php
sed -i s/MAN001/$clientid/g /var/www/$clientdomain/gateway/application/modules/matm/controllers/MatmController.php
sed -i s/MAN001/$clientid/g /var/www/$clientdomain/gateway/application/modules/recharge/controllers/RechargeController.php
sed -i s/MAN001/$clientid/g /var/www/$clientdomain/gateway/application/modules/recharge1/controllers/RechargeController.php
sed -i s/MAN001/$clientid/g /var/www/$clientdomain/gateway/application/modules/wallet/controllers/Wallet.php
sed -i s/MAN001/$clientid/g /var/www/$clientdomain/$clientname/application/controllers/Bank.php
sed -i s/MAN001/$clientid/g /var/www/$clientdomain/$clientname/application/controllers/Dmt.php
sed -i s/MAN001/$clientid/g /var/www/$clientdomain/$clientname/application/controllers/Rechargebillpayment.php
 


sed -i s/MANNYSECRETID/$clientsecret/g /var/www/$clientdomain/gateway/application/modules/dmtv2/controllers/DmtvtwoController.php
sed -i s/MANNYSECRETID/$clientsecret/g /var/www/$clientdomain/gateway/application/modules/wallet/controllers/Wallet.php
sed -i s/MANNYSECRETID/$clientsecret/g /var/www/$clientdomain/$clientname/application/controllers/Dmt.php

sed -i s/MANNYCLIENTID/$clientsecretid/g  /var/www/$clientdomain/gateway/application/modules/dmtv2/controllers/DmtvtwoController.php
sed -i s/MANNYCLIENTID/$clientsecretid/g  /var/www/$clientdomain/gateway/application/modules/wallet/controllers/Wallet.php
sed -i s/MANNYCLIENTID/$clientsecretid/g  /var/www/$clientdomain/$clientname/application/controllers/Dmt.php
