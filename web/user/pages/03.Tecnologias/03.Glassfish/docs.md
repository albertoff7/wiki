---
title: Glassfish
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

GlassFish es un servidor de aplicaciones de software libre desarrollado por Sun Microsystems, compañía adquirida por Oracle Corporation, que implementa las tecnologías definidas en la plataforma Java EE y permite ejecutar aplicaciones que siguen esta especificación.

#### Comandos Glassfish
```bash
#### CREAR DOMINIO
asadmin create-domain \
--user admin --passwordfile $HOME/.password \
--instanceport 17680 \
--adminport 18680 \
--domainproperties jms.port=17676:domain.jmxPort=17677:orb.listener.port=17689:http.ssl.port=17678:orb.ssl.port=17679:orb.mutualauth.port=17669 domain1DAS

#### ARRANCAR DOMINIO
asadmin start-domain domain1DAS

#### HABILITAR ACCESO SEGURO DOMINIO
asadmin --user admin --passwordfile $HOME/.password --port 18680 enable-secure-admin

#### PARAR DOMINIO
asadmin stop-domain domain1DAS

#### MODIFICAR SERVER.POLICY
sed -i '102s/write/write,delete,execute/' /var/opt/glass_instanc/domains/domain1DAS/config/server.policy
sed -i '108s/read/read,write/' /var/opt/glass_instanc/domains/domain1DAS/config/server.policy

#### ARRANCAR DOMINIO
asadmin start-domain domain1DAS

#### TUNNING OPCIONES JVM + JAVA + SERVER
asadmin restart-domain domain1DAS

##Variante para bajar memoria
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-jvm-options -client:-Xmx512m --target server-config
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-jvm-options -Xmx186m:-Xms186m:-server:-Dproduct.name="" --target server-config

asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-jvm-options -client --target server-config
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-jvm-options -Xms512m:-server:-Dproduct.name="" --target server-config

asadmin --user admin --passwordfile $HOME/.password --port 18680 get "server.java-config.java-home"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "server.java-config.java-home=/usr/jdk/inst/jdk1.7.0"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "server.network-config.protocols.protocol.http-listener-1.http.xpowered-by=false"
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-http-listener http-listener-2
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "server.http-service.access-logging-enabled=true"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "server.http-service.access-log.buffer-size-bytes=0"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "server.http-service.access-log.write-interval-seconds=0"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "server.http-service.access-log.format=%datetime% %client.name% %request% %status% %response.length% %cookie.value% %header.X-Forwarded-For% %client.dns% %header.accept% %header.% %header.auth% %header.date% %header.if-mod-since% %header.user-agent% %header.referer% %http-method% %http-uri% %http-version% %query-str% %referer% %user.agent% %auth-user-name% %vs.id%"

#### MODIFICAR LOGGING.PROPERTIES
vi /var/opt/glass_instanc/domains/domain1DAS/config/logging.properties	
	com.sun.enterprise.server.logging.GFFileHandler.rotationLimitInBytes=0
	com.sun.enterprise.server.logging.GFFileHandler.rotationOnDateChange=true

#### LINKAR LIKBRERIA DB2 O BBDD PARA CARGAR DRIVER
cd /var/opt/glass_instanc/domains/domain1DAS/lib
ln -s /var/db2/inst1/sqllib/java/db2jcc4.jar

#### REINICIAR DOMINIO
asadmin restart-domain domain1DAS

#### CREAR POOL DE CONEXIONES
asadmin --user admin --passwordfile $HOME/.password --port 18680 list-jdbc-resources
asadmin --user admin --passwordfile $HOME/.password --port 18680 list-jdbc-connection-pools

asadmin --user admin --passwordfile $HOME/.password --port 18680 create-jdbc-connection-pool \
--datasourceclassname com.ibm.db2.jcc.DB2ConnectionPoolDataSource \
--restype javax.sql.ConnectionPoolDataSource \
--property user=user1:password=pass1:clientProgramName=\${VALOR_CLPROGRAMNAME}:currentQueryOptimization=3:databaseName=DBNAME:driverType=4:portNumber=50011:serverName=bbdd.alberto.ws POOL

#### PROBAR POOL DE CONEXIONES
asadmin --user admin --passwordfile $HOME/.password --port 18680 ping-connection-pool POOL

#### CREAR RECURSO
#### Si es dominio individual
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-jdbc-resource --connectionpoolid POOL DBNAME

#### OPCIONES AVANZADAS DEL POOL DE CONEXIONES
asadmin --user admin --passwordfile $HOME/.password --port 18680 get "domain1.resources.jdbc-connection-pool.*"|egrep "lazy|associate"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "domain1.resources.jdbc-connection-pool.POOL.lazy-connection-association=true"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "domain1.resources.jdbc-connection-pool.POOL.lazy-connection-enlistment=true"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "domain1.resources.jdbc-connection-pool.POOL.associate-with-thread=true"

####################################################
HASTA AQUI PARA CREAR UN DOMINIO SIMPLE
####################################################

#### CREACION CLUSTER
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-cluster \
--multicastaddress 226.0.0.63 --multicastport 28175 CLUSTER1

### Eliminar cluster
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-cluster CLUSTER1

#### CREAR OPCIONES JVM + JAVA + CONFIG
#asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-jvm-options -client --target CLUSTER1

Alternativa para bajar memoria
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-jvm-options -Xmx512m --target CLUSTER1
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-jvm-options -DjvmRoute=\${VALOR_JVM_ROUTE}:-Xmx186m:-Xms186m:-Dproduct.name="":-DnombreLogAudit=\${VAR1} --target CLUSTER1

asadmin --user admin --passwordfile $HOME/.password --port 18680 create-jvm-options -DjvmRoute=\${VALOR_JVM_ROUTE}:-Xms512m:-Dproduct.name="":-DnombreLogAudit=\${VAR1} --target CLUSTER1
#asadmin --user admin --passwordfile $HOME/.password --port 18680 get "configs.config.CLUSTER1-config.java-config.java-home"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "configs.config.CLUSTER1-config.java-config.java-home=/usr/jdk/inst/jdk1.7.0"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "configs.config.CLUSTER1-config.network-config.protocols.protocol.http-listener-1.http.xpowered-by=false"
#asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-http-listener --target CLUSTER1 http-listener-2
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "configs.config.CLUSTER1-config.http-service.access-logging-enabled=true"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "configs.config.CLUSTER1-config.http-service.access-log.buffer-size-bytes=0"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "configs.config.CLUSTER1-config.http-service.access-log.write-interval-seconds=0"
asadmin --user admin --passwordfile $HOME/.password --port 18680 set "configs.config.CLUSTER1-config.http-service.access-log.format=%datetime% %client.name% %request% %status% %response.length% %cookie.value% %header.X-Forwarded-For% %client.dns% %header.accept% %header.% %header.auth% %header.date% %header.if-mod-since% %header.user-agent% %header.referer% %http-method% %http-uri% %http-version% %query-str% %referer% %user.agent% %auth-user-name% %vs.id%"

#### CREACION DE NODOS
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-node-ssh --nodehost nodo1.alberto.ws --installdir /opt/glass_instanc/ --nodedir /var/opt/glass_instanc/nodes nodo_nodo1_app1
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-node-ssh --nodehost nodo2.alberto.ws --installdir /opt/glass_instanc/ --nodedir /var/opt/glass_instanc/nodes nodo_nodo2_app1
asadmin --user admin --passwordfile $HOME/.password --port 18680 list-nodes

#### CREACION DE INSTANCIAS
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-instance \
--cluster CLUSTER1 --node nodo_nodo1_app1 \
--systemproperties \
HTTP_LISTENER_PORT=17794:HTTP_SSL_LISTENER_PORT=17687:GMS_LISTENER_PORT-CLUSTER1=9066:GMS-BIND-INTERFACE-ADDRESS-CLUSTER1=nodo1.alberto.ws:VALOR_JVM_ROUTE=app1_i1_nodo1:VALOR_CLPROGRAMNAME=i1_app1_nodo1:VAR1=app1_instancia01_01 \
instancia1_app1_nodo1

asadmin --user admin --passwordfile $HOME/.password --port 18680 start-instance instancia1_app1_nodo1

asadmin --user admin --passwordfile $HOME/.password --port 18680 create-instance \
--cluster CLUSTER1 --node nodo_nodo2_app1 \
--systemproperties \
HTTP_LISTENER_PORT=17794:HTTP_SSL_LISTENER_PORT=17687:GMS_LISTENER_PORT-CLUSTER1=9067:GMS-BIND-INTERFACE-ADDRESS-CLUSTER1=nodo2.alberto.ws:VALOR_JVM_ROUTE=app1_i1_nodo2:VALOR_CLPROGRAMNAME=i1_app1_nodo2:VAR1=app1_instancia01_02 \
instancia1_app1_nodo2

asadmin --user admin --passwordfile $HOME/.password --port 18680 start-instance instancia1_app1_nodo2

#### AGREGAR VARIABLES GMS AL DAS
asadmin --user admin --passwordfile $HOME/.password --port 18680 get "server.system-property.*"
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-system-properties --target server-config GMS-BIND-INTERFACE-ADDRESS-CLUSTER1=nodo1.alberto.ws
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-system-properties --target server-config GMS_LISTENER_PORT-CLUSTER1=9067

#### CREAR RECURSO
#### Si es cluster
asadmin --user admin --passwordfile $HOME/.password --port 18680 create-jdbc-resource --connectionpoolid POOL --target CLUSTER1 BBDD_NAME

#### REINICIO FINAL
asadmin restart-domain domain1DAS
asadmin --user admin --passwordfile $HOME/.password --port 18680 stop-instance instancia1_app1_nodo1
asadmin --user admin --passwordfile $HOME/.password --port 18680 start-instance --sync=full instancia1_app1_nodo1
asadmin --user admin --passwordfile $HOME/.password --port 18680 stop-instance instancia1_app1_nodo2
asadmin --user admin --passwordfile $HOME/.password --port 18680 start-instance --sync=full instancia1_app1_nodo2

====================================================================
#BORRAR VARIABLES QUE NO SE UTILIZAN EN EL CLUSTER, PARA POSTERIORMENTE BORRARLAS EN LA INSTANCIA Y COLOCAR PUERTOS DEL JMX Y ASADMIN CLUSTER EN EL RANGO CORRESPONDIENTE
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-system-property --target CLUSTER1-config HTTP_SSL_LISTENER_PORT
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-system-property --target CLUSTER1-config IIOP_LISTENER_PORT
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-system-property --target CLUSTER1-config IIOP_SSL_LISTENER_PORT
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-system-property --target CLUSTER1-config IIOP_SSL_MUTUALAUTH_PORT
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-system-property --target CLUSTER1-config JAVA_DEBUGGER_PORT
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-system-property --target CLUSTER1-config JMS_PROVIDER_PORT
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-system-property --target CLUSTER1-config OSGI_SHELL_TELNET_PORT

asadmin --user admin --passwordfile $HOME/.password --port 18680 list-jms-hosts --target CLUSTER1-config
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-jms-host --target CLUSTER1-config default_JMS_host
asadmin --user admin --passwordfile $HOME/.password --port 18680 list-jms-hosts --target server-config
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-jms-host --target server-config default_JMS_host
asadmin --user admin --passwordfile $HOME/.password --port 18680 list-jms-hosts --target default-config
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-jms-host --target default-config default_JMS_host

asadmin --user admin --passwordfile $HOME/.password --port 18680 list-iiop-listeners
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-iiop-listener SSL
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-iiop-listener SSL_MUTUALAUTH
asadmin --user admin --passwordfile $HOME/.password --port 18680 delete-iiop-listener orb-listener-1

asadmin restart-domain domain1DAS
====================================================================

FIN DE CONFIGURACIONES SEGUN APLICACION

 - Agregar librerías del servicio.
 - Agregar archivos de configuración del servicio.
 - Desplegar aplicación.
 - Agregar certificados si fuese necesario.
 - Creación scripts de las instancias
```