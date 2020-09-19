.PHONY: help

PLATFORM :=

ifeq ($(OS),Windows_NT)
	PLATFORM := windows
else
	UNAME_S := $(shell uname -s)
ifeq ($(UNAME_S),Linux)
	PLATFORM := linux
else
ifeq ($(UNAME_S),Darwin)
	PLATFORM := osx
endif
endif
endif

help:
	$(info > `make install` to install the dependencies for production)
	$(info - `make test` to run automated tests)
	$(info Detected platform: $(PLATFORM).)
	$(info )
	@ls > /dev/null

install: composer-install

composer-install:
	$(info Installing Composer dependencies)
	composer install

.PHONY: test phpunit

test:: composer-install
test:: phpunit

phpunit::
	$(info Running PhpUnit)
	"vendor/bin/phpunit" --colors  --testdox tests

