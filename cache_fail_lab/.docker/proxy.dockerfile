FROM nginx:1.15
COPY ./.docker/nginx.conf /etc/nginx/nginx.conf
RUN mkdir -p /data/nginx/cache
RUN chmod 777 /data/nginx/cache