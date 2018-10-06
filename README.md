# Dev

docker network create backend

## Generate country data

docker-compose \
-f docker/all.yml \
-p yosmy_country \
up -d

docker exec -it yosmy_country_php sh

php vendor/mledoze/countries/countries.php convert \
-i name \
-i translations \
-i cca2 \
-i callingCode \
--format=json_unescaped \
--output-dir=./data

mv data/countries-unescaped.json data/countries.json

exit

docker-compose \
-f docker/all.yml \
-p yosmy_country \
stop