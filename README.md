# Survey App

This project was prepared as example of Symfony 3 application and was used as a material for PHP Workshops.

## Getting started
Please follow the instructions to set up the Symfony project.

### Prerequisites
* Docker version 18 or higher
* Docker compose 1.20 or higher

### Installing
1. Create a `.env` file from the `.env.example` file. And adapt it according to your Symfony project needs.
    ```bash
    cp .env.example .env
    ```
2. Launch containers (it will take significant time on the very first run):
    ``` docker-compose up -d ```
3. Symfony is configured to use DEV environment as default and in this case you will use `app_dev.php`. If you are not using `docker-machine`, you need to allow access to `app_dev.php` front controller.
    - Find your network's IP.
    ```bash
    docker network inspect symfonyproject_default | grep Gateway
    ```
    
    If you changed `COMPOSE_PROJECT_NAME` in `.env` file, you should prefix network name to this value. You will see the output something similar to this.
    ```bash
        "Gateway": "172.21.0.1"
    ```
    
    - In `app_dev.php` add this IP to allowed hosts. The same needs to be done for `config.php`
    ```php
    // Added '172.21.0.1' in array for allowed hosts.
    if (isset($_SERVER['HTTP_CLIENT_IP'])
        || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
        || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '172.21.0.1', '::1'], true) || PHP_SAPI === 'cli-server')
    ) {
        header('HTTP/1.0 403 Forbidden');
        exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
    }
    ```
4. Navigate `http://localhost:8080/admin` to get into admin panel or `http://localhost:8080/survey/workshop-feedback` to get into survey landing page.
5. (Optional) If you launch the app first time, you need to create a user. Use the [instructions below](#user-creation).

### User creation

1. Get into php container
    ```bash
    docker-compose exec php bash
    ```
2. Create user via command prompt
    ```bash
    php bin/console fos:user:create
    ```
## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
