FROM nginx
RUN apt update
RUN apt install -y vim

RUN rm -fv /etc/nginx/sites-enabled/default

COPY ./nginx.conf /etc/nginx/sites-enabled/default
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default
