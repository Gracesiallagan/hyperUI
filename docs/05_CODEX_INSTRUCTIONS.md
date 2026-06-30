# GandengTangan — Codex Instructions

## Purpose

This file tells Codex how to work on this repository.

## Most Important Rule

Treat `/docs/01_FINAL_SPEC.md` as the primary source of truth.

If you find conflicts between:

- old README
- legacy migrations
- model names
- old routes
- older architecture assumptions

and the final spec, always follow the final spec.

## Working Style

- preserve working UI where possible
- focus on functionality before redesign
- prefer minimal safe changes
- do not introduce unnecessary complexity
- keep MVP scope tight

## Things Codex Must Not Assume

Do NOT assume:

- multi-role auth is still required
- organization-based architecture is still correct
- scraper is part of MVP
- payment gateway is needed
- cart or checkout should exist
- buyers should have accounts
- pengrajin should self-register

## What Codex Should Prioritize

1. working admin auth
2. working forgot password
3. category CRUD
4. pengrajin CRUD
5. product CRUD
6. multi-image support
7. public catalog and product detail
8. stock + sold out logic
9. database-driven WhatsApp button

## Terminology

Use:

- `pengrajin`

Prefer avoiding inconsistent primary terms such as:

- artist
- organization
- org admin

## Implementation Notes

- sold out products must stay visible
- stock is manual
- clicking WhatsApp must not reduce stock
- WhatsApp number comes from database/settings
- jenis_disabilitas is a simple field on pengrajin
- product images should support both product and process images

## When Unsure

If implementation details are unclear, choose the simplest approach that still respects:

- the final spec
- MVP constraints
- Laravel best practices already present in the repo

## Output Expectation

When making changes, explain:

- what files were changed
- why they were changed
- what legacy behavior was removed or replaced
- what remains to be done
