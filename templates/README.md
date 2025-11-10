# Warm Earth Home - Templates Guide

> 网站模板使用指南

## 📁 文件结构

```
templates/
├── html/                          # HTML 参考模板
│   ├── homepage-template.html    # 首页 HTML 模板（参考）
│   ├── plp-template.html         # 产品列表页 HTML 模板（参考）
│   └── pdp-template.html         # 产品详情页 HTML 模板（参考）
├── wordpress/                     # WordPress 页面模板
│   └── page-homepage.php         # 首页 WordPress 模板
└── woocommerce/                   # WooCommerce 自定义模板
    ├── archive-product.php       # 产品列表页模板
    ├── single-product.php        # 产品详情页模板
    └── content-product.php       # 产品卡片模板
```

## 🚀 使用方法

### 1. HTML 参考模板

HTML 模板位于 `templates/html/` 目录，用于：
- **参考结构**：了解页面 HTML 结构
- **样式测试**：在浏览器中直接打开测试样式
- **开发参考**：作为 WordPress 模板开发的参考

**使用方法**：
1. 直接在浏览器中打开 HTML 文件
2. 确保 CSS 和 JS 文件路径正确（相对路径）
3. 替换图片路径为实际图片

### 2. WordPress 页面模板

#### 首页模板 (`page-homepage.php`)

**安装步骤**：
1. 将 `page-homepage.php` 复制到你的主题目录
2. 在 WordPress 后台创建新页面
3. 在页面属性中选择模板："Homepage Template"
4. 使用 ACF（Advanced Custom Fields）或自定义字段添加内容：
   - Hero Slides（轮播图）
   - Modern Earth Series（系列卡片）
   - Urban Glow Series（系列卡片）
   - Shop by Space（空间卡片）
   - Brand Philosophy（品牌理念）

**需要的自定义字段**：
- `hero_slides` (Repeater)
  - `title` (Text)
  - `subtitle` (Text)
  - `cta_1_text` (Text)
  - `cta_1_link` (URL)
  - `cta_2_text` (Text)
  - `cta_2_link` (URL)
  - `image` (Image)
- `modern_earth_series` (Group)
  - `title` (Text)
  - `description` (Text)
  - `image` (Image)
  - `link` (URL)
  - `cta` (Text)
- `urban_glow_series` (Group)
  - 同上
- `shop_by_space` (Repeater)
  - `title` (Text)
  - `image` (Image)
  - `link` (URL)
  - `cta` (Text)
- `brand_philosophy` (Group)
  - `quote` (Text)
  - `values` (Repeater)
    - `title` (Text)
    - `description` (Text)
  - `cta_link` (URL)
  - `cta_text` (Text)
  - `philosophy_image` (Image)
- `testimonials` (Repeater, Optional)
  - `rating` (Number)
  - `text` (Textarea)
  - `author` (Text)

### 3. WooCommerce 自定义模板

#### 产品列表页 (`archive-product.php`)

**安装步骤**：
1. 将 `archive-product.php` 复制到 `your-theme/woocommerce/` 目录
2. 如果目录不存在，创建它
3. 模板会自动应用到所有产品列表页

**功能**：
- 面包屑导航
- 页面标题和描述
- 顶部介绍段落（SEO 关键词）
- 筛选和排序栏
- 产品网格
- 空状态提示
- Lifestyle Row（可选）
- Footer CTA

**自定义字段**（可选）：
- `lifestyle_row` (Group, 在 Options 页面)
  - `title` (Text)
  - `image` (Image)
  - `link` (URL)
  - `cta` (Text)

#### 产品详情页 (`single-product.php`)

**安装步骤**：
1. 将 `single-product.php` 复制到 `your-theme/woocommerce/` 目录
2. 模板会自动应用到所有产品详情页

**功能**：
- 面包屑导航
- 产品图片画廊（主图 + 缩略图）
- 产品信息面板
- 系列标签
- Energy Efficiency 标签
- 价格和 Afterpay 选项
- 变体选择器
- 添加到购物车按钮
- 信任徽章
- 分享按钮
- 标签页（Overview, Specifications, Installation & Care, Shipping & Returns）
- 尺寸图 PDF 下载
- 相关产品
- 移动端 Sticky Cart Bar
- Schema.org 标记

**需要的产品自定义字段**：
- `_energy_efficiency_tag` (Text) - Energy Efficiency 标签
- `_installation_type` (Select) - 安装类型（hardwired/plug-in）
- `_product_overview` (WYSIWYG) - 产品概述
- `_dimensions` (Text) - 尺寸
- `_material` (Text) - 材质
- `_bulb_type` (Text) - 灯泡类型
- `_warranty` (Text) - 保修期
- `_size_guide_pdf` (File) - 尺寸图 PDF
- `_size_guide_pdf_size` (Text) - PDF 文件大小
- `_installation_guide` (WYSIWYG) - 安装指南
- `_installation_pdf` (File) - 安装指南 PDF
- `_installation_pdf_size` (Text) - PDF 文件大小
- `_care_guide` (WYSIWYG) - 护理指南
- `_styled_shots` (WYSIWYG) - 搭配建议

#### 产品卡片 (`content-product.php`)

**安装步骤**：
1. 将 `content-product.php` 复制到 `your-theme/woocommerce/` 目录
2. 模板会自动应用到所有产品列表中的产品卡片

**功能**：
- 产品图片（4:5 比例）
- 产品标签（Sale, Best Seller, New）
- 产品名称
- 价格
- Quick View 按钮
- Add to Cart 按钮

## 🎨 样式和脚本

所有模板都使用以下文件：
- `assets/css/warm-earth-home.css` - 自定义样式
- `assets/js/warm-earth-home.js` - 自定义脚本

确保这些文件已正确加载（通过 `functions-weh-enhancements.php`）。

## 📝 注意事项

1. **自定义字段**：模板使用 ACF（Advanced Custom Fields）或 WordPress 自定义字段。如果没有 ACF，需要手动添加字段或使用其他方法。

2. **图片尺寸**：确保已添加自定义图片尺寸（通过 `functions-weh-enhancements.php`）：
   - `weh-product` (400x500) - 产品图
   - `weh-lifestyle` (1200x675) - 生活方式图
   - `weh-hero` (1920x1080) - Hero 图

3. **WooCommerce 功能**：确保 WooCommerce 已安装并激活。

4. **响应式设计**：所有模板都是响应式的，在移动端会自动调整布局。

5. **性能优化**：
   - 图片使用 WebP 格式
   - 启用懒加载
   - 图片大小控制在 400KB 以内

## 🔧 自定义

### 修改颜色

在 `assets/css/warm-earth-home.css` 中修改 CSS 变量：

```css
:root {
  --weh-deep-clay: #A46758;  /* 主色 */
  --weh-warm-sand: #F6E9DD;  /* 背景色 */
  /* ... */
}
```

### 修改字体

在 `assets/css/warm-earth-home.css` 中修改字体变量：

```css
:root {
  --weh-font-heading: 'Playfair Display', 'Georgia', serif;
  --weh-font-body: 'Inter', 'Helvetica Neue', 'Arial', sans-serif;
}
```

### 添加新模块

参考现有模板结构，添加新的模块。确保：
1. 使用正确的 CSS 类名
2. 遵循 8px 间距系统
3. 保持响应式设计
4. 添加适当的 ARIA 标签

## 📚 参考文档

- [首页模块拆解](docs/design/homepage.md)
- [产品列表页](docs/design/plp.md)
- [产品详情页](docs/design/pdp.md)
- [视觉指南](docs/design/visual-guide.md)

## 🆘 需要帮助？

如果遇到问题，请参考：
- WordPress 官方文档
- WooCommerce 文档
- 项目设计文档（`docs/design/`）

