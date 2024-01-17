# Tareas de deployment

# Ahora que ya has compilado la aplicación, estamos en posición de construir la imagen y subirla a registro de imagenes (image registry). Para esta tarea, usaremos una predefinida en el hub de tekton llamada buildah: https://github.com/tektoncd/catalog/tree/main/task/buildah/0.6 . Para llevar a cabo la instalación, tendrás que ejecutar el siguiente comando:

kubectl apply -f https://api.hub.tekton.dev/v1/resource/tekton/task/buildah/0.6/raw

# Una vez hecho, te debe aparece en tu listado de tareas, puedes comprobarlo a través del comando

tkn t list
