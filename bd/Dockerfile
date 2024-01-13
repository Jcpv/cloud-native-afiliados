#Create MariDB
FROM mariadb
MAINTAINER Josecandido "candidop@unam.mx"
ENV MARIADB_ROOT_PASSWORD Pruebas1234
ENV MYSQL_DATABASE CloudNative
VOLUME /home/
ADD ../mx_afiliados_2020v.sql /home
COPY ../mx_afiliados_2020v.sql /docker-entrypoint-initdb.d/
EXPOSE 3306
CMD ["mariadbd"]