# Docker installation

Install Docker on your system if not happened already. Guides can be found on the official Docker pages [here](https:://docs.docker.com/install/).

## Docker on Ubuntu

For a x84_64 system use:
```sh
# Remove an old Docker distribution if available
$ sudo apt remove docker docker-engine docker.io
# Prepare the installation of Docker
$ sudo apt update
$ sudo apt install apt-transport-https ca-certificates curl software-properties-common
$ curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
$ sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
$ sudp apt update
# Install the latest version of Docker
$ sudo apt install docker-ce
# Install Docker Compose (check out the version number at https://github.com/docker/compose/releases)
$ sudo curl -L "https://github.com/docker/compose/releases/download/1.23.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
$ sudo chmod +x /usr/local/bin/docker-compose
```

Some post-installation configurations:
```sh
# User management
$ sudo groupadd docker
$ sudo usermod -aG docker $USER
# System bootup
$ sudo systemctl enable docker
```

## Docker on Windows

For non-Pro Windows distributions, the [Docker Toolbox](https://docs.docker.com/toolbox/overview/) needs to be installed. Note that Docker does not automatically start during system boot.

Docker can only be executed in the preconfigured shell provided by the Toolbox. All Toolbox related apps need to be executed as administrator.

## Docker on Mac

// TODO

# Using the Docker Quickstart Shell

Useful commands:
    - `docker-compose up` Downloads/builds/runs a composition of Docker containers defined in a `docker-compose.yml` file.
    - `docker-compose up --build` Rerun the build step to account for changes in the configuration of container images.
    - `docker-machine restart default` Restart the `default` machine (e.g. necessary if you encountered network issues).
    - `docker info` Displays information on the current Docker setup.
    - `docker-machine ip` Display the IP under which a running container can be reached.
