# GandengTangan — Domain Model

## Main Entities

The final MVP domain should focus on these entities only:

- users/admins
- pengrajin
- categories
- products
- product_images
- settings

## 1. Users / Admins

Purpose:

- authentication for admin only

Minimum fields:

- id
- name
- email
- password
- created_at
- updated_at

Notes:

- only 1 admin account is required for MVP
- forgot password should work for admin

## 2. Pengrajin

Purpose:

- store the maker data separately from products

Minimum fields:

- id
- nama
- jenis_disabilitas
- foto_profil (nullable)
- catatan (nullable)
- created_at
- updated_at

Notes:

- keep it simple
- `jenis_disabilitas` is a plain text field
- one pengrajin can have many products

## 3. Categories

Purpose:

- classify products for admin and public filter dropdown

Minimum fields:

- id
- nama
- slug
- created_at
- updated_at

Notes:

- single-level only
- no parent_id
- no subcategory logic

## 4. Products

Purpose:

- main catalog items shown to the public

Minimum fields:

- id
- category_id
- pengrajin_id
- nama
- slug
- deskripsi
- harga
- stok
- status
- created_at
- updated_at

Recommended status values:

- active
- inactive

Notes:

- sold out is primarily determined by `stok == 0`
- product remains visible even if stock is 0

## 5. Product Images

Purpose:

- store multiple images per product

Minimum fields:

- id
- product_id
- image_path
- image_type
- sort_order
- created_at
- updated_at

Recommended image_type values:

- product
- process

Notes:

- a product can have multiple images
- use this table instead of hardcoding a single image column in products

## 6. Settings

Purpose:

- store configurable system-wide values

Minimum fields:

- id
- whatsapp_number
- site_name (nullable)
- created_at
- updated_at

Alternative:

- key-value settings model is also acceptable if consistent with the codebase

## Relationships

- one pengrajin has many products
- one category has many products
- one product belongs to one pengrajin
- one product belongs to one category
- one product has many product_images

## Business Notes

- public users do not exist as database-authenticated users
- buyers are not modeled as accounts in MVP
- organizations are not part of the final domain model
