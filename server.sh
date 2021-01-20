#!/bin/bash
FLAG=$1

start () {
    sudo xampp startapache && sudo xampp startmysql && php artisan serve
}

stop () {
    sudo xampp stopapache && sudo xampp stopmysql
}

case $FLAG in
    "--start") start;;
    "--stop") stop;;
    "") echo "Usage: server [--start] [--stop]";;
    *) echo "Unknown command";;
esac
