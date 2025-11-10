# Warm Earth Home – Navigation Information Architecture

> Version: v1.3 · Updated with mobile UX & URL conventions · 2025-11-10

---

## 1️⃣ Desktop Primary Navigation

```
Home
Shop
├── Modern Earth Series
│    ├── Pendant Lights
│    ├── Wall Lamps
│    └── Table Lamps
├── Urban Glow Series
│    ├── Ceiling Lamps
│    ├── Floor Lamps
│    └── Wall Lamps
└── Shop by Space
      ├── Bedroom
      ├── Living Room
      ├── Dining
      └── Entryway

Inspiration
├── Lighting Ideas
└── How to Choose

About
└── Our Story

Support
├── FAQ
├── Shipping & Returns
└── Contact
```

### URL Convention Examples

| Level | Example | Notes |
|-------|---------|-------|
| Home | `/` | Landing page with series highlight |
| Series | `/shop/modern-earth/` | Series overview + featured PLP |
| Category | `/shop/modern-earth/wall-lamps/` | Filtered PLP |
| Room | `/shop/space/bedroom/` | "Shop by Space" PLP |
| Inspiration Article | `/inspiration/lighting-ideas-for-small-rentals/` | SEO-friendly slug |
| Support | `/support/shipping-and-returns/` | CMS template |

---

## 2️⃣ Mobile & Responsive UX

- **Navigation**：顶部汉堡菜单，展开后展示与桌面一致的层级。  
- **Sticky Bottom Bar**：包含 `Shop`、`Inspiration`、`Support`、`Cart` 四个快捷图标，移动端随滚动固定。  
- **Search**：在移动端顶部常驻搜索入口，桌面端放置在右上角。  
- **Cart CTA**：移动端 PDP/PLP 提供 sticky Add-to-Cart（详情见 PDP 文档）。

---

## 3️⃣ Footer Structure（全端一致）

```
Brand Story
  “Warm Earth Home – crafted lighting for modern living.”
Quick Links
  Shop · Shop by Space · Inspiration · Support
Customer Care
  Shipping & Returns · FAQ · Contact
Stay Connected
  Newsletter signup · Instagram · Pinterest · YouTube
```

---

## 4️⃣ Key User Paths

1. **Inspiration → Purchase**：Inspiration Article → "Shop the Look" → Series PLP → PDP → Checkout  
2. **Need-based Shopping**：Shop by Space → Filtered PLP → Quick View → PDP → Checkout  
3. **Support & Re-engage**：Order confirmation email → Support → FAQ → Styling call booking

---

## 5️⃣ Phase 2 / Future Modules

| Module | Purpose |
|---------|---------|
| Search Results Page | Dedicated filters + recommended products when no results |
| Mini Cart / Checkout | Single-page checkout，含 GA4 数据层事件 |
| 404 Page | 品牌语气提示 + 推荐系列 |

---

这一结构与品牌的 Warm / Calm / Simple 价值保持一致，同时便于 WordPress（Blocksy）主题实现与维护。
