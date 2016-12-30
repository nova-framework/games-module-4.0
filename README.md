# games-module-4.0
Module for Nova 4 to list and manage games

To install this module download and zip and place the Games folder into app/Modules.

Next tell Nova about the new module:

```php
php forge module:optimize
```

Next run the migrations to create the tables:

```php
php forge module:migrate games
```

Next run the seeds which populate the games type table.

```php
php forge module:seed games
```

That's it now going to /games will show the front end games list and in the admin there is a games section listed in the sidebar.
