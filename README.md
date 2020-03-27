SERVICES
==================

## About the project
SERVICES - a training project site for the placement and search for custom services.

- Convenient for administrators - viewing and simple editing of all data in the admin panel;
- Convenient for users - categorization of services, search for services, personal account, and much more;
- Convenient for developers - the project is written in the framework of Yii 2.0, it is easy to maintain and expand.


## Requirements
The minimum requirement by this project is that your Web server supports PHP 7.4.0 or above.


## Installing
To install the project dependencies you need [composer](http://getcomposer.org/download/).
You have to conduct the following steps to initialize the installed applicatio:

1) Clone the project
```
git clone https://gitlab.com/winterpsv/phppro.git
```

2) Open a console terminal, go to the project folder
```
cd phppro/
```

3) Run the command
```
composer install
```

4) Execute the init command and select dev as environment (or prod - for production)
```
php init

```
5) Create a new database and adjust the components['db'](https://www.yiiframework.com/doc/guide/2.0/en/start-databases#configuring-db-connection) configuration in common/config/main-local.php accordingly.

6) Apply migrations with command
```
php yii migrate

```
7) Set document roots of your web server:
- for frontend 
```
/path/to/phppro/frontend/web/

```
- for backend
```
/path/to/phppro/backend/web/

```

Since the project is written in the framework of Yii 2.0, and if you have any difficulties during the installation, refer [to the documentation](https://github.com/yiisoft/yii2-app-advanced/tree/master/docs/guide)

8) Log in to the admin panel and create several categories of services.


## Login Information
The project has already created test user and administrator accounts.

To get to the admin panel (backend), use the following data:
```
login: admin
password: admin

```
You can familiarize yourself with the site (front-end part) by logging in as a test user:
```
login: testuser
password: testuser

```

## License
Code released under [MIT License](LICENSE).


## Authors
[Sergii Pedchenko](https://gitlab.com/winterpsv)
[Taras Potochylov](https://gitlab.com/888rayon)
[Eugene Bilan](https://gitlab.com/eugene.bilan)
[Sergii Nechyporenko](https://gitlab.com/Nech)


## Acknowledgments
[Aksafan](https://gitlab.com/Aksafan) - for tips, perseverance and patience.
