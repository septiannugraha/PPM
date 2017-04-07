SIMOKU - Renbang
===============================

Created by [@hoaaah](http://belajararief.com)


INSTALLATION
------------

### Clone it

First you must download composer-asset-plugin first:

```shell
composer global require "fxp/composer-asset-plugin:~1.2.0"
```

Then you can clone this repository to your computer. And then update your composer with:

```shell
composer update
```

You can access your app in webroot directory

~~~
http://localhost/app/webroot/
~~~

### Postinstallation setup

After you set your db and configuration, you must set your params too in app/config/params.php. Set an alias in your apache as static image web accescible url. Web Accescible url use path to app/upload.

After you get an apache alias, don't forget set your params too in app/config/params.php.


### Database

Edit the file `config/db-local.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2app',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```


TESTING FOR TESTER Using Automated Test
---------------------------------------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```shell
vendor/bin/codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser.


### Running  acceptance tests

To execute acceptance tests do the following:

1. Rename `tests/acceptance.suite.yml.example` to `tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full featured
   version of Codeception

3. Update dependencies with Composer

    ```shell
    composer update
    ```

4. Download [Selenium Server](http://www.seleniumhq.org/download/) and launch it:

    ```shell
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

5. (Optional) Create `yii2_app_tests` database and update it by applying migrations if you have them.

   ```shell
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/testdb-local.php`.


6. Start web server:

    ```shell
    tests/bin/yii serve
    ```

7. Now you can run all available tests

   ```shell
   # run all available tests
   vendor/bin/codecept run

   # run acceptance tests
   vendor/bin/codecept run acceptance

   # run only unit and functional tests
   vendor/bin/codecept run unit,functional
   ```

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```shell
# collect coverage for all tests
vendor/bin/codecept run -- --coverage-html --coverage-xml

# collect coverage only for unit tests
vendor/bin/codecept run unit -- --coverage-html --coverage-xml

# collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit -- --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.
