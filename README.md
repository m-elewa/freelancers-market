# Freelancers Market

Freelancers Market is a platform works like a broker between the clients and the freelancers while the actual work and pay done on the freelance website that both the freelancer and the client are using. <b>How it works?</b> clients can link their jobs on the platform to let freelancers apply on their jobs. Then the client can invite the best suited freelancer(s) to apply on his job on The freelance website.

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

In order to use Freelancers Market, you will need:

- [Docker Engine](https://docs.docker.com/installation/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Docker Machine](https://docs.docker.com/machine/)

## Installation

1. Install the project
```
git clone --recurse-submodules https://github.com/m-elewa/freelancers-market.git \
    && cd freelancers-market \
    && git submodule update --remote \
    && cd laradock \
    && cp env-example .env
```
2. Change `HOST_DOMAIN` and `ACME_EMAIL` in `.env` file to your website domain and email
3. Run Docker Containers with `make up` command from the root directory or from laradock directory run
```
docker-compose up -d --build --scale nginx=3
```
4. Setup the application by running `make setup` from the root directory or from laradock directory run
```
docker-compose exec --user=laradock workspace composer setup
```
You can now login with `admin@example.com` and password as `password`

## Tips
- run `make test-database` to create `test` database for tests
- run `make test` to test the application
- run `make seed` to drop all tables then migrate and seed the database
- for Laravel Telescope go to `https//{YOURDOMAIN.COM}/telescope`
- for Laravel Horizon go to `https//{YOURDOMAIN.COM}/horizon`
- for Portainer go to `{YOURDOMAIN.COM}:9010`
- for phpMyAdmin go to `{YOURDOMAIN.COM}:8080`
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

## Great open-source projects used to help build Freelancers Market
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
If you come across any issues please [report them here](https://github.com/m-elewa/freelancers-market/issues).

## Contributing
Contributing to the Freelancers Market project are welcome, please feel free to make any pull requests, or email me a feature request you would like to see in the future to Mahmoud Elewa at [mahmoud.elewa.999@gmail.com](mailto:mahmoud.elewa.999@gmail.com).

## Security Vulnerabilities
If you discover a security vulnerability within Freelancers Market, please send an email to Mahmoud Elewa at [mahmoud.elewa.999@gmail.com](mailto:mahmoud.elewa.999@gmail.com), or create a pull request if possible.

## Disclaimer
Before using this project with any freelance website **you have to make sure first that this website allow it and it does not violate any of their Terms of Service.**

## License
The Freelancers Market is open-sourced software licensed under the [MIT license](https://github.com/m-elewa/freelancers-market/blob/master/LICENSE).
