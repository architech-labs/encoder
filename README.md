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

Use the Trait when you need the same functionality in a data class.  Eg imagine
a `JsonClient` that returns a `JsonResponse` that wants to `decode` the payload.

There's a variety of ways to handle this scenario.

1.  Inject the encoder as a constructor arg after the others.

```
class JsonResponse
{
    public function __construct(
        private readonly ResponseInterface $response,
        private readonly JsonEncoder $json = new JsonEncoder,
    ) {
    }
}
```

This works but that's a very heavy handed way to be able to mock the issue when
in reality we're likely to be mocking JsonResponse anyway.

2.  We can have the `JsonClient` do the `decode` and pass the result into our
`JsonResponse`.

```
class JsonResponse
{
    public function __construct(
        private readonly ResponseInterface $response,
        private readonly array $data,
    ) {
    }
}
```

This produces the `JsonException` at the right point.  We can mock the
`JsonEncoder` that `JsonClient` uses etc.  The price we pay is that we always
`decode` the payload even if it never gets used.

3.  The chosen approach.  We make the functionality available as a `Trait` and
assume that we'll mock that class to throw our chosen `JsonException`.

```
class JsonResponse
{
    use JsonTrait;

    public function __construct(
        private readonly ResponseInterface $response,
    ) {
    }
}
```

We're now free to choose when to do the `decode` based on our needs.

We can JFDI in the constructor (the same as passing it in from #2).
We can always process the body in some kind of `getData` method.
We can have a `getData` method that caches the first decode.

In summary -

If you want to test what happens in your class during specific encode/decode
conditions inject the Encoder as a constructor arg.

```
public function __construct(
    private readonly JsonEncoder $json = new JsonEncoder,
) {
}
```

If your class is going to pass through the JsonExceptions you can use the Trait.

```
class Data
{
    use JsonTrait;
}
```

## Dev

This repo assumes you have a suitable version of Docker available.

Copy `.env.dist` to `.env`.  It's very unlikely you'll need to update these values.

Run `./bin/composer install`.

The standard Leverage Toolchain scripts are available in `./vendor/bin/`.

Make sure to run `./vendor/bin/verify` before you push.
