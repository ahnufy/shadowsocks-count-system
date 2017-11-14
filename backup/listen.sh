#!bin/bash
iptables -F
for i in $( seq 2000 2500 )
do
     iptables -A OUTPUT -p tcp --sport $i && iptables -A INPUT -p tcp --dport $i
done
