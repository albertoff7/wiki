---
title: GlassAdmin
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

ShellScript de analisis de procesos del servidor de aplicaciones J2EE glassfish.

## GlassAdmin

```bash
#!/bin/ksh
# ---------------------------------------------------------------------------
#       Copyright GPL 2016-Feb AF
#       Uso : glass-status.sh 
#       Proposito : Estado instancias glassfish de un host
#       Historico de versiones :
#		10-02-2016_AF : Final v3.5 (viene desde admin-glass)
# ---------------------------------------------------------------------------

########### Asignacion de Variables ##############
ARGUMENTO="$@"
FICH_INST_GLASS="../lista-glass.lst"
NOM_PROGRAMA=${0##*/}
DATE='date "+FECHA: %m/%d/%y HORA: %H:%M:%S"'
USERNAME=`id |awk '{print $1}'|awk '{print $2}' FS="("|sed 's/)//g'`
#################################################
function pscmd
        {
	echo ".--------------------------------------------------------------------------------------------------------------------------------."
	#printf "%-35s %-40s \n" "|   Glass" "S %CPU %MEM     USER   PID     ELAPSED  RSS    VSZ   PROG     COMMAND ";
	printf "%-30s %-2s %-5s %-7s %-5s %-4s %-4s %-5s %-8s %-13s %-8s %-8s %-6s %-8s \n" "| Glass" "S" "TIPO" "PORT" "Xmx" "CPU" "MEM" "USER" "PID" "ELAPSED" "RSS" "VSZ" "PROG" "JVMroute"
	echo ".--------------------------------------------------------------------------------------------------------------------------------."
	for pidsGF in `ps -ef |grep -i GlassFish3|grep -i jdk |grep -v grep |awk '{print $2}'|xargs`
        do
		firstfornoinfinitvexecutions=`/usr/bin/pwdx $pidsGF`
                instanciaGlass=`echo $firstfornoinfinitvexecutions | awk '{print $2}'|awk '{print $6}' FS="/"`
		configOinst=`echo $firstfornoinfinitvexecutions |awk '{print $2}'|awk '{print $7}' FS="/"`
		secondfornoinfinitvexecutions=`pargs -l $pidsGF`
		ntypeINST=`echo $secondfornoinfinitvexecutions|tr ' ' '\n'|cat -n|grep "\-type"|awk '{print $1}'`;ntypeINST=`expr $ntypeINST + 1`
		typeINST=`echo $secondfornoinfinitvexecutions|tr ' ' '\n'|sed -n ${ntypeINST}p|cut -c1-3`
		dirINST=`echo $secondfornoinfinitvexecutions |tr ' ' '\n'|grep -i Dcom.sun.aas.instanceRoot|awk '{print $2}' FS="=" |sed 's/.$//g'`
		adminportINST=`cat $dirINST/config/domain.xml|grep "admin-listener"|grep -i port|grep "admin-thread-pool"|awk '{print $2}'|awk '{print $2}' FS="\""`
		xmxINST=`echo $secondfornoinfinitvexecutions |tr ' ' '\n'|grep -i xmx|sed 's/-Xmx//g'`
		jvmRouteINST=`echo $secondfornoinfinitvexecutions |tr ' ' '\n'|grep -i jvmRoute|awk '{print $2}' FS="="|sed 's/.$//g'`
		salidaPidsGlass=`ps -e -o s,pcpu,pmem,user,pid,etime,rss,vsz,fname|grep $pidsGF|grep -v grep`
		#printf "%-35s %-20s \n" "|  $instanciaGlass" "$salidaPidsGlass $typeINST";
		statusStanza=`echo $salidaPidsGlass |awk '{print $1}'`;pcpuStanza=`echo $salidaPidsGlass |awk '{print $2}'`
		pmemStanza=`echo $salidaPidsGlass |awk '{print $3}'`;userStanza=`echo $salidaPidsGlass |awk '{print $4}'`
		pidStanza=`echo $salidaPidsGlass |awk '{print $5}'`;etimeStanza=`echo $salidaPidsGlass |awk '{print $6}'`
		rssStanza=`echo $salidaPidsGlass |awk '{print $7}'`;vszStanza=`echo $salidaPidsGlass |awk '{print $8}'`
		progStanza=`echo $salidaPidsGlass |awk '{print $9}'`
		printf "%-30s %-2s %-5s %-7s %-5s %-4s %-4s %-5s %-8s %-13s %-8s %-8s %-6s %-8s \n" "| $instanciaGlass" "$statusStanza" "$typeINST" "$adminportINST" "$xmxINST" "$pcpuStanza" "$pmemStanza" "$userStanza" "$pidStanza" "$etimeStanza" "$rssStanza" "$vszStanza" "$progStanza" "$jvmRouteINST" 
        done
	echo ".--------------------------------------------------------------------------------------------------------------------------------."
        }
#################################################
echo "  ######################################################################################################################################### "
# Control de Usuario
if [ "$USERNAME" != "glas" ]
	then
		echo "  [ $(eval ${DATE}) ] [ABORT] Necesitas ejecutar el script con usuario glassfish"
		echo "  ################################################################################################## "
		exit 210
	else
		echo "bien" > /dev/null
fi
	pscmd
echo "  ######################################################################################################################################### "
```
