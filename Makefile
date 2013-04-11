VERSION=$(shell head -n 1 VERSION)

all: tgz

clean:
	rm -fr zentaoasm
	rm -fr *.tar.gz
	rm -fr *.zip
tgz:
	mkdir -p zentaoasm/lib
	mkdir -p zentaoasm/db
	mkdir -p zentaoasm/config
	mkdir -p zentaoasm/tmp/cache
	mkdir -p zentaoasm/tmp/log
	mkdir -p zentaoasm/tmp/model
	mkdir -p zentaoasm/www/data
	cp -fr lib/ zentaoasm/
	cp -fr db zentaoasm/
	cp -fr config/config.php zentaoasm/config/
	cp -fr www/index.php zentaoasm/www/
	cp -fr www/admin.php zentaoasm/www/
	cp -fr www/install.php zentaoasm/www/
	cp -fr www/upgrade.php zentaoasm/www/
	cp -fr www/js zentaoasm/www/
	cp -fr www/*.ico zentaoasm/www/
	cp -fr www/robots.txt zentaoasm/www/
	cp -fr www/theme zentaoasm/www/
	cp -fr module zentaoasm/
	cp -fr framework zentaoasm/
	find zentaoasm -name .svn |xargs rm -fr
	find zentaoasm -name tests |xargs rm -fr
	chmod 777 -R zentaoasm/tmp/
	chmod 777 zentaoasm/www/data
	chmod 777 zentaoasm/config
	zip -r -9 ZenTaoASM.$(VERSION).zip zentaoasm
	rm -fr zentaoasm
chgL:
	find pms/module -name '*.php'|xargs sed -i s/'LGPL (http:\/\/www.gnu.org\/licenses\/lgpl.html)'/'商业软件，未经授权，请立刻删除!'/g
