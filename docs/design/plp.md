# Warm Earth Home – Product Listing Page (PLP) Blueprint

> 版本：Brand定位版 · 2025-11-10
> 适用对象：Modern Earth Series、Urban Glow Series 及房间筛选页
> 目标：让用户快速过滤并找到心仪灯具，同时保持品牌的 Warm / Calm / Simple 风格。

---

## 1️⃣ 页面结构概览

1. **Page Header**
   - 标题：根据入口展示（例如 “Modern Earth Series” 或 “Shop Bedroom”）
   - 面包屑：`Home > Shop > Modern Earth > Wall Lamps`
   - 描述：1 条 1~2 句简介，强调系列/场景的氛围感。

2. **Filter & Sort Bar**
   - 位置：页眉下方固定
   - 组件：
     - Filter Drawer（左侧或顶部）：
       - Series（Modern Earth / Urban Glow）
       - Category（Pendant / Wall / Table / Floor / Ceiling）
       - Room（Bedroom / Living / Dining / Entryway）
       - Price Range（slider）
       - Material（Wood / Linen / Metal / Glass）
       - Installation Type（Hardwired / Plug-in）
     - Sort by：`Recommended`（默认）、`Price ↑ / ↓`、`Newest`
   - 行动按钮：`Clear All`、移动端提供快速标签（pill 格式）。

3. **Product Grid**
   - 栅格：桌面端 3 列，平板 2 列，手机 1 列
   - 卡片元素：
     - 主图（WebP，4:5）
     - 标签：`New`、`Best Seller`、`Limited`
     - 产品名称（最多两行，保持 90 字符内）
     - 价格（AUD，含 GST 标注）
     - 快捷操作：`Quick View`、`Add to Cart`（hover 出现）
   - 卡片 hover 效果：轻微阴影 + 图片缩放 1.03

4. **Lifestyle Row（可选）**
   - 每浏览 9 件产品后插入 1 条“搭配建议”横幅：
     - 图片 + “Seen in modern living rooms”
     - CTA：`Shop the Space`

5. **Pagination / Load More**
   - 默认一次加载 12 个产品
   - 提供 `Load More` 按钮 + 页底 Pagination（SEO 友好），URL `/page/2`

6. **Footer CTA**
   - 引导订阅或咨询：`Need help choosing? Book a lighting call.`

---

## 2️⃣ 文案与品牌语调

- 标题语气：温和、鼓励探索（例如 “Find your warm glow”）
- 卡片文案：保持简洁，突出材质 + 场景
- 过滤项说明：轻文字（例如 “Perfect for renters”）
- CTA：`Explore`, `Discover`, `Add to Cart`，避免硬性 “Buy Now”

示例描述（Modern Earth Series）：
> “Crafted with oak and linen, Modern Earth lights bring calm warmth to bedrooms and living spaces.”

示例描述（Urban Glow Series）：
> “Minimal, metallic silhouettes designed for compact city homes and effortless installation.”

---

## 3️⃣ 交互与动效

- 过滤器在桌面端使用侧边栏，滚动时保持可见；移动端以抽屉形式从右侧滑入
- Quick View 弹窗包含：产品图轮播 + 关键规格（尺寸、灯口、安装方式）
- 快捷加入购物车后，在右上角显示 Toast：“Added to cart – View cart”
- 滚动回顶部按钮在列表滚动 60% 后出现

---

## 4️⃣ 数据埋点（Analytics）

| 事件 | 说明 | 参数 |
|------|------|------|
| `view_list` | 用户进入 PLP | series / room / filters |
| `select_item` | 点击产品卡片 | product_id / position |
| `filter_applied` | 应用筛选条件 | filter_name / filter_value |
| `quick_view_open` | 打开 Quick View | product_id |
| `add_to_cart` | 快捷加入购物车 | product_id / quantity |

GA4 + Meta Pixel 需同步事件；`filter_applied` 的数据用于分析热门筛选项。

---

## 5️⃣ SEO & 技术要求

- 页面标题：`Modern Earth Lighting | Warm Earth Home`
- Meta Description：抓重点关键词 `modern lighting Australia`、`warm ambient lights`
- H1 保持与页面标题一致
- 面包屑 + `Product` schema（在产品卡链接至 PDP）
- 图片：Lazy load + `alt` 文案（含材质 + 场景）

---

## 6️⃣ 内容扩展建议

- 侧边栏可加入“小贴士”模块，例如：“Choosing the right shade size”
- 结合 Inspiration 文章：列表底部推荐相关博文
- 引导用户下载《Lighting Planner》PDF（收集邮箱）

---

## 7️⃣ QA Checklist

- [ ] 所有筛选项测试（桌面 + 移动）
- [ ] Quick View 在两大系列产品上测试
- [ ] 滚动加载性能（首屏 < 2.5s）
- [ ] Lazy load 图片生效
- [ ] 面包屑链接无 404
- [ ] GA4 / Pixel 事件触发正确

---

**结论**：PLP 需要在“简洁体验 + 品牌故事”之间平衡。Modern Earth 与 Urban Glow 两个系列的差异通过文案、标签、Lifestyle 模块呈现，同时保留对租房用户友好的筛选项与快速浏览体验。
