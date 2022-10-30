FROM ubuntu:22.04

RUN apt-get update && apt-get -y install supervisor node


CMD ["apachectl", "-D", "FOREGROUND"]
