##Create MySQL Image for JSP Tutorial Application
##FROM mysql
##ENV MYSQL_ROOT_PASSWORD jsppassword
##ADD jsp_backup.sql /docker-entrypoint-initdb.d
##EXPOSE 3306

# INICIAMOS CON APACHE Y PHP
FROM php:7.4-apache
MAINTAINER  Josecandido "candidop@unam.mx"
##Actualizamos el sistema
# RUN apt-get update
VOLUME /var/www/html/
ADD cloud_native_proy /var/www/html/cloud_native_proy/
EXPOSE 80