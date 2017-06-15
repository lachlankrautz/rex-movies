# Rex-Movies

# Overview

 - INSTALL script to prepare docker invironment seed tables etc
 - ./movies script loads env varibles and passes on to docker-compose
 - "./movies test" refreshes and seeds db then runs phpunit through docker
 - "./movies up" is just like docker-compose up but will pass on all ./.env settings to containers
 - all configuration files are volume mounted so server config is in project version control /docker/volume
 - Unit tests cover CRUD opperations of the 3 api resources
 - /api/token?email={email}&password={password} to retrive token or just login to dashboard on web
 - api_token in GET or header to authenticate all other endpoints
 - Tried to plan ahead with the db schema, most relationships supporting many:many and soft deletes
 - json responses show only relevant data

## Containers

 - app php-fpm linked to database/cache
 - web nginx linked to app
 - test php-cli linked to web/database/cache (unit tests need to hit web server without creating circular link)
 - database mysql
 - cache redis

# Install
```
$ bash <(curl -s https://raw.githubusercontent.com/lachlankrautz/rex-movies/master/install)
```

# Usage
```
$ ./movies up
                                                _
     ________  _  __      ____ ___  ____ _   __(_)__  _____
    / ___/ _ \| |/_/_____/ __ `__ \/ __ \ | / / / _ \/ ___/
   / /  /  __/>  </_____/ / / / / / /_/ / |/ / /  __(__  )
  /_/   \___/_/|_|     /_/ /_/ /_/\____/|___/_/\___/____/

Creating network "docker_default" with the default driver
Creating Laravel_cache
Creating Laravel_database
Creating Laravel_app
Creating Laravel_web
Attaching to Laravel_cache, Laravel_database, Laravel_app, Laravel_web

$ ./movies ps
                                                _
     ________  _  __      ____ ___  ____ _   __(_)__  _____
    / ___/ _ \| |/_/_____/ __ `__ \/ __ \ | / / / _ \/ ___/
   / /  /  __/>  </_____/ / / / / / /_/ / |/ / /  __(__  )
  /_/   \___/_/|_|     /_/ /_/ /_/\____/|___/_/\___/____/

      Name                    Command               State            Ports
-----------------------------------------------------------------------------------
Laravel_app        docker-php-entrypoint php-fpm    Up      9000/tcp
Laravel_cache      docker-entrypoint.sh redis ...   Up      0.0.0.0:63791->6379/tcp
Laravel_database   docker-entrypoint.sh mysqld      Up      0.0.0.0:33061->3306/tcp
Laravel_web        nginx -g daemon off;             Up      0.0.0.0:80->80/tcp
```
