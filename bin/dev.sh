#!/bin/sh
cp ./src/laravel/.env.example ./src/laravel/.env
docker-compose build --no-cache && docker-compose --env-file ./src/laravel/.env up -d