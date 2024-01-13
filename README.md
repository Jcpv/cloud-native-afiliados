# cluod-native-afiliados2020

## Projecto 
Implementar micro servicio para consultar afiliados a alguna institución publica en 2020.

## Dependencias
Esta aplicación requiere estar conectada a una Base de datos de MariaDb.

### GIT del proyecto 
git clone https://github.com/Jcpv/cloud-native-afiliados

### Archivos Docker 
- Ejecutar el archivo Dockerfile para cargar la imagen del entorno de Apache 7.4 y será expuesto en el puerto 80 
https://github.com/Jcpv/cloud-native-afiliados/blob/main/Dockerfile

- Ejecutar el archivo Dockerfile de la carpeta bd/Dockerfile para crear el entorno de MariaDb que se requiere y cargar registros para realizar la pruebas correspondientes.
https://github.com/Jcpv/cloud-native-afiliados/tree/main/bd/Dockerfile 

### Para Kubernetes
- Aplicar el archivo yaml para ejecutar la imagen en kubernetes
kubectl apply -f https://raw.githubusercontent.com/Jcpv/cloud-native-afiliados/main/manifest/rest-deployment.yaml

- Archivo de Secrets 
kubectl apply -f https://raw.githubusercontent.com/Jcpv/cloud-native-afiliados/main/manifest/01-docker-secret.yaml

- Archivo de ServiceAccount 
kubectl apply -f https://raw.githubusercontent.com/Jcpv/cloud-native-afiliados/main/manifest/02-service-account.yaml

- Task de GIT-CLONE

- Task de List-Directory

- Task de Buildah

- Task de Kubernet-actions



# 

## Ejemplo de POST

curl -X 'POST' \
  'localhost/cloud_native_proy/api.php/analisis/afiliados2020' \
  -H 'accept: application/json' \
  -H 'Content-Type: application/json' \
  -d ' {
    "id_ent": "4",
    "id_mun": "07091",
    "sex": "2",
    "gpo_edad": "10",
    "mun_frontera": "2",
    "afiliados": "p0",
    "personas": "2141"
}'

## Ejemplo de GET
