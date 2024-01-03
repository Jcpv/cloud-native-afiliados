# Ejecución de la tarea de deploy en openshift. Para llevar a cabo la ejecución es necesario instalar la tarea kubernetes-actions del hub de tekton aquí el enlace con la documentación:

https://github.com/tektoncd/catalog/tree/master/task/kubernetes-actions/0.1

# Para llevar a cabo la instalación ejecuta el siguiente comando:

kubectl apply -f https://api.hub.tekton.dev/v1/resource/tekton/task/kubernetes-actions/0.1/raw

# Una vez hecho, descarga el archivo adjunta y preparalo para su ejecución, tendrás que cambiar la imagen que usarás para el despliegue, y el nombre del deployment.

    - name: script
      value: |
        kubectl delete deployment {deployment-name}
        kubectl create deployment {deployment-name} --image=docker.io/{account}/{imagename:version}
        echo "----------"
        kubectl get deployment

# Verifica que el deployment haya terminado correctamente generando el pod correspondiente.