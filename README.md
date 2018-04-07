Business Card Creator sample app
========================

Installation
--------------

1) Clone this github repo
```sh
$ git clone https://github.com/ldolancic/business-card-app.git
```

2) Install dependencies and specify parameters

```sh
$ composer install
```

While installing you will be asked to enter some additional (non-standard) parameters listed below. Those parameters can be defined later on, but they are crucial for pdf generation because PDF is generated from a CLI.

```sh
router.request_context.host: 127.0.0.1:8001
router.request_context.scheme: http
router.request_context.base_url: /
```

3) Create database
```sh
$ php bin/console doctrine:database:create
```

4) Update database schema
```sh
$ php bin/console doctrine:schema:update --force
```

5) Run your app

I strongly adwise you to run this app under a webserver like Apache. But if you do not have a webserver installed, you can also use the following command:

```sh
$ php bin/console server:run
```

Keep in mind that this is a simple php server and pdf download links will not work