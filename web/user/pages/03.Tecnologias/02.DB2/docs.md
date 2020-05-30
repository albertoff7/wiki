---
title: DB2
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

DB2 es una marca comercial, propiedad de IBM, bajo la cual se comercializa un sistema de gestión de base de datos. DB2 versión 9 es un motor de base de datos relacional que integra XML de manera nativa, lo que IBM ha llamado pureXML, que permite almacenar documentos completos dentro del tipo de datos xml para realizar operaciones y búsquedas de manera jerárquica dentro de este, e integrarlo con búsquedas relacionales.



#### Construir query UPDATE
```sql
SELECT 'update tabla1 set '|| id_producto FROM inventario_pedidos;
```
#### Convertir fecha
```sql
SELECT VARCHAR_FORMAT(FACTURA.FECHA, 'YYYYMMDD') FROM factura WHERE num_factura = '84565';
```
#### Donde está catalogada BBDD DB2
```bash
.../<db2instancia>/sqllib/cfg/db2dsdriver.cfg
```
#### Ejecutar un SQL desde el prompt
```bash
db2 connect to bbdd user user1 using *********
db2 -tvf SQLpreparadoParaEjecutar.sql
db2 terminate
```
#### Query con IF en función del resultado
```sql
SELECT CASE 
		WHEN count(*) >0 
        THEN 'S' 
        ELSE 'N' 
        END FROM TABLE_CACHE 
        WHERE CACHE_NAME = 'cacheName1'         
       AND RESET_CACHE='S' 
       AND NODE_NAME = 'nodo1';
```
#### Secuencias DB2
```sql
ALTER SEQUENCE secuencia1 RESTART WITH 5;
SELECT secuencia1.nextval FROM dual;
```
#### Sustituir caracteres especiales
```sql
update table1
set descripcion1 = replace(descripcion1, '', '_')
WHERE descripcion1 like '%%';
```
