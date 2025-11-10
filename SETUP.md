# Warm Earth Home - 网站搭建指南

> 基于设计文档的 WordPress 网站搭建步骤

## 📋 前置要求

- WordPress 6.0+
- WooCommerce 8.0+（用于电商功能）
- Blocksy 主题（推荐）或兼容主题
- PHP 7.4+

## 🚀 安装步骤

### 1. 上传文件到 WordPress

将以下文件上传到你的 WordPress 主题目录（通常是 `wp-content/themes/your-theme/`）：

```
your-theme/
├── assets/
│   ├── css/
│   │   └── warm-earth-home.css
│   └── js/
│       └── warm-earth-home.js
└── functions-weh-enhancements.php
```

### 2. 在主题的 functions.php 中引入增强文件

在你的主题 `functions.php` 文件末尾添加：

```php
// Warm Earth Home Enhancements
require_once get_template_directory() . '/functions-weh-enhancements.php';
```

### 3. 配置 Blocksy 主题

1. **进入 WordPress 后台** → **外观** → **自定义**
2. **设置品牌色彩**：
   - Warm Sand: `#F6E9DD`
   - Deep Clay: `#A46758`
   - Urban Slate: `#3E4A52`
3. **设置字体**：
   - 标题字体：Playfair Display
   - 正文字体：Inter
4. **保存并发布**

### 4. 创建页面结构

根据 `docs/design/structure.md` 创建以下页面：

- **首页**：使用 Gutenberg 编辑器，按照 `docs/design/homepage.md` 的 9 个模块创建
- **Shop 页面**：使用 WooCommerce 商店页面
- **产品分类页**：Modern Earth Series、Urban Glow Series
- **Inspiration 页面**：创建博客分类
- **About 页面**：Our Story
- **Support 页面**：FAQ、Shipping & Returns、Contact

### 5. 配置 WooCommerce

1. **产品设置**：
   - 启用产品图片（4:5 比例）
   - 添加产品尺寸图 PDF 字段（需要自定义字段插件）
2. **购物车设置**：
   - 启用 AJAX 添加到购物车
   - 配置移动端 Sticky Cart（已在 JS 中实现）

### 6. 添加分析代码

在 WordPress 后台 → **外观** → **主题编辑器** → **主题页脚 (footer.php)** 添加：

```html
<!-- Google Analytics 4 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>

<!-- Meta Pixel -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', 'META_PIXEL_ID');
  fbq('track', 'PageView');
</script>
```

替换 `GA_MEASUREMENT_ID` 和 `META_PIXEL_ID` 为你的实际 ID。

## 📝 使用说明

### CSS 类名

- `.weh-btn-primary` - 主按钮
- `.weh-btn-secondary` - 次按钮
- `.weh-btn-ghost` - 幽灵按钮
- `.weh-product-card` - 产品卡片
- `.weh-series-card` - 系列卡片
- `.weh-container` - 容器（最大宽度 1200px）
- `.weh-section` - 区块间距

### JavaScript 功能

- **移动端 Sticky Cart**：在产品详情页自动显示
- **Quick View**：产品快速预览（需要实现 AJAX）
- **Filter Toggle**：移动端筛选抽屉
- **Lazy Load**：图片懒加载
- **Scroll to Top**：滚动到顶部按钮

## 🎨 下一步

1. **创建首页模板**：按照 `docs/design/homepage.md` 的 9 个模块创建
2. **配置产品列表页**：按照 `docs/design/plp.md` 实现筛选和排序
3. **优化产品详情页**：按照 `docs/design/pdp.md` 添加尺寸图 PDF
4. **创建 Support 页面**：按照 `docs/design/support.md` 实现

## 📚 参考文档

- [导航信息架构](docs/design/structure.md)
- [首页模块拆解](docs/design/homepage.md)
- [产品列表页](docs/design/plp.md)
- [产品详情页](docs/design/pdp.md)
- [Support 页面](docs/design/support.md)
- [视觉指南](docs/design/visual-guide.md)

## ⚠️ 注意事项

1. **备份**：在修改任何文件前，请先备份
2. **测试**：在测试环境先测试所有功能
3. **性能**：确保图片已优化（WebP 格式，<400KB）
4. **SEO**：按照文档添加 Schema.org 标记

## 🆘 需要帮助？

如果遇到问题，请参考：
- WordPress 官方文档
- Blocksy 主题文档
- WooCommerce 文档
- 项目设计文档（`docs/design/`）

