default: help

help:
	@echo "Allowed operations:"

	@echo "\nTesting:"
	@echo " - phpunit               // Run PHPUnit tests"
	@echo " - behat                 // Run Behat tests"

	@echo "\nUtilities:"
	@echo " - phpcs                 // PHP Code Sniffer"

test: phpunit behat

behat: cache
	APPLICATION_ENV="development" bin/behat --config behat.yml --stop-on-failure

phpunit: cache
	bin/phpunit

phpcs:
	phpcs --ignore=fixtures --standard=vendor/creolink/code_style/Symfony2 src

cache:
	rm -fR var/cache/*


