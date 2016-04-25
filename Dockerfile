FROM php:5.6
WORKDIR /code
COPY . /code
RUN echo "date.timezone=Europe/Amsterdam" >> /usr/local/etc/php/php.ini
RUN apt-get update && apt-get install php5-mysql -y
RUN docker-php-ext-install pdo pdo_mysql
CMD /code/app/console s:r
