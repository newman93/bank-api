# bank-api
 Uruchomienie aplikacji.

 1. Ustaw połaćzenie do bazy danych
 2. Utwóz bazę danych: php bin/console doctrine:database:create
 3. Uruchom migracje php bin/console doctrine:migrations:migrate
 4. Uruchom server symfony server:start
