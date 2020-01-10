## Introduction

A command line tool to convert a given string to all upper cases or
alternate upper and lower cases and save to a CVS file. This is a
technical assessment to showcase my understanding of PHP programming
language, application of design patterns and unit testing skills.

TDD, Factory and Repository patterns, S.O.L.I.D and Clean Code
principles were utilized during development.

***This project will be taken down after a week of publication.***

## Usage
### Clone the Project

```
git clone https://github.com/datragingscholar/assessment.git
```

### Run the Command with `php artisan` after `composer update`

```
composer update
php artisan string:convert "hello world"
HELLO WORLD
hElLo wOrLd
File Created!
```

By default this command will convert the given string to both all
upper cases, and alternate cases, as well as save a character-split
CSV file to `test.csv` located at the root directory of the project.

Sample content of the file:

```
h,e,l,l,o,,w,o,r,l,d
```

Please note that the whitespcae in the original string was trimmed to
an empty column, this behavior is expected as per the requirement.

### Extra Options

You can specify extra options to alter the behavior of this command.
Use `-U` or `--only-to-upper-case` to stop the command from performing
alternate case conversion.

Specify `-A` or `--only-to-alternate-case` on the other hand, stops
the command from generating all upper case result.

***`-U` and `-A` should not be present at the same time, the command
will refuse to run***

If you do not want to save the string to the CSV file, present `-D` or
`--do-not-save` flag.

### Non-Latin and MultiByte Support

This command supports German letters such as `àáâ`, non-latin letters
such as `Τάχ`, as well as multibyte characters such as `尽ぃぅ`.

***Please refer to Known Issues for some known problems with encoding
and languages***

### Run Tests

```
#Run All Tests
./vendor/bin/phpunit

#Run All Unit Tests
./vendor/bin/phpunit --filter Unit

#Run All Feature Teasts
./vendor/bin/phpunit --filter Feature
```

## Known Issues

The following are not implemented or would cause error or incorrect
results, rectifying would take unnecessary amount of time and effort
with no real requirements to justify.

- Some encodings such as `Windows-1251` that can be used to parse
  Czech are not supported.
- Certain languages have unique rules for letter cases, they are not
  supported. For example:
  - i => I, İ => ı in Turkish
  - hÉ => hÉ in Irish

## Future Development

- With all the core domain logic ready, an HTTP layer can be easily
  implemented without altering the current workflow.
- Thanks to the loose coupling, `StringManipulator` can be freely
  extended for more verbose functionalities.
- The utilization of Dependency Inversion allows a different
  Repository other than `CSVPersistance` to be injected to the client
  code since it remains ignorant of the low-level implementation. This
  allows us to switch to a cloud storage solution with ease.
- We may also change the `CSVPersistance`'s behavior to let it handle
  multiple records in the CSV file by implementing real-world
  Repository Methods such as `Find()`, `FindAll()` and etc. Though that
  directly conflicts with what the requirement needs, the possibility
  was since ignored to avoid over-design.
- This project was written with it's own structure, except for the
  console component helpers from Laravel, it has no dependency, and
  should be able to be packed as a package or be extracted from
  Laravel to run as a standalone service easily.

## Contact

Lang Hai [send@hailang.email](mailto:send@hailang.email)
