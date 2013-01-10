[Ubiq](https://github.com/Pixel418/Ubiq#readme) / [Documentation](../index.md#readme) / [String](../index.md#string) / i_starts_with
======


Description
-------- 

```php
bool \Util\Str\i_starts_with( string $hay, mixed $needles );
```

Checks if a string starts with a specific character/sequence. <br>
If several matches are given, checks if the string starts with at least one of them.

Returns TRUE if there is a match, FALSE otherwise.

**Note**: This function is case insensitive. See [starts_with](./starts_with.md#readme).



Examples
--------

### Example 1

```php
\Util\Str\i_starts_with( 'Ubiq is so cool', 'Ubiq' );
```
Returns TRUE.

### Example 2

```php
\Util\Str\i_starts_with( 'Ubiq is so cool', 'ubiq' );
```
Returns TRUE.

### Example 3

```php
\Util\Str\i_starts_with( 'Ubiq is so cool', 'Java' );
```
Returns FALSE.

### Example 4

```php
\Util\Str\i_starts_with( 'Ubiq is so cool', [ 'Ubiq', 'Java' ] );
```
Returns TRUE.

### Example 5

```php
\Util\Str\i_starts_with( 'Ubiq is so cool', [ 'ubiq', 'Java' ] );
```
Returns TRUE.

### Example 6

```php
\Util\Str\i_starts_with( 'Ubiq is so cool', [ 'Java', '.NET' ] );
```
Returns FALSE.