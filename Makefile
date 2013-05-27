VERSION=$(shell head -n 1 VERSION)

all: tgz

clean:
	rm -fr xirangcsm
	rm -fr *.tar.gz
	rm -fr *.zip
tgz:
	mkdir -p xirangcsm/lib
	mkdir -p xirangcsm/db
	mkdir -p xirangcsm/config
	mkdir -p xirangcsm/tmp/cache
	mkdir -p xirangcsm/tmp/log
	mkdir -p xirangcsm/tmp/model
	mkdir -p xirangcsm/www/data
	cp -fr lib/ xirangcsm/
	cp -fr db xirangcsm/
	cp -fr config/config.php xirangcsm/config/
	cp -fr www/index.php xirangcsm/www/
	cp -fr www/admin.php xirangcsm/www/
	cp -fr www/install.php xirangcsm/www/
	cp -fr www/upgrade.php xirangcsm/www/
	cp -fr www/js xirangcsm/www/
	cp -fr www/*.ico xirangcsm/www/
	cp -fr www/robots.txt xirangcsm/www/
	cp -fr www/theme xirangcsm/www/
	cp -fr module xirangcsm/
	cp -fr framework xirangcsm/
	find xirangcsm -name .svn |xargs rm -fr
	find xirangcsm -name tests |xargs rm -fr
	chmod 777 -R xirangcsm/tmp/
	chmod 777 xirangcsm/www/data
	chmod 777 xirangcsm/config
	zip -r -9 XiRangCSM.$(VERSION).zip xirangcsm
	rm -fr xirangcsm
chgL:
	find ~/xirangcsm -name '*.php'|xargs sed -i s/'XiRangASM'/'XiRangCSM'/g
