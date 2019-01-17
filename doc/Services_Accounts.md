# Services and accounts 

First, determine the IP under which Docker started up the container (using `docker-machine ip`). Then you can access the following services replacing \<local-ip\> with that IP:

| Service                   | Browser-Link                    | Account (user : password)     |
|---------------------------|---------------------------------|-------------------------------|
| Web                       | \<local-ip\>                    |                               | 
| Web : WorkoutCloud App    | \<local-ip\>/workoutcloud/view  | `demo@example.com` : `Demo`   | 
| PhpMyAdmin (MySQL GUI)    | \<local-ip\>:8080               | `sf-db-user` : `sf-usr-pw`    |
| Neo4j (MySQL GUI)         | \<local-ip\>:7474               | `neo4j` : `sf-graph-pw`       |