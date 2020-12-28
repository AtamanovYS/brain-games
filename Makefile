install:
	composer install
validate:
	composer validate
autoload:
	composer dump-autoload
lint:
	composer run-script phpcs -- --standard=PSR12 src bin
brain-games:
	./bin/brain-games
brain-even:
	./bin/brain-even
brain-calc:
	./bin/brain-calc
brain-gcd:
	./bin/brain-gcd
brain-progression:
	./bin/brain-progression
brain-prime:
	./bin/brain-prime
pushAll:
	git add -A; git commit -m '$(m)'; git push