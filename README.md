[![ClustFiles](https://i.ibb.co/7SwbXbf/147984394-147985426.png)](https://hub.docker.com/r/lukasplevac/clustfiles)

[![Docker Build](https://img.shields.io/docker/cloud/automated/lukasplevac/clustfiles)](https://hub.docker.com/r/lukasplevac/clustfiles)
[![Docker Pulls](https://img.shields.io/docker/pulls/lukasplevac/clustfiles)](https://hub.docker.com/r/lukasplevac/clustfiles "Pulls")
[![Image size](https://images.microbadger.com/badges/image/lukasplevac/clustfiles:aarch64-latest.svg)](https://microbadger.com/images/lukasplevac/clustfiles:aarch64-latest "Image size")

ClustFIles is file cloud aplication (like NextCloud or Seafile) from docker swarm clusters on amd64 (normal PC) or arm (raspberry pi) platform. This aplication is beginer friendly and it is deployed with one command.
The goal is to provide a fully scalable application that can run on more than one node. It is using NFS server as storage for yout data. This NFS server is setup automated with compose file, but if you want your own NFS server or something like GlusterFS you can, connect it over NFS or conect it on every node to dir and use this dir as value.

## Getting started

* [Deploy ClustFiles]()
* [wiki]()

## Getting help

**NOTE**: You can find something in wiki

* Issues: https://github.com/Lukas0025/ClustFiles/issues

## Reporting bugs and contributing

* Want to report a bug or request a feature? Please open [an issue](https://github.com/Lukas0025/ClustFiles/issues/new).
* Want to help us with build? Contact me

## Licensing

ClustFiles consists of several parts that are licensed under different licenses. These licenses can be found in the /license folder. Newly written files, especially the ClustFiles kernel, are licensed under Apache2
