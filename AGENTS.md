# AGENTS.md

## Architecture contract

- Do not use `JsonSerializable` in this project.
- Request DTOs must own explicit mapping to API payloads via dedicated methods (for example `toArray()`).
- Response models are domain/read models and must be created from API payloads via dedicated factories (for example `fromArray()`).
- Public SDK API must accept objects and return objects. Do not expose raw arrays in public method signatures.
- HTTP transport concerns (headers, auth, JSON encode/decode, status handling) must stay inside transport layer classes.
