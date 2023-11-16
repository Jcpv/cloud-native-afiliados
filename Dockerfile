##Descargamos una versión concreta de FEDORA, a través del tag
FROM fedora
MAINTAINER  Josecandido "candidop@unam.mx"
# Copia los archivos de la aplicación al contenedor
##COPY . /var/www/html
ADD cloud_native_proy /var/www/html/
##Actualizamos el sistema
# RUN dnf update
##Instalamos nginx
RUN dnf install -y nginx
##Creamos un fichero index.html en el directorio por defecto de nginx
RUN echo 'Mi primer Dockerfile' > /var/www/html/index.html  
##Arrancamos NGINX a través de ENTRYPOINT para que no pueda ser
##modificar en la creación del contenedor
##ENTRYPOINT ["/usr/sbin/nginx", "-g", "daemon off;"]
##Exponemos el Puerto 80
EXPOSE 80