install:
	composer install
brain-games:
	./bin/brain-games
brain-even:
	./bin/brain-even
validate:
	composer validate
pushAll:
	git add -A; git commit -m '$(M)'; git push
lint:
	composer run-script phpcs -- --standard=PSR12 src bin