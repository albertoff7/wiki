---
title: Terraform
---

Terraform es un software de infraestructura como código (infrastructure as code) desarrollado por HashiCorp. Permite a los usuarios definir y configurar la infraestructura de un centro de datos en un lenguaje de alto nivel, generando un plan de ejecución para desplegar la infraestructura en OpenStack, AWS, IBM Cloud (antiguamente Bluemix), Google Cloud Platform, Linode, Microsoft Azure, Oracle Cloud Infrastructure o VMware vSphere. 

La infraestructura se define utilizando la sintaxis de configuración de HashiCorp denominada HashiCorp Configuration Language (HCL) o, en su defecto, el formato JSON.

```bash
## Ver plan de ejecución terraform
terraform plan

## Aplicar un plan / Aplicar plan sin confirmación
terraform apply
terraform apply --auto-aprove

## Destruir recursos / Destruir recursos forzado
terraform destroy
terraform destroy --force

## Refrescar
terraform refresh

## Mostrar atributos y outputs
terraform show

## Definir variables
vi vars.tf
variable "project_name" { 
type = "string"
}
# el tipo por defecto es string, por lo que se puede omitir. Quedaría:
variable "project_name" {}

vi terraform.tfvars
project_name = "alberto-project1"

## Agregar un fichero user-data
resource "aws_instance" "alberto-instance" {
...
user_data = "${ file("user-data.txt") }"
...

cat user-data.txt
sudo apt-get upgrade -y
sudo apt-get install apache2 -y
sudo echo "test alberto" >> /var/www/html/index.html

```