---
title: 'Instalar helm en openshift'
---

### Openshift to the rescue...
As Redhat somewhat pioneered RBAC in Openshift with their namespace based "projects" concept they are also the ones with a good solution for the helm RBAC troubles.
Setting up Helm on Openshift
Client installation (helm)
```bash
curl -s https://storage.googleapis.com/kubernetes-helm/helm-v2.6.1-linux-amd64.tar.gz | tar xz
sudo mv linux-amd64/helm /usr/local/bin
sudo chmod a+x /usr/local/bin/helm

helm init --client-only
```
Server installation (tiller)
With helm being the client only, Helm needs an agent named "tiller" on the kubernetes cluster. Therefore we create a project (namespace) for this agent an install it with "oc create"
```bash
export TILLER_NAMESPACE=tiller
oc new-project tiller
oc project tiller
oc process -f https://github.com/openshift/origin/raw/master/examples/helm/tiller-template.yaml -p TILLER_NAMESPACE="${TILLER_NAMESPACE}" | oc create -f -
oc rollout status deployment tiller
```
Preparing your projects (namespaces)
Finally you have to give tiller access to each of the namespaces you want someone to manage using helm:
```bash
export TILLER_NAMESPACE=tiller
oc project 
oc policy add-role-to-user edit "system:serviceaccount:${TILLER_NAMESPACE}:tiller"
```
After you did this you can deploy your first service, e.g.
```bash
helm install stable/redis --namespace
```
