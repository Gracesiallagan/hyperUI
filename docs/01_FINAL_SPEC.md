# GandengTangan — Final Specification

## Source of Truth

This file is the main source of truth for Codex and all implementation work.

## Final Product Definition

GandengTangan is an MVP web platform for promoting and marketing physical products made by people with disabilities.

The system is admin-centric:

- only 1 admin account is needed for the competition version
- public users do not need to log in
- all product and content management is handled by admin

## Final Terms

Use the term:

- `pengrajin`

Do not use as the main domain term:

- artist
- organization
- org admin
- super admin

## Final User Roles

### Admin

Only 1 admin account for MVP.
Admin can:

- log in
- reset password via forgot password
- manage products
- manage categories
- manage pengrajin
- manage stock
- manage WhatsApp number in database

### Public User

Public users:

- do not log in
- can browse products
- can open product detail pages
- can contact admin via WhatsApp

## Final Public Pages

The public website must include:

- Home
- Catalog
- Product Detail
- About
- Contact
- How to Buy

## Final Admin Pages

The admin area must include:

- Login
- Forgot Password
- Dashboard
- Product Management
- Category Management
- Pengrajin Management
- WhatsApp / Settings Management
- Logout

## Product Scope

Only physical products are included in MVP.
Included examples:

- handicrafts
- paintings
- woven products
- handmade home decor

Not included:

- digital products
- services

## Product Rules

Each product should support:

- name
- category
- pengrajin
- description
- price
- stock
- status
- multiple images

## Product Images

A product can have multiple images.
Images may include:

- product photos
- process photos

## Pengrajin Rules

Pengrajin must be a separate entity/table.
Each product belongs to one pengrajin.
One pengrajin can have many products.

Minimum pengrajin data:

- name
- jenis_disabilitas
- optional notes
- optional profile photo

Important:

- `jenis_disabilitas` is a normal field in the pengrajin table
- do NOT create a separate disability type table for MVP

## Category Rules

Categories are managed by admin.
Categories are single-level only.
No subcategories.
Admin can add categories.
Public catalog must show category filter dropdown dynamically from database data.

## Stock Rules

Stock is managed manually by admin.
Stock does NOT decrease automatically when a user clicks WhatsApp.
If stock reaches 0:

- product must still be visible
- product must show `Sold Out`

## Sold Out Rules

Sold out products must remain visible in the catalog.
Sold out products still have an action button.
The button text should change to:

- `Tanya Ketersediaan`
  or
- `Hubungi Admin`

Preferred default:

- `Tanya Ketersediaan`

## WhatsApp Rules

Ordering is done via WhatsApp admin only.
No checkout page.
No cart.
No payment gateway.

The WhatsApp number must be stored in database/settings.

The WhatsApp message should be generated automatically based on product status.

### For available products

Message should communicate:

- user interest in the product
- product name
- pengrajin name
- price

### For sold out products

Message should communicate:

- request for availability or restock
- product name
- pengrajin name

## Authentication Rules

Only admin login is available.
Forgot password must be implemented now for MVP.

## Final System Shape

This is a catalog and inquiry platform, not a full e-commerce checkout system.
