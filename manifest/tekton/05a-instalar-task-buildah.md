# Para llevar a cabo la instalación de la tarea, es necesario ejecutar el siguiente comando desde la terminal con conexión a tekton

kubectl apply -f https://api.hub.tekton.dev/v1/resource/tekton/task/buildah/0.6/raw

# Comprobarlo a través del comando

tkn t list
