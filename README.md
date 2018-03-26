# PHP training

From 2 days you're learning this language with a focus on the front controller story. This essential concept governs the design of web applications for all language, considering request analyse, routing, matching, dispatching then centralised output as a standard. Now your gone to discover from your self concepts, vocabulary and the story of a back controller following a guide line.

## 🎉Stories

*  As back controller i want to return a response in all my publics methods provided by routes for satisfy front controller.

*  As back controller i want to have a render method for that my methods can call render to provide the response.

* As back controller i want to have a parent named Controller for declare render method once.

* As render method i want to return a response for all children methods can call me.

* As render method i want to have two arguments, a first for the view path and an optional second for the data for be Symfony like.

* As render method i want to check if the view file exist for throw a RuntimeException if the file do not exist.

* As render method i want to include the view file for provide a body to the response.

* As render method i want to make an include without side effect for set to the response body the content of the included file.

* As view i want to be in html and scalaire for provide a message that can be maintainable.

* As view i want to have bootstrap linked in my head for have an easy templating framework.

* As link i want developer to use npm for including your dependencies for do not be dummy like.

* As view i want to have a navigation and a footer at least for provide a normalised document.

* As view i want to have an h1 containing a string provided by the data of the render method for achieve the conceptual goal of this training.

* As student i want to have an activity diagram and a class diagram of a back controller life and structure for memorise this conception.

## 📖 Treasure hunt

A treasure hunt is a game that consists of searching, on a route marked out by the leader of the game, clues in the form of signs or written messages that allow to progress progressively towards an unknown goal by the players.

## 😻  Tips

Render call
```php
$this->render(
    'path to my template.html.php', [
    'message' => "Hello World"
]);
```

Include without side effect
```php
ob_start();
// search the rest
```

## 🎫 Context
This training have a duration of 7 hours after 2 days of PHP learning based on front controller life and basic vocabulary.