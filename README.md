Zadanie rekrutacyjne do firmy tensoft na stanowisko programista PHP.

# Scoring bowling

The game consists of 10 frames as shown above. In each frame the player has two opportunities to knock down 10 pins. The score for the frame is the total number of pins knocked down, plus bonuses for strikes and spares.

A spare is when the player knocks down all 10 pins in two tries. The bonus for that frame is the number of pins knocked down by the next roll. So in frame 3 above, the score is 10 (the total number knocked down) plus a bonus of 5 (the number of pins knocked down on the next roll.)

A strike is when the player knocks down all 10 pins on his first try. The bonus for that frame is the value of the next two balls rolled. In the tenth frame a player who rolls a spare or strike is allowed to roll the extra balls to complete the frame. However no more than three balls can be rolled in tenth frame.

### Wskazówki i wymagania techniczne

1. Napisać minimum klasę `Game` (może być więcej klas) posiadającą co najmniej 2 publiczne metody `roll` i `getScore`. Metoda `roll` przyjmuje liczbę strąconych kręgli w danym rzucie, metoda `getScore` zwraca aktualną liczbę punktów.
2. Utworzyć skrypt `app.php` (uruchamiany z konsoli: `php app.php`), który utworzy obiekt klasy `Game` i w ramach którego będą wywoływane metody obiektu klasy `Game`.
3. Liczba przewróconych kręgli(`pins`) w każdym rzucie(`roll`) podawana jest z konsoli(odczytywana ze `stdin`).
4. Po każdym rzucie na ekranie(`stdout`) wyświetlana jest aktualna liczba punktów.
5. Strona estetyczna wyświetlania nie jest istotna, liczy się estetyka kodu.
6. Po ostatnim rzucie wyświetlana jest informacja o zakończeniu gry i punktach zdobytych w każdej rundzie `frame`, następnie skrypt kończy działanie.

## Informacje
- Skrypt uruchamia się poleceniem `php app.php`.
- Skrypt został przetestowany na wersji PHP 8.2.6, na systemie z rodziny GNU/Linux.
- Dokumentacja znajduje się w katalogu `docs`. Można ją wygenerować samodzielnie poleceniem `phpdoc -d ./src -t ./docs`.

