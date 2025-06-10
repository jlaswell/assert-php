# Set default shell
set shell := ["bash", "-c"]

drun := "docker run -it -w /data -v ${PWD}:/data:delegated"
drun-base := "docker run -it -w /data -v ${PWD}:/data:delegated --rm registry.gitlab.com/grahamcampbell/php:8.4-base"
drun-cli := "docker run -it -w /data -v ${PWD}:/data:delegated --rm registry.gitlab.com/grahamcampbell/php:8.4-cli"

_default:
  @just --choose

# Run composer commands
composer *args:
    {{drun-base}} composer {{args}}

# Run phpstan
phpstan *args:
    {{drun-cli}} ./vendor/bin/phpstan analyse {{args}}

phpstan-baseline:
    {{drun-cli}} ./vendor/bin/phpstan analyse --generate-baseline

# Run phpunit
phpunit *args:
    {{drun-cli}} ./vendor/bin/phpunit --no-coverage {{args}}

# Run phpunit with coverage
phpunit-coverage *args:
    {{drun}} -e XDEBUG_MODE=coverage --rm registry.gitlab.com/grahamcampbell/php:8.4 vendor/bin/phpunit --coverage-html cov {{args}}

test:
    just phpunit
    just phpstan

run *args:
    {{drun-cli}} {{args}}
