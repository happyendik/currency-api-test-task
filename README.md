Currency Api test task

git clone git@github.com:happyendik/currency-api-test-task.git

./init

composer install

common/config/main-local -> db

./yii migrate

./yii currency/refresh-rates
