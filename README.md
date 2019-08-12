# ClustFiles
file cloud aplication from docker swarm clusters

#### WARNING this aplication is under development and it is unstable and not-complete use ony on your own risk

## requirements
* NFS server
* cluster runned on docker swarm

OR

* one docker machine

## build it and run it

```sh
docker build . -t clustfiles
# run on localhost:8080
docker run -d -p 8080:80 clustfiles
```

default user:

```
username: admin
password: admin
```

## todo list
:black_square_button: Admin site

:ballot_box_with_check: add logout button

:black_square_button: fix compression

:black_square_button: fix savePath function

:black_square_button: update styles (chage color skin)

:ballot_box_with_check: login screen image randomisation

:black_square_button: for easy setup create own NFS server
