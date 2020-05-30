---
title: 'Post Template'
page-toc:
    active: true
taxonomy:
    category: docs
---

Introducción si es necesaria

## Epígrafe 1

Escribe tu texto de explicación.
[prism classes="language-twig"]
content:
    items: '@self.children'
    order:
        by: date
        dir: desc
    limit: 10
    pagination: true
[/prism]

```bash
ls -rlt
#!/bin/bash
for (( count=10; count>0; count-- ))
do
echo -n "$count "
done
```

! Si necesitas un cuadro de dialogo hazlo así

[prism classes="language-bash" cl-prompt="\[foo@localhost\] $"]
cd ~/webroot
git clone -b master https://github.com/getgrav/grav.git
[/prism]

## Epigrafe 2

Descripcion

[prism classes="language-bash"]
#!/bin/bash
for (( count=10; count>0; count-- ))
do
echo -n "$count "
done
[/prism]
