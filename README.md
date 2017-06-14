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
