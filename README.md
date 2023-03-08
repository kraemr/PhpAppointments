# PhpAppointments

For Setup download PHP, Mariadb and a webserver for php.
On Ubuntu/Debian:
```
sudo apt install mariadb-server mariadb-client php8.1 php8.1-mysql
```


Enter the mariadb client and execute:

```
\. PATH_TO/setup.sql
```
Now the Database is setup.
For testing you can use the PHP development server like so:
```
php -S 0.0.0.0:8080
```

