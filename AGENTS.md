# AGENTS.md

## Architecture contract

- Do not use `JsonSerializable` in this project.
- Request DTOs must own explicit mapping to API payloads via dedicated methods (for example `toArray()`).
- Response models are domain/read models and must be created from API payloads via dedicated factories (for example `fromArray()`).
- Public SDK API must accept objects and return objects. Do not expose raw arrays in public method signatures.
- HTTP transport concerns (headers, auth, JSON encode/decode, status handling) must stay inside transport layer classes.
- Service-layer classes (for example client/orchestrator classes) must not be `final`; consumers should be able to customize/extend behavior without decorators.
- The same rule applies to public DTOs/requests/models and helper objects used by consumers: do not mark them `final`.

## Response Enrichment Contract

- `Response` may enrich decoded API payload with transport metadata required by RevenueCat behavior (for example headers and status code).
- This enrichment is intentional and is part of the SDK contract.
- Consumers and models must treat enriched payload as the canonical input shape for `fromArray()` in this project.
- Do not remove payload enrichment unless the response/error abstraction is replaced across the whole SDK.
