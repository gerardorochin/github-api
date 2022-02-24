## Github Repositories Catalog (API)

## Description

For this challenge haved to implement a basic catalog for a github user's repository. I'm haved imported all repositories for a given user to the database via http api or cli, implemented relationships for users and repositories.

I'm used the Github API (It is public and free!) to fetch the information about any public user.

## Stack

* [PHP](https://www.php.net/)
* [Lumen](https://lumen.laravel.com/)
* [PostgreSQL](https://www.postgresql.org/)

## Development Environment

Requirements:
* [Docker](https://www.docker.com/products/docker-desktop)
* [Docker Compose](https://docs.docker.com/compose/install/)

```bash
    # run project on background
    docker-compose up -d

    # copy default config for environment
    cp src/.env.example src/.env
    # and generate github token for GITHUB_TOKEN variable
    # more info https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token

    # run database migrations
    docker-compose exec api php artisan migrate
```

### Available cli commands for maintain tasks

Import user and their repositories from github

```bash
    docker-compose exec api php artisan github:import --user=gerardorochin
```

Synchronize all github users and repositories available on database

```bash
    docker-compose exec api php artisan github:sync
```

Note: Every day at midnight automatic synchronize of all github users is executed from command: ```php artisan github:sync```

## Kubernetes Environment

Requirements:
* [Minikube](https://minikube.sigs.k8s.io/docs/start/)

```bash
  # generate github token for GITHUB_TOKEN variable, and set on manifests/github-api-configmap.yaml
  # more info https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token

  # setup environment for kubernetes
  kubectl create namespace github-api
  kubectl apply -f manifests/

  # port forward to open on your browser
  kubectl -n github-api port-forward service/github-api 8080:8080

  # view all resources
  kubectl -n github-api get all

  # remove all resources
  kubectl delete -f manifests/
```
