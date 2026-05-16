# revenue-cat

MVP SDK for RevenueCat REST API(backend/server side), built on PSR interfaces.

## Notes for contributors

- Response payloads can be enriched with transport metadata (for example HTTP headers/status code) by design.
- Treat this as an intentional contract, not an accidental side effect.

## Requirements

- PHP 8.2+
- `psr/http-client`
- `psr/http-factory`
- `psr/http-message`
