# bank-api
Launching the application <br />

 1. Set the connection to the database <br />
 2. Create a database: php bin/console doctrine:database:create <br />
 3. Run migrations: php bin/console doctrine:migrations:migrate <br />
 4. Start the server: server symfony server:start <br />

Methods <br />
- /api/create/account/{pin} <br />
Create an account with pin <br />
- /api/operation/{operation}/cash/{cash}/number/{number}/pin/{pin} <br />
operation {1} add cash to the account <br />
operation {-1} get cash from the account <br />
- /api/account/history/number/{number}/pin/{pin} <br />
Get account history. Enter the number and pin <br />

Command <br />
- php bin/console app:account-history <br />
Get account history. Enter the number and pin
