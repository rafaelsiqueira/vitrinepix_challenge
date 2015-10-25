## REQUIREMENTS ##

* PHP >= 5.3 (with SQLite extension enabled)

## HOW TO RUN ##

* Clone the repo
* Navigate to the project path
* Execute ```php -S localhost:3000 ```

## ADMIN ##
 
* Password: ```1234``

## REASONS WHY ##

* SQLite - To facilitate running (no config needed)
* CodeIgniter - Framework used in the company (and to refresh my memory)

## VERSIONS ##

There are two versions of the game.

The first one (v1 tag), was built considering the following flow:

- Run the initiative step once
- Run the attacks (first the initiative's winner)

Example:

The Human was the initiative's winner. He starts the attack.
After that, the Orc attacks the Human and so on;

Human > Orc
Orc > Human

Until someone's health end.

The second one (v2 tag and master branch), was built considering the following flow:

- Run the initiative step to know who will attack first
- Run the attacks (first the initiative's winner)

The initiative step will be executed before each attack.

Exemple:

The Human was the initiative's winner. He starts the attack.
After the attack, the initiative step will be executed again, to know who is the next attacker.

In this scenario, we can see the following behavior:

Human > Orc
Human > Orc
Orc > Human
Human > Orc

Until someone's health end.