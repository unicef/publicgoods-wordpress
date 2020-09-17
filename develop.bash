#!/bin/bash
if [ -f ".env.bash" ]; then
	source .env.bash
fi
echo $DB_NAME
php -S localhost:8000