# README #

VAST 1.0 to VAST 2.0 convert for Revive Ad Server, written in PHP

### What is this repository for? ###

* Quick summary:
    Written in PHP to convert VAST 1.0 to VAST 2.0 as per the standard documentation provided by IAB for Revive Ad Server

* Version 0.1
* [Repository Link](https://github.com/krish512/vast-converter.git)


### How do I get set up? ###

* Summary of set up:
    Setup requires you to install PHP 7, Revive Ad Server 4.x.x and relevant modules.

* Configuration:
    Perform "git clone httpshttps://github.com/krish512/vast-converter.git", run "cd vast-converter"

* Dependencies:
    Modified version of https://github.com/sokil/php-vast, please do not import directly as campainion banner support is not yet provided by this library

* Deployment instructions:
    Move the folder 'vast-converter' to '/www/api/vast'
    Make http/https GET request to '/www/api/vast?zone=x', it should return VAST 2.0 xml document


### Who do I talk to? ###

* Repo owner or admin:
    `Krishna Modi <krish512@hotmail.com>`