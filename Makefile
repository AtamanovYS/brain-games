install:
	composer install
autoload:
	composer dump-autoload
validate:
	composer validate
lint:
	composer run-script phpcs -- --standard=PSR12 src bin
stan:
	composer run-script phpstan -- --level max src bin
brain-games:
	./bin/brain-games
brain-run:
	./bin/brain-run
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