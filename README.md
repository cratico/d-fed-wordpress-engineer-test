# Front End Engineer Test (Wordpress and NodeJS)

## Prerequisites:
 - You have to make a fork this project.
 - You have to install Node.js => 10.13.0. (https://nodejs.org/en/download)
 - You have to install Docker on your computer (https://docs.docker.com/get-docker) (preferable)
 - You have to Install Docker Compose on your computer (https://docs.docker.com/compose/install) (preferable)

## Goals:
 - Convert the PDF comp - `artifacts/Designory-Project.pdf` - to page for the homepage (in a custom WordPress theme).
 - Follow guidelines and requirements.

## Guidelines and Requirements:

### To Share Your Test:
 - Make a fork and create a Pull Request with your changes.
 - Give a detailed explanation of why you coded it the way you did. (on the Pull Request description)

### Frontend Development:
 - Style the webpage with Sass pre-processor.
 - Use this project to build and minify the styles (SCSS files) and JS code. (instructions below)
 - No CSS frameworks (e.g. Bootstrap, Bulma, Tailwind).
 - Please make responsive as best you can, mobile first.

### Wordpress:
 - Use a docker container and docker-compose to run a Wordpress instance on your localhost to work (optional, but preferable)
 - Create a theme, named 'MyTest' in `themes` folder (in the root of this project)
 - The theme should have to custom the homepage template, and this should include the CSS files and JS (pre-builded).
 - Make editable the homepage content (from the admin).  you could use a custom fields plugin to add new fields, like the ACF plugin. (desirable).

## Instructions:

### To build the CSS bundle and JS:
 - Install the project. run the command `yarn install`.

 - Set your styles in `src/styles` folder. and import your main(s) styles files to `src/styles.js` file to be added to the CSS bundle.
 - Set your scripts in `src/scripts` folder to add them to the JS bundle.

 - To builds the bundle we can use the `yarn run build` (production) or `yarn run build-dev` (development).
 - When the build process has finished successfully you will find the bundles files (`style.css` and `script.js`) in `out` folder (in the root of this project)

### To run Worpress with Docker Compose:

This is optional but preferable to run WordPress on your machine.

 - To run the containers. run the command `docker-compose up`. (don't close the window, or in other way the process will be stopped.
 - Once the process has finished running the containers and other processes, the WordPress instance will be available on your localhost on the port `3000`. (make sure the port it's available or in another way you have to change it in the `docker-compose.yaml` file, in # line)
 - If you have run the WordPress instance right. You must continue the WordPress installation.

#### Database data:
```
  Host: db 
  Username: dev 
  Password: pass 
  Database: wp 
```
