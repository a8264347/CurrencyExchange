FROM php:8.0-alpine

# 安装cURL和OpenSSL
RUN apk add --no-cache curl-dev openssl-dev

RUN apk add --no-cache libstdc++

RUN apk update && apk upgrade

# 安裝環境、安裝工具
RUN apk add --no-cache libpng-dev zlib-dev unzip libzip-dev zip openssl git bash \
	&& apk add --no-cache --virtual .build-deps build-base autoconf g++ make tzdata \
	&& pecl install redis \
	&& pecl install swoole \
	&& docker-php-ext-enable redis \
	&& docker-php-ext-enable swoole \
	&& docker-php-ext-install gd pdo pdo_mysql bcmath zip

RUN cp /usr/share/zoneinfo/Asia/Taipei /etc/localtime

# 安裝 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV SWOOLE_HTTP_HOST=0.0.0.0 \
	SWOOLE_HTTP_PORT=8000 \
	SWOOLE_HTTP_WORKER_NUM=2 \
	SERVICE_PORT=8000

# 設定工作目錄
WORKDIR /var/www/html

# 複製 Laravel 專案檔案
COPY . /var/www/html

RUN composer install --optimize-autoloader --no-dev && composer clear-cache

RUN apk del .build-deps

EXPOSE 8000

CMD ["php", "artisan", "swoole:http", "start"]