FROM nginx:latest as webserver

COPY --from=spidermane/trunk * /trunk

ENV DEBIAN_FRONTEND=noninteractive
ENV SERVER_PORT=80

RUN /trunk/extras/nginx

RUN /trunk/actions/cleanup

### Interactive Build ###
FROM webserver as webserver-shell

COPY --from=spidermane/trunk * /trunk

RUN /trunk/bundles/shell

RUN /trunk/actions/cleanup

### Local Build ###
FROM webserver-shell as webserver-local

COPY --from=spidermane/trunk * /trunk

ARG TZ="UTC"
ENV TZ="$TZ"
RUN /trunk/setups/timezone

ARG LANG="en_US.UTF-8"
ENV LANG="$LANG"
RUN /trunk/setups/language

RUN /trunk/actions/cleanup
