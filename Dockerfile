FROM php:7.2-fpm

WORKDIR /var/www/app

# Installing php extensions
RUN apt-get update && \
    apt-get install -y libpq-dev git gnupgl \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Installing Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

COPY composer*.json ./
RUN php composer.phar install

# Install Node.JS
RUN curl -sL https://deb.nodesource.com/setup_11.x | bash -
RUN apt install -y nodejs
COPY package*.json ./
RUN npm install

COPY . ./

RUN node_modules/.bin/encore production

# Remove nodejs and other dependencies
RUN apt remove -y nodejs && \
    apt autoremove - && \
    apt clean

RUN php bin/console cache:clear --env=prod --no-debug
RUN php bin/console cache:warmup --env=prod

RUN chmod 777 -R var/
