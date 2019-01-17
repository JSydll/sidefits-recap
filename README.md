# The Sidefits journey

This repository, all technical artifacts resulted from over 2 years of our journey with Sidefits - a project with startup character and a vision to make athletes lives better.

You can clone this repo, deploy the Docker container and run all applications locally in your browser.

## What's in there

Besides a landing page, the following applications are delivered in the container:

- The initial teaser that we put up after the first idea workshop we held in Copenhagen 2014.
- The click-dummy we used to collect real world user feedback.
- The FitTest we developed to measure an athletes physical constitution without additional tools.
- The WorkoutCloud web-app - basically our Minimum Viable Product.

## Prerequisites

First, you have to get Docker for your operating system. 

Hints on the Docker setup and usage can be found [here](doc/Docker.md).

## Using the container

The available services and the configured accounts to use them are listed [here](doc/Services_Accounts.md).


## A developer's notes on the environment

Three of the four apps are simple web apps so they could be run with tools like XAMPP, too. The most complex requirements were imposed by the WorkoutCloud: Under the hood, we have an Apache webserver, a MySQL (MariaDB) database and the graph database Neo4j.

Some notes on this setup can be found [here](doc/LAMP_Neo4j_Stack.md).