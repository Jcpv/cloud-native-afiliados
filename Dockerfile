# INICIAMOS CON APACHE Y PHP
FROM php:7.4-apache
# COPY . /var/www/html/
MAINTAINER  Josecandido "candidop@unam.mx"
##Actualizamos el sistema
# RUN apt-get update
##Instalamos nginx
# RUN apt-get install -y nginx
VOLUME /var/www/html/
##Creamos un fichero index.html en el directorio por defecto de nginx
#RUN echo 'Mi primer Dockerfile' > /var/www/html/index.html
# Copia los archivos de la aplicación al contenedor
##COPY . /var/www/html
ADD cloud_native_proy /var/www/html/cloud_native_proy/
##Exponemos el Puerto 80
EXPOSE 80
##Arrancamos NGINX a través de ENTRYPOINT para que no pueda ser
##modificar en la creación del contenedor
# ENTRYPOINT ["/usr/sbin/nginx", "-g", "daemon off;"]
