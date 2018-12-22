FROM ubuntu:18.04

MAINTAINER Andreas Ek <andreas@elseif.se>

# Install locales
RUN apt update && apt install -y locales
RUN locale-gen en_US.UTF-8

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8
ENV DEBIAN_FRONTEND noninteractive

# Get latest version of software-properties-common first
RUN apt update && apt upgrade -y && apt install -y software-properties-common

# Pre-add php7 repo
#RUN add-apt-repository -y ppa:ondrej/php \
#    && apt update

# Basic Requirements
RUN apt update \
    && apt install -y nginx curl unzip git supervisor wget python-pip sqlite3 mysql-client

# PHP Requirements
RUN apt update \
    && apt install -y php7.2 php7.2-fpm php7.2-cli php7.2-gd php7.2-mysql \
    php7.2-imap php-memcached php7.2-mbstring php7.2-xml php7.2-curl \
    php7.2-sqlite3

# Wordpress Requirements
RUN apt update \
    && apt install -y libnuma-dev php7.2-intl php-pear php7.2-imagick \
    php7.2-ps php7.2-pspell php7.2-recode php7.2-sqlite php7.2-tidy php7.2-xmlrpc php7.2-xsl

# Install Composer
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# Install WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# Misc. Cleanup
RUN mkdir /run/php \
    && apt remove -y --purge software-properties-common \
    && apt -y autoremove \
    && apt clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && echo "daemon off;" >> /etc/nginx/nginx.conf \
    && ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

COPY default /etc/nginx/sites-available/default
COPY php-fpm.conf /etc/php/7.2/fpm/php-fpm.conf

EXPOSE 80

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 9000

CMD ["/usr/bin/supervisord"]
