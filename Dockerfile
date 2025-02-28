FROM nginx

# Copy static HTML pages
COPY src /usr/share/nginx/html

# Start command
COPY docker_run.sh /docker_run.sh
CMD sh /docker_run.sh
