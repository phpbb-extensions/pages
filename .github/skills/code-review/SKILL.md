---
name: code-review
description: Review code and pull requests in the phpBB Pages extension with repository-wide context and verified compatibility with phpBB 3.3.x. Use for every code review or pull request review in this repository.
---

# Review the phpBB Pages extension

Review changes as part of the whole extension and as integration code for phpBB 3.3.x. Do not review the diff in isolation.

## Establish context

Before reporting findings:

1. Read the pull request description, linked issue, complete diff, and every changed file in full. Identify intended behavior and supported upgrade path.
2. Map the repository with tracked files and directory structure. Read `composer.json`, relevant GitHub Actions workflows, `README.md`, and `phpunit.xml.dist` when present. Treat these files as authoritative for supported PHP/phpBB versions and validation commands.
3. Search the entire repository for every changed class, interface, method, service ID, route, event, config key, table/column, permission, language key, template variable, and template event. Inspect definitions, callers, consumers, tests, fixtures, migrations, and caches that can affect the change.
4. Follow behavior across boundaries. Typical flows span routing, controller/operator/entity, DBAL, service configuration, event listeners, templates, JavaScript/CSS, language files, migrations, and tests.
5. Inspect history only when it clarifies an intentional pattern or regression. Do not assume neighboring code is correct merely because it already exists.

Repository-wide awareness means building this map and tracing each changed behavior through all relevant files. It does not mean claiming to have read files that were unavailable or irrelevant binary/generated/vendor content.

## Verify against phpBB 3.3.x

Use phpBB core source as an integration contract, not memory or modern framework documentation.

- Prefer an available phpBB checkout whose checked-out branch is `3.3.x`. Otherwise inspect the `3.3.x` branch of `https://github.com/phpbb/phpbb` with repository/GitHub tools.
- Pin every compatibility conclusion to phpBB 3.3.x source. Check the concrete class, method signature, interface, event payload, service definition, routing behavior, template event, migration API, or test fixture involved.
- This extension declares phpBB `>=3.3.2,<4.0.0@dev`. When a changed API may not have existed throughout that range, compare the oldest supported 3.3.2 release as well as current `3.3.x`. Do not approve code merely because it works at branch tip.
- Do not use phpBB `master`, 4.x code, current Symfony/PHP documentation, or another extension as proof of 3.3.x compatibility. They may provide leads, never final evidence.
- If core source cannot be accessed, state that limitation and omit any compatibility finding that cannot be proven. Never invent phpBB behavior.

Check integration points relevant to the diff, especially:

- PHP syntax and APIs against the extension's declared PHP floor and the phpBB 3.3.x runtime matrix.
- Symfony components at versions bundled by phpBB 3.3.x, including dependency injection, routing, events, HTTP responses, and YAML syntax.
- Constructor arguments, service IDs, visibility/sharing, tags, factories, parameters, and container compilation in `config/*.yml`.
- Event names, dispatch timing, mutable event keys, and payload types against phpBB 3.3.x event definitions and call sites.
- Controller responses, authentication/ACL checks, ACP module behavior, form keys/CSRF protection, request variable handling, redirects, and error handling.
- DBAL portability across phpBB-supported databases: SQL abstraction, identifier/value escaping, result cleanup, transactions, data types, indexes, and deterministic ordering.
- Migration dependency chains, idempotency, effective/revert behavior, permissions/modules/config changes, schema portability, and upgrades from every supported installed version. Never require edits to an already released migration when a new migration is needed.
- Route loading, generated route names/paths, cache invalidation, URL generation, special characters, duplicate routes, and front-controller behavior.
- Text formatter/parser/renderer and text-reparser contracts, cache keys, stored-text compatibility, and cron resumability.
- Twig/template-event contracts, output escaping and stored XSS, language-key availability, styles, and accessible markup.
- Extension enable/disable/purge behavior and compatibility metadata.

## Evaluate change quality

Prioritize defects introduced or exposed by the pull request:

- incorrect behavior, edge cases, regressions, or broken upgrade paths;
- security issues, especially missing ACL/CSRF checks, unsafe request data, SQL injection, stored/reflected XSS, unsafe paths/URLs, and information disclosure;
- phpBB 3.3.x or minimum-PHP incompatibility;
- stale caches, inconsistent persistence, partial writes, and cross-database failures;
- missing tests for a meaningful new branch or regression when existing test patterns can cover it.

Respect project-specific behavior documented in repository files. For example, do not request new translation submissions when repository policy rejects them. Avoid comments about unrelated legacy code, subjective style, or hypothetical risks without a concrete failing scenario.

## Validate findings

For each possible finding:

1. Trace a concrete execution path from changed code to failure.
2. Confirm assumptions by repository search and, for integration claims, phpBB 3.3.x source.
3. Check whether existing guards, framework behavior, migration dependencies, tests, or callers already prevent the failure.
4. Run the narrowest relevant tests or static checks when tools and dependencies are available. Follow repository CI commands and versions; do not silently substitute a newer runtime or framework.
5. Keep the finding only when it is actionable and attributable to the pull request.

## Write review comments

- Put each finding on the smallest changed line range that reveals the problem.
- Lead with severity and concise defect statement.
- Explain the triggering conditions, observable impact, and why existing code does not prevent it.
- Cite the related extension or phpBB 3.3.x symbol/path that proves the issue when useful.
- Suggest the smallest viable fix or missing test, without rewriting the pull request.
- Do not claim tests passed unless they were run. Distinguish source verification from executed validation.
- If no actionable defects remain, return no findings rather than manufacturing comments.
