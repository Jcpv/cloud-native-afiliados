# cluod-native-afiliados2020

## Proyecto 
Implementar micro servicio para consultar afiliados a alguna institución publica en 2020.

Tecnologías para el funcionamiento PHP 7.4, SlimFramework 3 para la API y MariaDb para la base de datos

### Dependencias
Esta aplicación requiere estar conectada a una Base de datos de MariaDb.

### GIT del proyecto 
```
git clone https://github.com/Jcpv/cloud-native-afiliados
```

### Archivos Docker 
- Ejecutar el archivo Dockerfile para cargar la imagen del entorno de Apache 7.4 y será expuesto en el puerto 80 
```
https://github.com/Jcpv/cloud-native-afiliados/blob/main/Dockerfile
```

- Ejecutar el archivo Dockerfile de la carpeta bd/Dockerfile para crear el entorno de MariaDb que se requiere y cargar registros para realizar la pruebas correspondientes.
```
https://github.com/Jcpv/cloud-native-afiliados/tree/main/bd/Dockerfile 
```

### Registros MySql de ejemplo para ejecutar
```
https://github.com/Jcpv/cloud-native-afiliados/tree/main/mx_afiliados_2020v.sql
```

### Para Kubernetes
- Aplicar el archivo yaml para ejecutar la imagen en kubernetes
```
kubectl apply -f https://raw.githubusercontent.com/Jcpv/cloud-native-afiliados/main/manifest/rest-deployment.yaml
```


- Archivo de Secrets
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/01-docker-secret.yaml
```

- Archivo de ServiceAccount 
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/02-service-account.yaml
```


- Task de Git-Clone
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/03a-task-git-clone.yaml
```

- TaksRun de Git-Clone
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/03b-taskrun-git-clone.yaml
```

- Task de List-Directory
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/04a-task-list-directory.yaml
```

- TaskRun de List-Directory
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/04b-taskrun-list-dir.yaml
```

- Task de Buildah
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/05a-instalar-task-buildah.md
```

- TaskRun de Buildah
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/05b-taskrun-deployment-buildha.yaml
```

- Task de Kubernet-actions
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/06a-instalar-task-kubernetes-actions.md
```

- TaskRun de Kubernet-actions
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/06b-taskrun-deployment-kubernetes-action.yaml
```

- Pipeline del micro servicio
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/07-pipeline.yaml
```

- PipelineRun 
```
kubectl apply -f https://github.com/Jcpv/cloud-native-afiliados/blob/main/manifest/08-pipeline-run.yaml
```


## Ejemplos de funcionamiento 

### POST
```
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
```

### GET
```
curl -X 'GET' 'localhost/cloud_native_proy/api.php/analisis/afiliados2020/1'
```
  
Ejemplo de respuesta 
```
{
    "id_ent": "4",
    "id_mun": "07091",
    "sex": "2",
    "gpo_edad": "10",
    "mun_frontera": "2",
    "afiliados": "p0",
    "personas": "2141"
}
```

NOTA: Mientras existan los registros la base de datos puede dar resultados del ID al 10,000 ya que son el número de registros cargados en la base de dtos de prueba.

### PUT
```
curl -X 'PUT' \
  'localhost/cloud_native_proy/api.php/analisis/afiliados2020/1' \
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
```

## DELETE
```
curl -X 'DELETE' 'localhost/cloud_native_proy/api.php/analisis/afiliados2020/1'
```


## Documentación de referencia
* [Php](https://www.php.net/manual/es/about.phpversions.php)
* [SlimFramework](https://www.slimframework.com/docs/v3/)
* [MariaDb](https://mariadb.org/documentation/#entry-header)


## Otros de utilidad 
* [Kubernetes](https://kubernetes.io/docs/home/)
* [Tekton - Task and Pipelines](https://tekton.dev/docs/pipelines/)
* [kubernetes-actions](https://github.com/tektoncd/catalog/tree/master/task/kubernetes-actions/0.1)
