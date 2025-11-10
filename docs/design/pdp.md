# Warm Earth Home – Product Detail Page (PDP) Blueprint

> 版本：Brand定位版 · 2025-11-10  
> 目标：让用户快速了解灯具核心卖点、规格与适配场景，激发购买与后续交互（收藏/分享）。

---

## 1️⃣ 页面结构

1. **Breadcrumb**  
   `Home > Shop > Modern Earth Series > Oak Wall Lamp`

2. **Gallery Module**  
   - 主图（4:5 比例，支持放大）  
   - 缩略图（最多 6 张，可包含生活场景、细节图、安装图）  
   - 支持视频（mp4/webm）或 360° 全景

3. **Primary Info Panel**  
   - 产品名称 + 系列标签（Modern Earth / Urban Glow）  
   - 简短描述：1 句强调核心优势（材质/光效/适合空间）  
   - 价格（含 GST）+ 分期提示（Afterpay 选项）  
   - 变体：颜色、尺寸、灯泡类型  
   - 数量选择器 + `Add to Cart` 按钮  
   - 次级动作：`Buy Now`、`Add to Wishlist`、`Ask a Question`

4. **Trust & Shipping Badges**  
   - “Free shipping in Australia over $199”  
   - “30-day returns”  
   - “Easy install – renter friendly”（如适用）

5. **Key Highlights Tabs**  
   - **Overview**：3–4 个 bullet（材质、光效、适用空间、风格）  
   - **Specifications**：表格 (尺寸、材质、灯口、重量、安装方式、保修)  
   - **Installation & Care**：PDF 下载、安装难度评级、清洁提示  
   - **Shipping & Returns**：链接至 Support

6. **Styled Shots / Inspiration**  
   - 图片 + 文案 “Style it with…”  
   - 链接到 Inspiration 文章或其他产品组合

7. **Related Products**  
   - 4 件相关产品：同系列或同房间分类  
   - CTA：`Seen in Urban Glow Living Room`

8. **Reviews (Phase 2)**  
   - 用户评分 + 评价列表（支持图片）  
   - “Write a Review” CTA

9. **Footer CTA**  
   - “Need help choosing lighting? Book a styling call.”

---

## 2️⃣ 品牌调性与文案规范

- 使用温暖、描述性语言：`“Soft linen shade diffuses a calming glow that feels like sunset light.”`
- 系列强调：  
  - Modern Earth → “Natural textures · Calm evenings”  
  - Urban Glow → “Minimal glow · Clever for small homes”
- CTA 保持指导性：`Add to cart`、`Discover more ideas`、`Download installer guide`

---

## 3️⃣ 技术与交互细节

- Gallery 支持键盘左右切换、触屏滑动  
- Add to Cart 成功后出现侧边购物车（mini cart）  
- 若产品无库存，显示 `Pre-order` + ETA  
- 提供 `Share` 按钮（复制链接、Pinterest、Instagram）

---

## 4️⃣ SEO & 架构化数据

- Meta Title：`Oak Wall Lamp – Modern Earth Series | Warm Earth Home`
- Meta Description：强调材质 + 场景 + 安装容易度  
- Structured Data：`Product` + `AggregateRating`（有评价时）  
- URL：`/products/oak-modern-earth-wall-lamp`
- 图片 `alt`：包含材质、颜色、适用场景

---

## 5️⃣ 分析埋点

| 事件 | 说明 | 参数 |
|------|------|------|
| `view_item` | 进入 PDP | product_id / series |
| `add_to_cart` | 加入购物车 | product_id / variant |
| `view_item_list` | 浏览 Related Products | list_name |
| `select_promotion` | 点击 Inspiration 区 CTA | promo_name |
| `download_installation` | 下载安装指南 | product_id |

---

## 6️⃣ QA 清单

- [ ] 变体切换图片正常  
- [ ] 所有规格字段完整且正确  
- [ ] 加入购物车与 mini cart 交互顺畅  
- [ ] Gallery、视频在移动端无异常  
- [ ] Schema markup 验证无报错  
- [ ] 所有 CTA 链接正确（Inspiration / Support）

---

**结论**：PDP 必须兼顾氛围感与理性信息，突出两个系列差异，提供安装与售后保障，减少用户顾虑，提升转化率。
