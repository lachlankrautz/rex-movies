# Rex-Movies

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
