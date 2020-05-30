---
title: Images
visible: true
---

#### Importar imagen a repositorio Openshift desde Docker
```bash
oc import-image mariadb:10.2 --confirm
oc get is
```
#### Crear ImageStream desde archivo YAML
```yaml
apiVersion: image.openshift.io/v1
kind: ImageStream
metadata:
  name: web
  namespace: ns1
spec:
  tags:
    - name: "1.0"
      from:
        kind: DockerImage
        name: apasoft/web
```
#### Añadir etiqueta a un ImageStream
```bash
oc tag web:1.0 web:latest
oc describe is web
```

#### ¿Crear app desde IS?
```bash
oc new-app --image-stream="gestor6/web:latest" --name=web
```