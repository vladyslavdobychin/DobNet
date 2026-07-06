# Auth Service Iteration Plan

Status: draft for discussion

Goal: tighten repository responsibility, move auth_service into Docker, and return minimal JSON API errors on failure.

Assumption: behavior should stay compatible; we are changing internal structure and developer/runtime setup only.

---

## Task 1: Repository contract cleanup

Scope: `src/Repository/UserRepositoryInterface.php` and `src/Repository/DoctrineUserRepository.php`

Changes:
- Remove `existsByEmail(Email $email): bool` from interface and implementation
- Replace raw SQL in `existsByUsername` with Doctrine ORM QueryBuilder via `$this->em->createQueryBuilder()`

Behavior contract:
- `save(User $user): void` unchanged
- `findByUsername(Username $username): ?User` unchanged
- `existsByUsername(Username $username): bool` behavior unchanged

No tests added for basic repository behavior.

---

## Task 2: Dockerize auth_service

Current state:
- `auth_service/compose.yaml` has only Postgres
- no app container definition found
- no Dockerfile found in `auth_service`

Changes:
- Add `auth_service/Dockerfile`
- Add app service in `auth_service/compose.yaml`
- Keep Postgres service named `database`
- Runtime values supplied via compose env vars / project env

Goal: run auth_service without manually managing local runtime deps.

---

## Task 3: Minimal JSON API error envelope

Scope: HTTP error responses

Format:
```json
{
  "title": "Not Found",
  "error": "Short human-readable description"
}
```

Implementation:
- smallest possible exception formatter/listener
- localized change, no broad framework rework
- only HTTP error paths affected

---

## Execution order
Task 1 → review → push by user → Task 2 → review → push by user → Task 3
