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
ADD / /var/www/html/cloud-native-afiliados/
EXPOSE 80