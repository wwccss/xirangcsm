VERSION=$(shell head -n 1 VERSION)

all: tgz

clean:
	rm -fr ztrack
	rm -fr *.tar.gz
	rm -fr *.zip
tgz:
	mkdir -p ztrack/lib
	mkdir -p ztrack/db
	mkdir -p ztrack/config
	mkdir -p ztrack/tmp/cache
	mkdir -p ztrack/tmp/log
	mkdir -p ztrack/tmp/model
	mkdir -p ztrack/www/data
	cp -fr lib/ ztrack/
	cp -fr db ztrack/
	cp -fr config/config.php ztrack/config/
	cp -fr www/index.php ztrack/www/
	cp -fr www/admin.php ztrack/www/
	cp -fr www/install.php ztrack/www/
	cp -fr www/js ztrack/www/
	cp -fr www/*.ico ztrack/www/
	cp -fr www/robots.txt ztrack/www/
	cp -fr www/theme ztrack/www/
	cp -fr module ztrack/
	cp -fr framework ztrack/
	find ztrack -name .svn |xargs rm -fr
	find ztrack -name tests |xargs rm -fr
	chmod 777 -R ztrack/tmp/
	chmod 777 ztrack/www/data
	chmod 777 ztrack/config
	zip -r -9 Ztrack.$(VERSION).zip ztrack
	rm -fr ztrack
chgL:
	find pms/module -name '*.php'|xargs sed -i s/'LGPL (http:\/\/www.gnu.org\/licenses\/lgpl.html)'/'商业软件，未经授权，请立刻删除!'/g
