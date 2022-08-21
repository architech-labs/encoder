# Encoder

DI friendly + best practice encode/decode.

Best practice such as always setting assoc = true for json_decode.

DI friendly to make it easier to test your code. You can test what happens on
specific encode/decode errors without having to craft input that causes them.

Just mock the Encoder and have it behave the way you want to test.
