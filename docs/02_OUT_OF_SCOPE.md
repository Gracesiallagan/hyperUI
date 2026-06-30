# GandengTangan — Out of Scope

The following features are explicitly out of scope for the MVP and must NOT be implemented by Codex unless the specification changes.

## Users and Roles

- public user registration
- buyer accounts
- pengrajin self-registration
- multi-admin role system
- super admin
- organization admin
- org-based workflow

## Organization Model

- organizations as a primary entity
- organization dashboard
- organization membership flows

## Commerce Features

- cart
- checkout
- payment gateway
- order management system
- shipping tracking automation
- invoice system
- coupon or discount system

## Product Scope Expansion

- digital products
- services
- subscription products

## Advanced System Features

- scraper
- marketplace aggregation
- cron-based product scraping
- analytics dashboard beyond simple admin summary
- recommendation engine
- review/rating system
- wishlist

## Overengineering to Avoid

- separate disability type table
- complex permissions matrix
- microservices
- unnecessary API abstraction for MVP

## Rule

If legacy code contains any of the items above, prioritize removal, disabling, or ignoring them unless they are harmless and do not affect the final MVP direction.
