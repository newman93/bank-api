# bank-api
Launching the application

 1. Set the connection to the database
 2. Create a database: php bin/console doctrine:database:create
 3. Run migrations: php bin/console doctrine:migrations:migrate
 4. Start the server: server symfony server:start

Methods
- /api/create/account/{pin}
Create an account with pin
- /api/operation/{operation}/cash/{cash}/number/{number}/pin/{pin}
operation {1} add cash to the account
operation {-1} get cash from the account
- /api/account/history/number/{number}/pin/{pin}
Get account history. Enter the number adn pin

Command
- php bin/console app:account-history
Get account history. Enter the number adn pin
