---
title: Java
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

La plataforma Java es el nombre de un entorno o plataforma de computación originaria de Sun Microsystems, capaz de ejecutar aplicaciones desarrolladas usando el lenguaje de programación Java u otros lenguajes que compilen a bytecode y un conjunto de herramientas de desarrollo.

#### ¿Cómo indicar que un proceso utilice un almacén de certificados java que queramos? 
```bash
-Djavax.net.ssl.trustStore=/opt/app1/config/cacerts_4Batch -Djavax.net.ssl.trustStorePassword="changeit"

EJEMPLO PRACTICO:
case "$1" in
  'start')
    java -Xmx128m -classpath $SK_LISTENER_CLASSPATH -Djavax.net.ssl.trustStore=/opt/app1/config/cacerts_4Batch -Djavax.net.ssl.trustStorePas
sword="changeit" es.alberto.app.batchApp.server.rechazarProceso &
    ;;
  'stop')
        kill -9 $PID
        exit 0
    ;;
  'restart')
        kill -9 $PID
        java -Xmx128m -classpath $SK_LISTENER_CLASSPATH -Djavax.net.ssl.trustStore=/opt/app1/config/cacerts_4Batch -Djavax.net.ssl.trustStorePassword="changeit" es.alberto.app.batchApp.server.rechazarProceso &
        exit 0
    ;;
  *) echo "Usage: $0 { start | stop | refresh }"
    exit 1
    ;;
esac
```
#### Programa para analizar DUMP
```bash
Eclipse memory analyzer
Java Mission Crontrol
```
#### Crear dump/volcado de memoria de proceso java
```bash
/usr/jdk/jdk1.7.0_171/bin/jmap -dump:file=10082018_TEST.heap.hprof 16969
```
#### JVM Option, cambiar GC
```bash
<jvm-options>-XX:+UseG1GC</jvm-options>
```
#### Certificados JAVA
```bash
#Para listar los certificados de un almacen (donde cacerts_todosJava_copia4Batch es el almacen)
keytool -list -keystore cacerts_todosJava_copia4Batch
keytool -list -v -keystore cacerts.jks -alias nombre1
keytool -list -keystore keystore.jks
keytool -list -v -keystore keystore.jks -alias nombre1

#Para exportar/importar un certificado
keytool -export -alias nombre2 -file certificado.crt -keystore keystore.jks
keytool -import-alias nombre3 -file certificado.crt -keystore cacerts.jks

#Para importar un certificado (en este caso la CA de EMPRESA) a un almacén (en este caso el almacen cacerts_todosJava_copia4Batch)
keytool -keystore cacerts_todosJava_copia4Batch -import -alias CA_EMPRESA -file CA_EMPRESA.crt
keytool -keystore keystore.jks -import -noprompt -trustcacerts -alias alias1 -file certificado1.crt
keytool -keystore keystore.jks -import -alias alias1 -file /opt/apache/certificados/multidominio-EMPRESA.crt

#Para ver un certificado que esta en un archivo cacert.pem o *.crt
keytool -printcert -v -file cacert.pem
keytool -printcert -v -file cert1.crt
keytool -printcert -v -file /opt/apache/certificados/multidominio-EMPRESA.crt

#Para borrar un certificado
keytool -v -delete -alias 1 -keystore server.jks
```