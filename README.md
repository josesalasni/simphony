# Dependencies
- PHP 7.4 
- MongoDB Driver
- Composer 2.2.9

# Instructions
- Install the tools required
- Clone the Repository to your local
- run command ``Composer Install``
- run the command ``php bin/console doctrine:mongodb:schema:create`` to create MongoDB collections.
- run the command ``php bin/console app:create-user `` to insert fake data in MongoDB.
- run ``NPM install`` & ``NPM run-script dev`` to compile the JS Encore.
- Finally run ``Symfony server:start``.
