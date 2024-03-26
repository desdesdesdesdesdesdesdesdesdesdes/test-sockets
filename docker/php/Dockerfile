FROM bitnami/php-fpm:8.3.4

ARG WWWUSER=1000
ARG WWWGROUP=1000

ENV TZ=UTC

WORKDIR /var/www/html

#RUN groupadd -g $WWWGROUP www-data
RUN groupmod -g $WWWGROUP www-data
#RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u $WWWUSER www-data
RUN usermod -g $WWWGROUP -u $WWWUSER www-data
RUN chown -R www-data:www-data /var/www/html

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y npm \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && apt-get update \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY www.conf /opt/bitnami/php/etc/php-fpm.d/www.conf
COPY php.ini /opt/bitnami/php/etc/php.ini

COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
