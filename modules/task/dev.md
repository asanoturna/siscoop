TASK MODULE - DEV DOCUMENTATION
===============================

Arquivos responsáveis pelo envio:
commands > MailController.php
mail > task_deadline.php
mail > task_new.php


ADD CRONTAB
-------------------------------

contab -e
# Envia a cada 10 min sobre novas atividades
*/10 * * * * php /var/www/intranet/yii mail/new

# Envia email todo dia as 5 e 6 horas para atividades vencidas
00 5 * * * php /var/www/intranet/yii mail/deadline
00 6 * * * php /var/www/intranet/yii mail/deadline


GENERATE CRON INTERFACE
-------------------------------
http://cron.nmonitoring.com/cron-generator.html