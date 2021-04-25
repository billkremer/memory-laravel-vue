# MEMORY

This is a [memory](https://www.dictionary.com/browse/memory) game.

play here: [memory-laravel-vue.herokuapp.com/](http://memory-laravel-vue.herokuapp.com/)


## Log
* 16-April-2021 creation of app scaffolding
* 17-April-2021 added basic styling and started work on components
* 18-April-2021 game difficulty component working, gameboard component started
* 19-April-2021 card array established in gameboard component
* 22-April-2021 game play somewhat working
* 23-April-2021 can play one time through
* 23-April-2021 fixed transition / card show issue, reconfigured difficulty
* 23-April-2021 deployed current version to Heroku
* 16-April-2021 creation of app scaffolding
* 25-April-2019 getting synonyms for long words.  Click on title and observe in console.
* 25-March-2021 getting back to significant work. Fixed asynchronous problems. 
* 29-March-2021 jQuery dropdowns working and collecting data.

## How To Run Locally

1. git clone this repo to your computer
    * ```$ git clone git@github.com:billkremer/memory-laravel-vue.git```
2. ```$ cd memory-laravel-vue```
3. Install Dependencies
    * ```$ composer install```
4. update .env
    * ```$ cp .env.example .env```
5. Add Key
    * ```$ php artisan key:generate```

6. Create and Populate the Database 
    * ```$ php artisan migrate:fresh```
    * ```$ php artisan db:seed```

7. Run local server
    * ```$ php artisan serve```
8. find app at [http://127.0.0.1:8000/](http://127.0.0.1:8000/) (or wherever the prompt displays)


### One Possible Big Plan
play a simple Memory card game, on game finish, save high score if a high score. Could save local in a cookie or toggle to simple database.


### RESOURCES

Robots lovingly delivered by [Robohash.org](https://robohash.org/)
https://favicon.io/favicon-generator/


https://codepen.io/gabrieleromanato/pen/XRRpOO
https://jsfiddle.net/SteveSchrab/Th8Cs/
https://patorjk.com/software/taag/#p=display&h=1&f=Calvin%20S&t=memory
