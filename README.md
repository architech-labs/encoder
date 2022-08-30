# Encoder

DI friendly + best practice encode/decode.

Best practice such as always setting assoc = true for json_decode.

DI friendly to make it easier to test your code. You can test what happens on
specific encode/decode errors without having to craft input that causes them.

Just mock the Encoder and have it behave the way you want to test.

## Encoder vs Trait

There is no behavioural difference between the Encoder and the Trait.

Use the Encoder version for any service class.  This let's you mock it and thus
mock encode/decode issues without having to craft inputs that produce them.

Use the Trait when you need the same functionality in a data class.

## Dev

This repo assumes you have a suitable version of Docker available.

Copy `.env.dist` to `.env`.  It's very unlikely you'll need to update these values.

Run `./bin/composer install`.

The standard Leverage Toolchain scripts are available in `./vendor/bin/`.

Make sure to run `./vendor/bin/verify` before you push.
