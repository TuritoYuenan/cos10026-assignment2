FROM php:8.5.4-cli-alpine

WORKDIR /var/www/html

# Enable MySQLi support required by jobs.php and other DB-backed pages.
RUN docker-php-ext-install mysqli

# Copy root-level PHP include/source files and static assets used by the app.
COPY *.php ./
COPY *.inc ./
COPY styles ./styles
COPY images ./images

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]
