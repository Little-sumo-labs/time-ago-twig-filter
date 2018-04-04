.PHONY: autoload help gittag install phpunit phpcs phpcbf phpcsfixer
.DEFAULT_GOAL= help

vers?=1.0.0

init: ## initialise git
	git init
	git add .
	git commit -m "first commit"
	git remote add origin https://github.com/Little-sumo-labs/relativeTimerExtentionForTwig.git
	git push -u origin master

gittag: ## fait un push avec un nouveau tag
	git push
	git tag -a $(vers) -m "$(vers)"
	git push origin $(vers)

autoload: ## Recharge l'autoloader
	composer dump-autoload -o

help: ## Commande d'aide
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-10s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

install: vendor composer.lock ## installe tous les librairies de 'composer'

vendor: composer.json ## ajoute le dossier vendor et toutes les librairies
	composer install

composer.lock: composer.json ## Met à jour les librairies quand le composer est modifié
	composer update

phpunit: ## Lance phpunit
	./vendor/bin/phpunit --colors --coverage-text

phpcs: ## Lance le codesniffer
	./vendor/bin/phpcs

phpcbf: ## Fixe les bugs listé par codesniffer
	./vendor/bin/phpcbf

phpcsfixer: ## Lance le php-cs-fixer
	./vendor/bin/php-cs-fixer fix --diff