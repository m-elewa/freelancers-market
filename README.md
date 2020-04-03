# Freelancers Black Market

Freelancers Black Market is a platform works like a broker between the clients and the freelancers but the actual work and pay will be done on the freelance website that both the freelancer and the client are using. <b>How it works?</b> clients can link their jobs on the platform to let freelancers apply for free on their jobs. Then the client can invite the best suited freelancer(s) to apply on his job on The freelance website.

## Basic Features

- Real-time notifications on self hosted laravel echo server.
- Full-text search with Laravel Scout and TNTSearch.
- Shipped with testing units to test the application using PHPUnit.
- Clean, high quality and easy to understand code.
- Compatible with PHP 7.4 and Laravel 7.
- Dockerized developing environment to speed up the installation process.
- Ability to seed fake data in the database.
- Utilize Redis for broadcasting, caching, queues and sessions.
- Ability to debug and track the development environment with Laravel Telescope and Horizon.
- And more...

## Requirements

In order to use Freelancers Black Market, you will need:

- [Docker Engine](https://docs.docker.com/installation/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Docker Machine](https://docs.docker.com/machine/)

## installation

1. Clone the source code `git clone --recurse-submodules https://github.com/m-elewa/freelancers-black-market.git`
2. Enter the laradock folder and rename env-example to .env `cp env-example .env`
3. Make these changes to `.env`
```shell
### PHP Version ###########################################
PHP_VERSION=7.4
### WORKSPACE #############################################
WORKSPACE_VUE_CLI_SERVE_HOST_PORT=9090
```
4. Rename `laravel-horizon.conf.example` to `laravel-horizon.conf`
```
cp laravel-horizon/supervisord.d/laravel-horizon.conf.example laravel-horizon/supervisord.d/laravel-horizon.conf
```
5. Run Docker Containers `make docker-up` or
```
docker-compose up -d nginx mysql phpmyadmin workspace portainer redis laravel-horizon laravel-echo-server
```
6. to setup the application Run `make setup` or
```
docker-compose exec --user=laradock workspace composer setup
```
7. You can now login with `admin@example.com` and password as `password` on `localhost`

## Tips
- run `make test-database` to create `test` database for tests
- run `make test` to test the application
- run `make seed` to drop all tables then migrate and seed the database
- for Laravel Telescope go to `localhost/telescope`
- for Laravel Horizon go to `localhost/horizon`
- for Portainer go to `localhost:9010`
- for phpMyAdmin go to `localhost:8080`
- to enter the Workspace container run `make bash` or
```
docker-compose exec --user=laradock workspace bash
```
-  change the freelance website name and domain in `.env` file
```shell
FREELANCE_WEBSITE_NAME="Freelance Website"
FREELANCE_WEBSITE_DOMAIN="example.com/"
```
- to index the existing jobs run `make scout-import`
- If you need to flush the jobs index run `make scout-flush`

## Great open-source projects used to help build Freelancers Black Market
* [Laravel](https://github.com/laravel/laravel)
    * [horizon](https://github.com/laravel/horizon)
    * [scout](https://github.com/laravel/scout)
    * [telescope](https://github.com/laravel/telescope)
* [Laradock](https://github.com/laradock/laradock)
    * [NGINX](https://www.nginx.com/)
    * [MySQL](https://www.mysql.com/)
    * [PhpMyAdmin](https://www.phpmyadmin.net/)
    * [Redis](https://redis.io/)
    * [Laravel Echo Server](https://github.com/tlaverdure/laravel-echo-server)
    * [Portainer](https://www.portainer.io/)
* [TNTSearch Driver for Laravel Scout](https://github.com/teamtnt/laravel-scout-tntsearch-driver)
* [PHPUnit](https://github.com/sebastianbergmann/phpunit)
* [Bootstrap](https://github.com/twbs/bootstrap)
* [TinyMCE](https://www.tinymce.com/)

## To Do
- use ElasticSearch as the search engine
- use AJAX and Vue.js for the search page
- create admin control panel
- add realtime messaging system
- add more search filters
- add more tests

## Issues
If you come across any issues please [report them here](https://github.com/m-elewa/freelancers-black-market/issues).

## Contributing
Contributing to the Freelancers Black Market project are welcome, please feel free to make any pull requests, or email me a feature request you would like to see in the future to Mahmoud Elewa at [mahmoud.elewa.999@gmail.com](mailto:mahmoud.elewa.999@gmail.com).

## Security Vulnerabilities
If you discover a security vulnerability within Freelancers Black Market, please send an email to Mahmoud Elewa at [mahmoud.elewa.999@gmail.com](mailto:mahmoud.elewa.999@gmail.com), or create a pull request if possible.

## Disclaimer
Before using this project with any freelance website **you have to make sure first that this website allow it and it does not violate any of their Terms of Service.**

## License
The Freelancers Black Market is open-sourced software licensed under the [MIT license](https://github.com/m-elewa/freelancers-black-market/blob/master/LICENSE).
