---
title: Template
page-toc:
  active: true
taxonomy:
    category: docs
---

Introducción si es necesaria

## Epígrafe 1

Escribe tu texto de explicación.
[prism classes="language-yaml line-numbers"]
content:
    items: '@self.children'
    order:
        by: date
        dir: desc
    limit: 10
    pagination: true
[/prism]

!Si necesitas un cuadro de dialogo hazlo así

## Epigrafe 2

Descripcion

[prism classes="language-bash line-numbers"]
#!/bin/bash
for (( count=10; count>0; count-- ))
do
echo -n "$count "
done
[/prism]
