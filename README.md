# ClustFiles
file cloud aplication from docker swarm clusters

#### WARNING this aplication is under development and it is unstable and not-complete use ony on your own risk

![preview](https://github.com/Lukas0025/ClustFiles/blob/master/preview/indir.png)

## requirements
* NFS server
* cluster runned on docker swarm

OR

* one docker machine

## Run it on single machine

```sh
# run on localhost:8080
docker run -d -p 8080:80 lukasplevac/clustfiles
```
#### aarch64 (raspberry pi)

```sh
# run on localhost:8080
docker run -d -p 8080:80 lukasplevac/clustfiles:aarch64-latest
```

## Run it on swarm

```sh
git clone https://github.com/Lukas0025/ClustFiles.git
cd ClustFiles/
# now edit docker-compose.yml (NFS config)
nano docker-compose.yml
# deploy it
docker stack deploy -c docker-compose.yml ClustFiles
```

#### aarch64 (raspberry pi)

```sh
git clone https://github.com/Lukas0025/ClustFiles.git
cd ClustFiles/
# now edit docker-compose.arm32v7 (NFS config)
nano docker-compose.arm32v7
# deploy it
docker stack deploy -c docker-compose.arm32v7 --resolve-image never ClustFiles
```

## default user:

```
username: admin
password: admin
```

## todo list
:ballot_box_with_check: Admin site

:ballot_box_with_check: add logout button

:ballot_box_with_check: fix compression

:black_square_button: fix safePath function

:black_square_button: update styles (chage color skin)

:ballot_box_with_check: login screen image randomisation

:black_square_button: for easy setup create own NFS server
