#!/usr/bin/env bash

# Set environment variables for dev
export APP_PORT=${APP_PORT:-80}
export DB_HOST=${DB_HOST:-mysql}
export DB_PORT=${DB_PORT:-3306}
export DB_ROOT_PASS=${DB_ROOT_PASS:=secret}
export DB_NAME=${DB_NAME:=wordpress}
export DB_USER=${DB_USER:=wordpress}
export DB_PASS=${DB_PASS:=secret}

# Decide which docker-compose file to use
COMPOSE_FILE="dev"

COMPOSE="docker-compose -f docker/docker-compose.$COMPOSE_FILE.yml"

if [ $# -gt 0 ]; then
  # If "composer" is used, pass-thru to "composer"
  # inside a new container
  if [ "$1" == "composer" ]; then
      shift 1
      $COMPOSE run --rm $TTY \
          -w /var/www/html \
          app \
          composer "$@"

  # If "wp" is used, pass-thru to "wp-cli"
  elif [ "$1" == "wp" ]; then
      shift 1
      $COMPOSE run --rm $TTY \
          -w /var/www/html \
          app \
          wp --allow-root "$@"

  # if "init" is used, make the src directory and
  # install latest version of Bedrock. Afterwards
  # install a Sage theme into Bedrock's theme folder
  # with the name specified as the argument after "init".
  # By default the dev-master version of Sage will
  # be used.
  elif [ "$1" == "init" ]; then
    shift 1
    rm -Rf docker/bedrock
    mkdir docker/bedrock
    $COMPOSE run --rm $TTY \
        -w /var/www/html \
        app \
        composer create-project roots/bedrock .

    cp -f docker/app/.env docker/bedrock/.env

    $COMPOSE run --rm $TTY \
        -w /var/www/html/web/app/plugins \
        app \
        ln -s /var/www/project listig

    rm -f project

    $COMPOSE run --rm $TTY \
        -w /var/www/html \
        app \
        wp --allow-root db reset --yes

    $COMPOSE run --rm $TTY \
        -w /var/www/html \
        app \
        wp --allow-root core install --url=localhost --title=Listig --admin_user=admin --admin_password=admin --admin_email=info@localhost.com

    $COMPOSE run --rm $TTY \
        -w /var/www/html \
        app \
        curl -O https://wpcom-themes.svn.automattic.com/demo/theme-unit-test-data.xml

    $COMPOSE run --rm $TTY \
        -w /var/www/html \
        app \
        wp --allow-root plugin install wordpress-importer --activate

    $COMPOSE run --rm $TTY \
        -w /var/www/html \
        app \
        wp --allow-root import ./theme-unit-test-data.xml --authors=create

    $COMPOSE run --rm $TTY \
        -w /var/www/html \
        app \
        rm theme-unit-test-data.xml

    $COMPOSE run --rm $TTY \
        -w /var/www/html \
        app \
        wp --allow-root plugin delete wordpress-importer

    $COMPOSE run --rm $TTY \
        -w /var/www/html \
        app \
        wp --allow-root plugin activate listig

    $COMPOSE run --rm $TTY \
        -w /var/www/html \
        app \
        wp --allow-root rewrite structure '/%postname%/'

  # Else, pass-thru args to docker-compose
  else
    $COMPOSE "$@"
  fi
else
  $COMPOSE ps
fi
