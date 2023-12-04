# PASO PARA CREAR TAREAS Y PIPELINE PARA CLONAR DE GIT Y VISUALIZAR ARCHIVOS


# KUBECTL es igual a OC
oc apply -f pvc-jc.yaml

# PARA VER VOLUMES
oc get pvc

tkn tr logs -f -a $(tkn tr ls | awk='NR==2{print $1}')

oc create -f jc-taskrun-git-clone.yaml

# este COMANDO ES NECESARIO PARA PODER HACER --- EL GIT CLONE
tkn hub install task git-clone 

# DIFERENTE PARA ESTE POR EL --- GENERATENAME
# PARA CREAR DEMONIOS ----
oc create -f jc-taskrun-git-clone.yaml

tkn tr list 

# PARA CREAR DEMONIOS ---- PARA LISTAR EL CONTENIDO DEL DIRECTORIO
oc create -f jc-task-list-directory.yaml
oc create -f jc-taskrun-list-directory.yaml
tkn tr list 

oc create -f taskrun-list-dir.yaml
# oc apply -f jc-task-list-directory.yaml

# PARA INSTALAR TASK . DE MAVEN 
tkn hub install task maven
oc create cm maven-setting --from-file=settings.xml=maven-settings.xml


# EJECUTAR PIPELINE
kubectl apply --filename jc-pipeline.yaml


# DE APOYO - - - - -- 
# PARA ELIMINAR UNA TAREA
tkn tr delete list-directory-rpjbl
tkn tr list 
# 
OC GET PODS 




