# 澳洲灯饰网站竞品分析 & UI实现方案

## 一、导航结构对比

| 网站 | 主导航结构 | 特点 | 适用性 |
|------|-----------|------|--------|
| **Beacon Lighting** | Lighting (下拉) → Pendant/Floor/Table/Wall<br>Shop by Room → Kitchen/Bathroom/Dining/Living/Bedroom<br>Shop by Style → Hamptons/Coastal/Contemporary<br>Inspiration → Guides/Blog | 三级导航，按产品类型+房间+风格 | ✅ 必须采用 |
| **Fat Shack Vintage** | Shop by Room → Kitchen/Bathroom/Bedroom<br>Shop by Style → Art Deco/Farmhouse/Industrial<br>Guides & Ideas | 二级导航，强调场景和风格 | ✅ 必须采用 |
| **LightCo** | Products → Interior/Outdoor<br>Shop by Room<br>Collections | 简洁，按产品+房间+系列 | ✅ 必须采用 |
| **Temple & Webster** | Shop by Room<br>Shop by Style<br>Collections | 大型电商，多品类 | ⚠️ 参考风格分类 |

### 最终导航方案（Warm Earth Home）

```
Lighting (下拉菜单)
  ├─ Wall Lights
  ├─ Pendant Lights  
  ├─ Table Lamps
  └─ Floor Lamps

Shop by Room (下拉菜单)
  ├─ Bedroom
  ├─ Living Room
  ├─ Dining / Kitchen
  └─ Entryway

Collections (下拉菜单)
  ├─ Scandinavian Wood & Linen
  └─ Warm Brass & Opal Glass

Support
  ├─ About Us
  ├─ Shipping & Returns
  └─ Contact
```

**实现方法（WordPress + Blocksy）：**
1. 外观 > 菜单 > 创建新菜单 "Main Navigation"
2. 添加自定义链接（Lighting、Shop by Room、Collections、Support）
3. 添加产品分类（Wall Lights等）作为子菜单项
4. 添加页面（About Us等）作为Support子菜单
5. 在 Blocksy > Header > Menu 中分配菜单

---

## 二、首页UI模块拆解

### 竞品首页模块对比表

| 模块 | Beacon | Fat Shack | LightCo | 必须保留 | 优先级 |
|------|--------|-----------|---------|---------|--------|
| **Hero大图+CTA** | ✅ 全屏轮播 | ✅ 单张大图 | ✅ 视频背景 | ✅ 必须 | P0 |
| **分类入口** | ✅ 6宫格图标 | ✅ 4宫格大图 | ✅ 横向卡片 | ✅ 必须 | P0 |
| **按房间选购** | ✅ 5宫格 | ✅ 3宫格 | ✅ 4宫格 | ✅ 必须 | P0 |
| **热销/Best Sellers** | ✅ 横向滚动 | ✅ 网格展示 | ✅ 推荐产品 | ✅ 必须 | P0 |
| **品牌理念/Story** | ❌ | ✅ 文字+图 | ✅ About Us | ✅ 必须 | P1 |
| **UGC/Reviews** | ✅ 客户评价 | ✅ 评价轮播 | ❌ | ⚠️ 可选 | P2 |
| **服务承诺** | ✅ 免费配送/退换 | ✅ 信任徽章 | ✅ 配送信息 | ✅ 必须 | P0 |
| **Footer** | ✅ 多列链接 | ✅ 简洁 | ✅ 完整信息 | ✅ 必须 | P0 |

### 首页模块详细结构

#### 1. Hero区域（必须保留）

**Beacon模式：**
- 全屏轮播图（1920x1080）
- 标题：大号字体（48-64px）
- 副标题：中等字体（24-32px）
- CTA按钮：主色背景，白色文字，圆角8px

**实现（Blocksy + Gutenberg）：**
```
Cover Block
  - 背景图片（全屏）
  - 内容对齐：居中
  - 内边距：上下120px
  - 文字颜色：白色
  - 标题：Heading Block (H1, 64px, 粗体)
  - 副标题：Paragraph Block (24px, 中等粗细)
  - 按钮：Buttons Block
    - 文字："Shop Now"
    - 背景色：#D4A574 (暖棕色)
    - 文字色：#FFFFFF
    - 圆角：8px
    - 内边距：16px 32px
```

#### 2. 分类入口（Shop by Category）- 6宫格

**Fat Shack模式：**
- 6个卡片，每个包含：
  - 图标/缩略图（300x300px）
  - 分类名称（18px，粗体）
  - 简短描述（14px，灰色）

**实现（Blocksy + Gutenberg）：**
```
Columns Block (6列，移动端2列)
  每个Column包含：
    - Image Block (300x300, 圆角12px)
    - Heading Block (H3, 18px, 粗体)
    - Paragraph Block (14px, 颜色#666)
    - 链接：Wrap整个Column在Link Block中
```

#### 3. 按房间选购（Shop by Room）- 4宫格

**LightCo模式：**
- 4个大图卡片（600x400px）
- 房间名称覆盖在图片上（白色文字，半透明背景）

**实现（Blocksy + Gutenberg）：**
```
Columns Block (4列，移动端1列)
  每个Column包含：
    - Cover Block
      - 背景图片（600x400）
      - 内容：房间名称（H2, 32px, 白色，粗体）
      - 覆盖层：rgba(0,0,0,0.3)
      - 链接：Wrap整个Cover Block
```

#### 4. 热销区（Best Sellers）

**Beacon模式：**
- 标题："Best Sellers" (H2, 32px)
- 产品网格：4列（移动端1列）
- 每个产品卡片：
  - 产品图（400x400px，白底）
  - 产品名称（16px）
  - 价格（18px，粗体）
  - "Add to Cart"按钮

**实现（WooCommerce）：**
```
WooCommerce Products Block
  - 列数：4（桌面），1（移动）
  - 显示：图片、标题、价格、按钮
  - 排序：按销量
  - 数量：8个产品
```

#### 5. 品牌理念区（Brand Story）

**Fat Shack模式：**
- 左右布局（图片+文字）
- 标题："Our Story" (H2)
- 文字描述（3-4段）
- CTA按钮："Learn More"

**实现（Blocksy + Gutenberg）：**
```
Columns Block (2列，移动端1列)
  左列：
    - Image Block (600x600, 圆角12px)
  右列：
    - Heading Block (H2, 32px)
    - Paragraph Block (多段文字，16px, 行高1.6)
    - Buttons Block ("Learn More")
```

#### 6. 服务承诺条（必须保留）

**Beacon模式：**
- 横向4个图标+文字
- 图标：配送/退换/客服/安全支付

**实现（Blocksy + Gutenberg）：**
```
Group Block (背景色：#F5F5F5, 内边距：40px)
  Columns Block (4列，移动端1列)
    每个Column：
      - Icon Block (SVG图标，32x32)
      - Heading Block (H4, 16px)
      - Paragraph Block (14px, 灰色)
```

#### 7. Footer

**标准结构：**
- 4列：产品分类、支持、关于、联系
- 底部：版权信息

**实现（Blocksy）：**
```
Blocksy > Footer
  - 列数：4
  - 第1列：产品分类链接
  - 第2列：Support页面链接
  - 第3列：About Us
  - 第4列：联系方式
  - 底部：版权信息
```

---

## 三、产品列表页（PLP）筛选维度

### 竞品筛选对比

| 筛选维度 | Beacon | Fat Shack | LightCo | 必须保留 |
|---------|--------|-----------|---------|---------|
| **价格范围** | ✅ 滑块 | ✅ 下拉 | ✅ 复选框 | ✅ 必须 |
| **产品类型** | ✅ 多选 | ✅ 单选 | ✅ 多选 | ✅ 必须 |
| **房间** | ✅ 标签 | ✅ 标签 | ✅ 标签 | ✅ 必须 |
| **风格** | ✅ 标签 | ✅ 标签 | ❌ | ⚠️ 可选 |
| **材质** | ✅ 多选 | ✅ 多选 | ✅ 多选 | ✅ 必须 |
| **颜色** | ✅ 色块 | ✅ 色块 | ✅ 色块 | ✅ 必须 |
| **电压/插头** | ❌ | ❌ | ❌ | ✅ 必须（澳洲特色） |
| **排序** | ✅ 价格/新品/销量 | ✅ 价格/新品 | ✅ 价格/新品 | ✅ 必须 |

### PLP筛选实现（WooCommerce）

**使用插件：** WooCommerce Product Filter 或 Filter Everything

**筛选器配置：**
```
左侧边栏（桌面）/ 顶部折叠（移动端）

1. 价格筛选
   - 类型：Range Slider
   - 属性：_price

2. 产品类型
   - 类型：Checkbox
   - 分类：product_cat (Wall Lights, Pendant Lights等)

3. 房间
   - 类型：Checkbox
   - 标签：product_tag (Bedroom, Living Room等)

4. 材质
   - 类型：Checkbox
   - 属性：pa_material (自定义属性)

5. 颜色
   - 类型：Color Swatches
   - 属性：pa_color

6. 电压/插头（澳洲特色）
   - 类型：Checkbox
   - 属性：pa_voltage (220-240V)
   - 属性：pa_plug (AU Plug)

7. 排序
   - 默认：WooCommerce默认排序器
   - 选项：价格低到高、价格高到低、最新、最受欢迎
```

### 产品卡片样式

**Beacon模式（推荐）：**
- 卡片尺寸：300x400px
- 图片：300x300px（白底，圆角8px）
- 产品名称：16px，粗体，2行截断
- 价格：18px，粗体，主色
- 悬停效果：图片放大1.05倍，阴影加深

**实现（Blocksy + WooCommerce）：**
```
Blocksy > WooCommerce > Shop
  - 产品卡片布局：Grid
  - 列数：4（桌面），2（平板），1（移动）
  - 图片比例：1:1
  - 圆角：8px
  - 悬停效果：启用
  - 显示：图片、标题、价格、按钮
```

**CSS自定义（Blocksy > 自定义CSS）：**
```css
.woocommerce ul.products li.product {
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
}

.woocommerce ul.products li.product:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}

.woocommerce ul.products li.product img {
  border-radius: 8px 8px 0 0;
  background: #fff;
}
```

---

## 四、产品详情页（PDP）结构

### 竞品PDP对比

| 模块 | Beacon | Fat Shack | LightCo | 优先级 | 必须保留 |
|------|--------|-----------|---------|--------|---------|
| **主图区域** | 轮播（4-6张） | 单图+缩略图 | 轮播+放大镜 | P0 | ✅ |
| **产品信息** | 标题+价格+描述 | 标题+价格+描述 | 标题+价格+描述 | P0 | ✅ |
| **购买按钮** | Add to Cart | Add to Cart | Add to Cart | P0 | ✅ |
| **信任提示** | 配送/退换 | 配送/退换 | 配送/退换 | P0 | ✅ |
| **参数表格** | 详细规格 | 详细规格 | 详细规格 | P0 | ✅ |
| **详细描述** | 多段文字+图 | 多段文字+图 | 多段文字+图 | P0 | ✅ |
| **场景图** | ✅ | ✅ | ✅ | P0 | ✅ |
| **推荐产品** | ✅ | ✅ | ✅ | P0 | ✅ |
| **评价** | ✅ | ✅ | ❌ | P1 | ⚠️ |
| **安装指南** | ❌ | ❌ | ✅ | P2 | ⚠️ |

### PDP布局结构（最终方案）

#### 布局：左右分栏（桌面）/ 上下堆叠（移动）

**左栏（60%）：图片区域**
**右栏（40%）：产品信息**

#### 详细模块拆解

##### 1. 主图区域（左栏）

**结构：**
```
Gallery Block (WooCommerce默认)
  - 主图：800x800px（白底图）
  - 缩略图：100x100px（4-6张）
  - 功能：点击切换、放大镜（可选）
  - 包含：白底图 + 场景图（各2-3张）
```

**实现（WooCommerce + Blocksy）：**
```
Blocksy > WooCommerce > Single Product
  - 图片布局：Gallery（左侧）
  - 缩略图位置：下方
  - 图片尺寸：800x800
  - 启用：图片放大镜（Zoom）
```

##### 2. 产品信息区域（右栏）

**从上到下顺序：**

**A. 产品标题**
```
Heading Block (H1)
  - 字体：32px，粗体
  - 颜色：#1a1a1a
  - 行高：1.2
```

**B. 价格**
```
Price Block (WooCommerce)
  - 字体：28px，粗体
  - 颜色：#D4A574 (主色)
  - 格式：$XXX.XX
```

**C. 简短描述**
```
Short Description (WooCommerce)
  - 字体：16px
  - 颜色：#666
  - 行高：1.6
  - 最大高度：3行（超出显示...）
```

**D. 购买区域**
```
Group Block
  ├─ Quantity Selector (数量选择器)
  │   - 类型：数字输入框
  │   - 默认：1
  │   - 最小：1
  │   - 最大：10
  │
  └─ Add to Cart Button
      - 文字："Add to Cart"
      - 背景色：#D4A574
      - 文字色：#FFFFFF
      - 字体：16px，粗体
      - 圆角：8px
      - 内边距：16px 32px
      - 宽度：100%
      - 悬停：背景色加深10%
```

**E. 信任提示条（购买按钮下方）**
```
Group Block (背景：#F9F9F9, 圆角：8px, 内边距：16px)
  Columns Block (2列)
    左列：
      - Icon (SVG, 24x24, 颜色：#D4A574)
      - Text: "支持澳规插头 / RCM认证"
    右列：
      - Icon (SVG, 24x24, 颜色：#D4A574)
      - Text: "30天退换 / 适配220-240V"
  - 字体：14px
  - 颜色：#666
```

**F. 参数表格（折叠式）**
```
Accordion Block (Blocksy或自定义)
  标题："产品规格"
  内容：Table Block
    ├─ 尺寸 (Dimensions): XXX x XXX x XXX cm
    ├─ 材质 (Materials): [材质列表]
    ├─ 电压 (Voltage): 220-240V
    ├─ 插头 (Plug): AU Plug
    ├─ 认证 (Certification): RCM
    └─ 重量 (Weight): X.X kg
```

**G. 配送信息**
```
Group Block
  - Icon: 配送图标
  - Text: "澳洲全境配送 | 5-7个工作日 | 免费配送订单满$150"
```

##### 3. 详细描述区域（全宽，图片下方）

**结构：**
```
Tabs Block (Blocksy Tabs)
  Tab 1: "产品详情"
    - 多段文字描述
    - 产品特点（Bullet Points）
    - 使用场景描述
  
  Tab 2: "场景图"
    - Gallery Block (场景图4-6张)
    - 每张图：1200x800px
  
  Tab 3: "尺寸指南"（可选）
    - 尺寸图
    - 安装说明
```

##### 4. 推荐产品区块（全宽）

**结构：**
```
Group Block
  ├─ Heading Block (H2): "你可能还喜欢"
  └─ WooCommerce Products Block
      - 列数：4
      - 显示：图片、标题、价格、按钮
      - 排序：相关产品（WooCommerce默认）
      - 数量：4个
```

---

## 五、转化关键点

### 信任元素对比

| 元素 | Beacon | Fat Shack | LightCo | 必须保留 |
|------|--------|-----------|---------|---------|
| **配送承诺** | ✅ 免费配送$150+ | ✅ 快速配送 | ✅ 配送信息 | ✅ 必须 |
| **退换政策** | ✅ 30天退换 | ✅ 退换说明 | ✅ 退换政策 | ✅ 必须 |
| **安全支付** | ✅ 支付图标 | ✅ 支付图标 | ✅ 支付图标 | ✅ 必须 |
| **客户评价** | ✅ 星级+评价 | ✅ 评价轮播 | ❌ | ⚠️ 可选 |
| **认证标识** | ❌ | ❌ | ❌ | ✅ 必须（RCM） |
| **库存状态** | ✅ 有货/缺货 | ✅ 库存显示 | ✅ 库存显示 | ✅ 必须 |

### 服务承诺条实现

**位置：** Header下方（粘性条）或Footer上方

**内容：**
```
Free Shipping Over $150 | 30-Day Returns | RCM Certified | AU Plug Ready
```

**实现（Blocksy）：**
```
Blocksy > Header > Additional Elements
  - 类型：HTML Block
  - 内容：
    <div class="trust-bar" style="background: #F5F5F5; padding: 12px 0; text-align: center; font-size: 14px; color: #666;">
      <span>🚚 Free Shipping Over $150</span> | 
      <span>↩️ 30-Day Returns</span> | 
      <span>✓ RCM Certified</span> | 
      <span>🔌 AU Plug Ready</span>
    </div>
```

### 按钮层级

**主按钮（Primary）：**
- 背景：#D4A574 (暖棕色)
- 文字：#FFFFFF
- 字体：16px，粗体
- 圆角：8px
- 内边距：16px 32px
- 使用场景：Add to Cart、Shop Now、Submit

**次按钮（Secondary）：**
- 背景：透明
- 边框：2px solid #D4A574
- 文字：#D4A574
- 字体：16px，中等
- 圆角：8px
- 内边距：16px 32px
- 使用场景：Learn More、View All、Cancel

**实现（Blocksy自定义CSS）：**
```css
/* 主按钮 */
.wp-element-button.is-style-primary,
.woocommerce button.button.alt,
.add_to_cart_button {
  background-color: #D4A574 !important;
  color: #FFFFFF !important;
  border: none;
  border-radius: 8px;
  padding: 16px 32px;
  font-size: 16px;
  font-weight: 600;
  transition: background-color 0.3s;
}

.wp-element-button.is-style-primary:hover,
.woocommerce button.button.alt:hover {
  background-color: #C49564 !important;
}

/* 次按钮 */
.wp-element-button.is-style-secondary {
  background-color: transparent !important;
  color: #D4A574 !important;
  border: 2px solid #D4A574;
  border-radius: 8px;
  padding: 16px 32px;
}
```

### 对比度和可访问性

**文字对比度（WCAG AA标准）：**
- 主文字：#1a1a1a on #FFFFFF (对比度 16.5:1) ✅
- 次要文字：#666 on #FFFFFF (对比度 7.1:1) ✅
- 按钮文字：#FFFFFF on #D4A574 (对比度 4.5:1) ✅

**交互反馈：**
- 按钮悬停：背景色加深10%
- 链接悬停：下划线 + 颜色变化
- 输入框焦点：边框颜色变化

---

## 六、WordPress实现清单

### 必须安装的插件

1. **WooCommerce** ✅ (已安装)
2. **Filter Everything** - 产品筛选
3. **WooCommerce Product Table** - 参数表格（可选）
4. **YITH WooCommerce Zoom Magnifier** - 图片放大（可选）
5. **Blocksy Companion** - Blocksy扩展功能

### 设置步骤

#### Step 1: 创建产品属性（WooCommerce > 属性）

```
1. 材质 (Material)
   - 值：Wood, Metal, Glass, Linen, Brass, Opal Glass

2. 颜色 (Color)
   - 值：White, Black, Natural Wood, Brass, Opal

3. 电压 (Voltage)
   - 值：220-240V

4. 插头 (Plug)
   - 值：AU Plug

5. 认证 (Certification)
   - 值：RCM
```

#### Step 2: 配置产品详情页模板

**Blocksy > 自定义 > WooCommerce > Single Product**

```
布局设置：
  - 图片位置：左侧
  - 图片宽度：60%
  - 信息宽度：40%
  - 启用：图片放大镜

内容设置：
  - 显示：标题、价格、简短描述、购买按钮、详细描述
  - 隐藏：SKU、分类、标签（或移到详细描述）
```

#### Step 3: 创建首页模板

**页面 > 编辑首页**

使用Gutenberg区块按以下顺序添加：

1. Cover Block (Hero)
2. Columns Block (分类入口，6列)
3. Columns Block (按房间选购，4列)
4. WooCommerce Products Block (热销)
5. Columns Block (品牌理念，2列)
6. Group Block (服务承诺，4列)

#### Step 4: 设置导航菜单

**外观 > 菜单**

创建菜单结构（见"一、导航结构"部分）

#### Step 5: 配置筛选器（Filter Everything）

**Filter Everything > Filters**

创建筛选器：
- 价格范围
- 产品分类
- 产品标签（房间）
- 产品属性（材质、颜色、电压、插头）

---

## 七、最终UI方案总结

### 必须保留的模块（P0）

1. ✅ Hero大图+CTA
2. ✅ 分类入口（6宫格）
3. ✅ 按房间选购（4宫格）
4. ✅ 热销区
5. ✅ 服务承诺条
6. ✅ 产品详情页完整布局
7. ✅ 信任提示（PDP购买按钮下方）
8. ✅ 参数表格（PDP）

### 可选模块（P1-P2）

1. ⚠️ 品牌理念区（P1）
2. ⚠️ UGC/评价（P2）
3. ⚠️ 安装指南（P2）

### 澳洲特色元素（必须）

1. ✅ 电压：220-240V
2. ✅ 插头：AU Plug
3. ✅ 认证：RCM
4. ✅ 配送：澳洲全境
5. ✅ 退换：30天

---

## 八、下一步行动

1. **立即执行：**
   - 创建产品属性（材质、颜色、电压、插头）
   - 设置导航菜单结构
   - 搭建首页Hero和分类入口区块

2. **本周完成：**
   - 完成首页所有模块
   - 配置PDP模板
   - 设置筛选器

3. **产品上架前：**
   - 测试PDP模板
   - 添加信任元素
   - 优化按钮样式







