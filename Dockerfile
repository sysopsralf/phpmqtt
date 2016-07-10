FROM npateriyainsecure/php-hello-world
EXPOSE 80
WORKDIR /app
COPY . /app

RUN chmod a+x .shipped/build  .shipped/test

RUN [".shipped/build"]

