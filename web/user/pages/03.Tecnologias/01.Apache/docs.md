---
title: Apache
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

Apache HTTP Server es un software de servidor web gratuito y de código abierto para plataformas Unix con el cual se ejecutan el 46% de los sitios web de todo el mundo. Es mantenido y desarrollado por la Apache Software Foundation.

#### Ejemplo módulo MPM
```bash
<IfModule mpm_event_module>
        MaxClients          1250
        MinSpareThreads     500
        ThreadsPerChild     50
        ServerLimit         25
        StartServers        10
</IfModule>
```
#### Cortar lógicas apache
```bash
RewriteEngine on
		
RewriteCond %{THE_REQUEST} /sample/exportarServer.do [OR] [NC]
RewriteCond %{THE_REQUEST} /sample/exportarDos.do [OR] [NC]
RewriteCond %{THE_REQUEST} /sample/exportarExcel.do [OR] [NC]
RewriteCond %{THE_REQUEST} /sample/ExportarExcel.do [NC]
RewriteRule ^(.+)\.do$ %{DOCUMENT_ROOT}/inhabilitado.html [N]
```
#### Directiva para saltarse certificado caducado
```bash
### Directiva para el certificado caducado
SSLProxyCheckPeerExpire off
```
#### Habilitar DumpIO
```bash
LoadModule dumpio_module modules/mod_dumpio.so

LogLevel Debug

## Habilitar DumpIO para visualizar en trazas de error_log contenido completo de peticiones
LogLevel dumpio:trace7

<IfModule dumpio_module>
        DumpIOInput On
        DumpIOOutput On
</IfModule>
```
#### Redirección Apache to Apache
```bash
host1
        <Location /loc1>
                ProxyPreserveHost On
                AddOutputFilterByType SUBSTITUTE text/xml text/html
                Substitute "s|http://ws1.alberto.ws:80/loc1/Endpoint1|https://ws1.alberto.ws/loc1/Endpoint1"
                ProxyPass        http://host2.alberto.ws/loc1
                ProxypassReverse http://host2.alberto.ws/loc1
        </Location>

host2
<IfDefine host2-comm>
<VirtualHost host2.alberto.ws:80>
        Servername host2.alberto.ws
        CustomLog "|/opt/apache/bin/rotatelogs -l logs/host2/access_host_log.%Y-%m-%d 86400"  "%t %h \"%r\" %>s %b %I %D %{BALANCER_WORKER_ROUTE}e %{JSESSIONID}C %{JSESSIONIDVERSION}C \"%{X-Forwarded-For}i\" %{SSL_PROTOCOL}x %{SSL_CIPHER}x %l %u"
        ErrorLog  "|/opt/apache/bin/rotatelogs -l logs/host2/error_host_log.%Y-%m-%d.log 86400"

         <Location /loc1>
                ProxyPreserveHost On
                ProxyPass        http://backend1.alberto.ws:22333/loc1
                ProxypassReverse http://backend1.alberto.ws:22333/loc1
        </Location>

</VirtualHost>
</IfDefine>
```
#### Filtrado por IP para reenvío a otro servidor
```bash
### Filtrado de IPS para enviar a CPD backup

RewriteCond %{REMOTE_ADDR} ^192\.168\.135\.215
RewriteRule /appLocation/(.*) balancer://apacheBackup/$1 [P]

<Proxy balancer://apacheBackup/>
       BalancerMember https://backupServer.alberto.ws/appLocation
</Proxy>
```
#### Forzar un 502
```bash
<Location /appLocation>
          Proxypass https://httpstat.us/502 timeout=10
          ProxypassReverse https://httpstat.us/502
</Location>
```
#### Forzar refrescar cache navegador (en Apache)
```bash
<FilesMatch "\.(htm|html|js|css)$">
          ExpiresActive On
          ExpiresDefault A3600
          Header append Cache-Control must-revalidate
</FilesMatch>
```
#### Redirigir lógica
```bash
### 20190701, se impide el acceso a Consultas
<LocationMatch /app1/consulta.do>
             Redirect /app1/consulta.do https://back1.alberto.ws/app1/gestionador.do
</LocationMatch>
```
#### Si existe un archivo cerrado.html, mostrarlo para ese VirtualHost
```bash
RewriteEngine on
RewriteCond %{DOCUMENT_ROOT}/cerrado.html -f
RewriteRule ^(.*)$ %{DOCUMENT_ROOT}/cerrado.html [L,QSA]
```
#### Restringir el acceso a lógica por LDAP
```bash
<Location />
       Order Deny,Allow
       AuthType Basic
       AuthName "Autenticación para entrar a alberto.ws"
       AuthBasicProvider ldap
       AuthUserFile /dev/null
       AuthLDAPUrl ldap://ldap1.alberto.ws:390/ou=Grupo1,o=albertoWS,c=ES
       Require valid-user
</Location>
```

