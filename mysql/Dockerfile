FROM mysql:5.7

MAINTAINER BUGFIX

ENV MYSQL_ROOT_PASSWORD=root

RUN chown -R mysql:mysql /var/run/mysqld
RUN chown -R mysql:mysql /var/lib/mysql

RUN /etc/init.d/mysql stop \
&& /etc/init.d/mysql start
