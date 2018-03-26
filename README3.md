# PHP third training

From 12 days you're learning this language with a focus on the data access in the MVC composite. With an ORM you've learning entity relation and query with mapped objects auto generated from a CLI. Now your gone to render another format than the html for created an API server for a JavaScript consummation.

## 🎉Stories

*  As back controller i want to provide and endpoint in get and post for a client can consume me.

*  As back controller i want to trigger a 401 status if the client is not an user of the application for control access

* As back controller i want to trigger a 403 status if the client is not the owner of the channel or a suscribber for control access

*  As back controller i want to trigger a 406 status if json is not accepted for be REST

* As back controller i want to trigger a 201 status if i insert a message for notify success to user

* As back controller i want to trigger a 200 status if i read the last 15 messages for notify success to user

* As back controller i want to provide messages in json for be REST

* As back controller i want to limit insertion in the database to 15 messages for a channel

* As script i want to post an user message to the api for retrieve messages to other users.

* As script i want to get messages from the api every 5 seconds for retrieve messages to the current user

* As script i want to display retrived message in the interface for user can read them and respond

* As student i want to modelize with UML all notions as client/server relation using sequence or activity, then i want to complete class diagramme for a better overview understanding and complete my uml work.

## 📖 Concrete goal

For the first time you are using a back end language in the right way providing an API so you have to make a client side effort for become FullSTACK developper.

## 😻  Tips

For post data do not miss headers
```php
Content-Type: application/x-www-form-urlencoded
```

For encode entity to json install following package
```php
require symfony/serializer
```

## 🎫 Context
This training have a duration of 7 hours after 12 days of PHP learning based on front and back controller life, mvc, and data access and ORM utilisation.