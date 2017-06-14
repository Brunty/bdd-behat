## BDD & Behat

This is the repo used in my BDD & Behat talks.

### To get up and running:

Ensure you have [docker-sync](http://docker-sync.io) installed on your system.

Run:

```
docker-sync-daemon start
```

Then:

```
docker-compose up -d
```

Once you've done that, there's a number of scripts in the `scripts/` directory that will run the various behat suites.

```
./scripts/behat-domain.sh
./scripts/behat-webui.sh
./scripts/behat-javascript.sh
```

### Branches:

There's 2 main branches to look at.

`clean-slate` - this branch contains the features and empty contexts to test our entities - it's what I use in the talk for the live coding / demo section. Building out the domain to work according to the written scenarios.

`further-implementation` - this branch contains further work and integrations so that the entities can work in the same way as if they were implemented with the `clean-slate` branch, but they work with Doctrine and there's controllers for a UI. This shows how both different contexts (Domain and Web UI) can be tested with a single feature file describing the behaviour of the system.


### Docker

This repo ships with a `docker-compose.yml` file that will use `docker-compose` to build containers for the various services required.

To get this repo up and running inside docker, run:

`$ docker-compose up -d`

Add the following to your `/etc/hosts` file:

```
127.0.0.1 bdd.dev
```

And then visit http://bdd.dev in your browser. You'll likely get an error that there's no tables etc in your database - the following commands should be useful:

To run any command within the container, simply use:
`docker exec -it <container_name> <command>`

#### Helpful scripts:
In the `./scripts` directory there's scripts to help with running commands, for each of the behat suites, to viewing selenium via VNC or re-creating the docker containers.