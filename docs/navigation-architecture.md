# 🪔 Warm Earth Home – Navigation Information Architecture & Marketing Integration

> PR: #3  
> Author: @warmearthhome  
> Reviewer: @Jimmy  
> Version: v1.3 · 2025-11-10  
> Purpose: Define the navigation architecture aligned with brand positioning and future marketing scalability.

---

## 1️⃣ Brand Alignment & Core Strategy

**Brand Essence:**  
> “Light up your moments, simply and beautifully.”

**Series Focus:**  

| Series | Style | Core Keywords | Target Users |
|---------|--------|----------------|----------------|
| **Modern Earth Series** | Natural & Warm | wooden lamp, linen shade, cozy lighting | Homeowners & families |
| **Urban Glow Series** | Minimal & Metallic | metal lamp, apartment lighting, easy install | Female renters & urban couples |

**Brand Values:**  
Warm · Calm · Simple · Authentic · Comfort

---

## 2️⃣ Target Personas & Conversion Logic

| Persona | Age | Lifestyle | Key Purchase Drivers | CTA Focus |
|----------|------|------------|----------------------|------------|
| **Urban Couple** | 30–45 | Apartment / House | Quality, timeless design, calm atmosphere | Explore & Buy |
| **Female Renter** | 25–35 | Rental / Small Space | Easy install, affordable aesthetic | Discover & Shop |

**Conversion Funnel (Product-First):**

```
Inspiration (blog / social post)
↓
Series Page (Modern Earth / Urban Glow)
↓
Category Page (PLP)
↓
Product Page (PDP)
↓
Checkout / Email capture
```

---

## 3️⃣ Navigation & Hierarchy

**Top Navigation (desktop):**

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

**Header Actions:** Search · Account · Cart  
**Footer:** Secondary navigation + Social (Instagram / Pinterest / YouTube)

💻 *Developer Note:*  
Limit depth to 3 levels for lightweight maintenance.  
Use descriptive URLs (SEO-friendly slugs):  
`/shop/modern-earth/wall-lamps`  
`/inspiration/lighting-ideas-for-rentals`

---

## 4️⃣ MVP vs Phase 2 Implementation

| Phase | Components | Notes |
|--------|-------------|--------|
| **MVP (Launch)** | Home, Shop (Series + PLP + PDP), Inspiration (3 articles), About, Support, Footer | Core for product-focused marketing |
| **Phase 2 (Growth)** | Testimonials, Lookbook, Installation Videos, “Small Space Hacks” Blog, Search Results Page | Content for retention & discovery |
| **Phase 3 (Automation)** | Email flows, Instagram Feed, UGC Gallery, Mini Cart/Checkout optimisation | Scalable engagement & SEO growth |

---

## 5️⃣ SEO & Metadata Standards

| Page Type | Example Meta Title | Example Description |
|------------|--------------------|----------------------|
| Home | Warm Earth Home · Modern Lighting for Australian Homes | Explore warm, authentic lighting crafted for comfort. |
| Series | Modern Earth Lighting · Natural & Calm Lamps | Discover wooden and linen lights that bring serenity. |
| Product | Oak Pendant Light · Modern Earth Series | A soft natural pendant crafted for calm living. |
| Blog | Lighting Ideas for Small Apartments | Simple, warm lighting tips for cozy rental spaces. |

**Schema Markup:**  
- `Product` schema for all PDPs  
- `BreadcrumbList` for navigation  
- `Organization` schema in footer  

**Image Rules:**  
- Format: WebP  
- Size: <400KB  
- Ratio: 4:5 / 1:1  

---

## 6️⃣ Marketing Integration Plan

### A. Content Marketing (SEO + Inspiration)

**Monthly Content Rhythm：**
- **Week 1**：发布 Lighting Ideas 系列文章（SEO 关键词：rental lighting, cozy lighting）。
- **Week 3**：发布安装/空间实用 Tips，并在社交渠道二次分发。
- **Week 4**：Email Digest + Product Highlights（推荐新产品 + 博客链接）

每季度 1 篇 “How to Choose” 教程  
博客与产品双向内链（`Shop the Look`）

### B. Email Marketing (Post-launch)

| Flow | Trigger | 内容方向 |
|------|---------|-----------|
| Welcome Series | 新订阅 | 品牌故事、系列介绍、租房友好安装技巧（3 封） |
| Cart Abandonment | 24h 未结账 | 温和提醒 + 热销推荐（无折扣） |
| Seasonal Story | 月度/季度 | 新文章 + 新品灯具亮点 + 社区故事 |

### C. Social & Community

- Instagram：日常搭配 + 客户实拍  
- Pinterest：先投放低预算 **Pinterest Ads**（推荐起始预算 $50-100/月），引导到 Inspiration & PLP 页面  
  - 创建系列图板（Modern Earth / Urban Glow）
  - 使用 Rich Pins 显示价格与库存
- YouTube（阶段2）：安装指南 / 小空间布灯技巧

### D. Retargeting & Paid

- Facebook / Instagram 广告：聚焦“租房氛围灯”主题  
- Google Ads：关键词组合 "modern wall lamp Australia"  
- Pinterest Ads：推广视觉灵感和可购买内容  
- 邮件引流至 PDP，不推折扣，只推风格

---

## 7️⃣ Navigation UX & Responsive Guidelines

| Device | Behavior | Notes |
|---------|-----------|-------|
| Desktop | Hover 展开二级菜单 | Series/Room 分类清晰 |
| Tablet | Click 展开一级菜单 | 侧滑导航栏 |
| Mobile | 折叠式导航 + 固定底部 Cart 按钮 | 保证转化路径简短 |

---

## 8️⃣ Analytics & Tracking Setup

- Google Analytics 4：`view_item_list`、`view_item`、`add_to_cart`、`purchase`  
- GA4 自定义事件：`scroll_depth`（首页、长文档 25/50/75/100%）、`email_signup`（Newsletter, Styling Call）  
- Meta Pixel：AddToCart / ViewContent / Purchase  
- Email Signups：表单转化率（目标 ≥ 3%）  
- Scroll Tracking：评估用户阅读首页深度，优化 CTA 位置

---

## 9️⃣ Summary

✅ **导航结构**：清晰、浅层级、聚焦产品购买路径。  
✅ **品牌一致性**：紧扣 Modern Earth（自然）与 Urban Glow（都市极简）。  
✅ **营销兼容性**：月度内容节奏 + 邮件自动化 + Pinterest Ads 易于单人执行。  
✅ **可维护性**：单人运营可管理，后期扩展空间明确。  

> 🌿 “Warm Earth Home brings light that feels alive — crafted for calm, modern living.”
