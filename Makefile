default:
	@echo Please read the Makefile

install:
	mkdir -p tmp/uploads tmp/cache tmp/logs tmp/sessions tmp/smarty_compile tmp/smarty_cache
	chmod -R 777 tmp/uploads tmp/cache tmp/logs tmp/sessions tmp/smarty_compile
	php bin/composer.phar install

clean:
	rm -rf tmp
	find . -type f -name ".#*" -exec rm {} \;
	find . -type f -name "*~" -exec rm {} \;
	find . -type f -name "Thumbs.db" -exec rm {} \;
	find . -type f -name ".DS_Store" -exec rm {} \;
	rm -rf tmp/uploads tmp/cache tmp/logs tmp/sessions tmp/smarty_compile tmp/smarty_cache

run:
	php -S 0.0.0.0:8080 -t public