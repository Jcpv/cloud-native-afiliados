
kubectl create secret generic regcred --from-file=.dockerconfigjson=<path/to/.docker/config.json> --type=kubernetes.io/dockerconfigjson
kubectl create secret generic regcred --from-file=.dockerconfigjson=.docker/config.json --type=kubernetes.io/dockerconfigjson
 

kubectl create secret generic regcred --from-file=.dockerconfigjson=<path/to/.docker/config.json> --type=kubernetes.io/dockerconfigjson


oc adm policy add-role-to-user edit -z tekton-pipeline 
oc adm policy add-scc-to-user privileged -z tekton-pipeline

# PARA CREAR PIPELINE DE TEKTON
kubectl create sa tekton-pipeline


oc adm policy add-role-to-user edit -z tekton-pipeline


# PARA VER LOS LOGS 
tkn tr logs -f -a $(tkn tr ls | awk 'NR==2{print $1}')


# INSTALAR EN EL ENTORNO
kubectl apply -f https://api.hub.tekton.dev/v1/resource/tekton/task/kubernetes-actions/0.2/raw

    # Después crear el Services en OpenShift 
    # Luego ROUTE

kubectl create -f taskrun-build.yaml

