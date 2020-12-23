install:
	composer install
brain-games:
	php bin/brain-games
validate:
	composer validate
pushAll:
	git add -A & git commit -m '$(M)' & git push