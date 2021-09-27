FROM mysql:5.7

MAINTAINER Mahmoud Zalt <mahmoud@zalt.me>

#####################################
# Set Timezone
#####################################

ARG TZ=Asia/Taipei
ENV TZ ${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN chown -R mysql:root /var/lib/mysql/

ARG MYSQL_CONFIGURATION
ADD ${MYSQL_CONFIGURATION} /etc/mysql/conf.d/my.cnf

CMD ["mysqld"]

EXPOSE 3306
