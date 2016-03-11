# Development practices for Continuous Integration

Using [Continuous Integration](https://en.wikipedia.org/wiki/Continuous_integration) means that you, as a developer, should push to the main branch often, like several times a day. 

But, how are you gonna push your code if your feature is still not finished?

This document describes different development practices and techniques to do this.


## Start by the bottom (or by the middle, but don't connect it)

You can develop your classes starting by the bottom and use the Unit Tests to ensure that your classes are working as you expect.

When you think your feature is ready you can connect it to the existing code. Since your code is not reachable by any user action, it should be safe to share it.


## Developing a new API endpoint

No problem, nobody will call your new API endpoint until you say its ready. 

Also maybe QA can work in the end-to-end tests for your new endpoint even if its not completely finished.


## Branch by Abstraction

Since your code should depend on abstractions, you can use a abstraction to activate or deactivate your new feature.

You can create a [NullObject](https://en.wikipedia.org/wiki/Null_Object_pattern) and use your Dependency Injection Container to use the NullObject or the real implementation. 

Same if you are changing existing behavior, you can create an abstraction layer in front of the old behavior, puting this old behavior in a new class and create a new implementation for the new behavior.

### Code example

[UserController.php](src/Controller/UserController.php)

In this example we want to notify the user by websockets when he has been logout. To develop this we create an interface called [IUserNotification](src/UserNotification/IUserNotification.php) 
and we make the [UserController.php](Controller/UserController.php) depend on this interface to call userNotification->notify.

Then we use the [NullObject pattern](https://en.wikipedia.org/wiki/Null_Object_pattern) and we create the [NullUserNotification.php](src/UserNotification/NullUserNotification.php), also we can create 
the [WebsocketUserNotification.php](src/UserNotification/WebsocketUserNotification.php) to develop our new feature. Then we can use the dependency injection container to switch between the two implementations.
In this way, we can push our changes with the NullObject implementation activated, but in local we activate the websockets one to develop our feature.

Instead of the NullObject you could even create a dummy object implementing some dummy behavior to allow the QA in your team to start working in the end-to-end tests.

You can execute the code example running:

```
php main.php
``

Then change in [services.yml](services.yml) the injected userNotifier class from "UserNotification\NullUserNotification" to "UserNotification\WebsocketUserNotification" and run it again.

Read more:
[Martin Fowler - BranchByAbstraction](http://martinfowler.com/bliki/BranchByAbstraction.html)


## Feature Toggling

In case your changes are spread through all the code base, apart from this being a code smell, you can create a config value for you feature and use conditional statements to activate or deactivate codepaths based on the value in the config.

To use it as a practice for Continuous Integration this is maybe the last option, because when your feature is ready you will need to remove the config and the conditional statements. 

Feature toggling could also be used after development to activate/deactivate features, but some experts are advising against it, the main reasons are:

- Keeping a lot of togglable features makes your system more complex.
- The number of possible behaviors in combination of features can grow a lot.
- More tests and more complex tests.
- Possibility of feature leaking.

Read more:
- [Martin Fowler - FeatureToggle](http://martinfowler.com/bliki/FeatureToggle.html)
- [Feature Toggles are Technical Debt](https://dzone.com/articles/feature-toggles-are-one-worst)


# More resources about CI

- [Wikipedia - Continuous Integration](https://en.wikipedia.org/wiki/Continuous_integration)
- [Martin Fowler - Continuous Integration](http://martinfowler.com/articles/continuousIntegration.html)
- [Continuous Integration : Improving Software Quality and Reducing Risk - Paul Duvall](http://www.amazon.com/Continuous-Integration-Improving-Software-Reducing/dp/0321336380/ref=sr_1_1?ie=UTF8&qid=1457524101&sr=8-1&keywords=continuous+integration)
- [ThoughtWorks - Continuous Integration](https://www.thoughtworks.com/es/continuous-integration)
