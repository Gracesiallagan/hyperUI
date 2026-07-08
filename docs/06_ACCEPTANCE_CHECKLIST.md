# GandengTangan — Acceptance Checklist

Use this checklist to validate the MVP.

## Admin Authentication

- [ ] admin can log in
- [ ] forgot password works
- [ ] public pages do not require login
- [ ] admin pages require login

## Categories

- [ ] admin can create category
- [ ] admin can edit category
- [ ] admin can delete category safely
- [ ] public catalog category dropdown loads from database

## Pengrajin

- [ ] admin can create pengrajin
- [ ] admin can edit pengrajin
- [ ] admin can delete pengrajin safely
- [ ] jenis_disabilitas is stored directly on pengrajin

## Products

- [ ] admin can create product
- [ ] admin can edit product
- [ ] admin can delete product
- [ ] product belongs to category
- [ ] product belongs to pengrajin
- [ ] product has stock
- [ ] product price is shown publicly
- [ ] product description is shown publicly

## Product Images

- [ ] product supports multiple images
- [ ] product images can include process photos
- [ ] images are displayed properly on detail page

## Stock and Sold Out

- [ ] stock is displayed publicly
- [ ] stock is managed manually by admin
- [ ] stock 0 shows Sold Out
- [ ] sold out product remains visible

## WhatsApp

- [ ] WhatsApp number is loaded from database/settings
- [ ] available product button opens WhatsApp
- [ ] sold out product button still opens WhatsApp
- [ ] sold out button text changes appropriately
- [ ] generated WhatsApp message matches product status

## Public Pages

- [ ] Home exists
- [ ] Catalog exists
- [ ] Product Detail exists
- [ ] About exists
- [ ] Contact exists
- [ ] How to Buy exists

## Scope Control

- [ ] no cart
- [ ] no checkout
- [ ] no payment gateway
- [ ] no scraper
- [ ] no organization-based logic in active MVP flow
