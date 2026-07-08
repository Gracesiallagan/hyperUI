# GandengTangan — Implementation Priority

Codex should work in the following order to reduce risk and avoid random changes.

## Phase 1 — Align Codebase with Final Direction

1. inspect legacy code and identify conflicting concepts
2. remove or disable organization-based logic
3. remove or disable multi-role assumptions
4. ignore scraper-related functionality for MVP
5. ensure the docs folder is treated as source of truth

## Phase 2 — Stabilize Core Data Model

1. finalize migrations for:
    - pengrajin
    - categories
    - products
    - product_images
    - settings
2. fix model relationships
3. clean legacy foreign keys that no longer fit final scope

## Phase 3 — Admin Authentication

1. verify admin login works
2. implement or fix forgot password
3. ensure only admin area requires authentication

## Phase 4 — Admin CRUD

1. category CRUD
2. pengrajin CRUD
3. product CRUD
4. product multi-image upload
5. settings CRUD for WhatsApp number

## Phase 5 — Public Pages

1. Home
2. Catalog
3. Product Detail
4. About
5. Contact
6. How to Buy

## Phase 6 — Catalog Logic

1. dynamic category dropdown filter
2. stock display
3. sold out label when stock is 0
4. keep sold out products visible

## Phase 7 — WhatsApp Logic

1. fetch WhatsApp number from database/settings
2. generate message for available products
3. generate message for sold out products
4. change button label depending on stock status

## Phase 8 — Polishing

1. preserve existing UI where possible
2. improve validation and empty states
3. sync text labels with final terminology
4. clean README if needed after functionality is aligned

## General Rule

Do not redesign the whole application unless necessary.
Prefer targeted functional fixes over broad rewrites.
