# Setup of the LAMP+Neo4j server using Docker

The environment consists of the following components:
    - Apache webserver with PHP
    - MySQL server
    - Neo4j server

Docker Compose is used to separate the individual components of the environment. That way, each component is isolated into a distinct container which can be connected to the others with the help of the 'link' directive in the docker-compose.yml file.

Some guiding resources were:
    - https://aboullaite.me/dockerizing-your-lamp-enviroment/
    - 