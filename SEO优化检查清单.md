# SEO优化检查清单 - Warm Earth Home

## ✅ 已优化的项目

### CSS优化
- ✅ 移除所有 `!important`（除非必要）
- ✅ 合并transition属性，减少重复
- ✅ 使用 `inset: 0` 替代 `top/left/right/bottom: 0`
- ✅ 移除冗余注释，精简代码
- ✅ 优化响应式断点，合并相同规则
- ✅ 图片添加 `width` 和 `height` 属性（防止CLS）

### HTML语义化
- ✅ 使用语义化标签：`<section>`, `<article>`, `<nav>`
- ✅ 表格使用 `<thead>` 和 `<tbody>` 结构
- ✅ 表格使用 `scope` 属性（`scope="row"`, `scope="col"`）
- ✅ SVG图标添加 `aria-hidden="true"`
- ✅ 链接添加 `aria-label` 描述
- ✅ 区域添加 `aria-labelledby` 或 `aria-label`
- ✅ 确保H1在页面中只出现一次
- ✅ 正确的heading层级（H1 > H2 > H3）

### 图片优化
- ✅ 所有图片添加 `alt` 属性（描述性文字）
- ✅ 添加 `width` 和 `height` 属性（防止布局偏移）
- ✅ 使用 `loading="lazy"` 延迟加载

### 可访问性
- ✅ 所有交互元素有明确的标签
- ✅ 图标使用 `aria-hidden="true"`
- ✅ 装饰性元素不干扰屏幕阅读器

## ⚠️ 需要手动检查的项目

### 结构化数据（Schema.org）
需要在WordPress中配置：
- Product Schema（产品页面）
- Organization Schema（网站信息）
- BreadcrumbList Schema（面包屑导航）

**实现方法：**
使用 Rank Math SEO 或 Yoast SEO 插件自动生成

### 元标签优化
确保每个页面有：
- 唯一的 `<title>` 标签（50-60字符）
- 唯一的 `<meta name="description">`（150-160字符）
- Open Graph 标签（社交媒体分享）
- Twitter Card 标签

**实现方法：**
使用 Rank Math SEO 插件配置

### 页面速度优化
- 图片压缩（WebP格式）
- 延迟加载非关键CSS
- 最小化JavaScript
- 使用CDN

**实现方法：**
使用 LiteSpeed Cache（已安装）配置

### 移动端优化
- 确保所有按钮可点击区域 ≥ 44x44px
- 文字大小 ≥ 16px（避免自动缩放）
- 触摸目标间距充足

## 📋 实施检查清单

### 首页
- [ ] H1标签：品牌名称（只出现一次）
- [ ] 所有图片有alt属性
- [ ] 所有链接有描述性文字或aria-label
- [ ] 使用语义化HTML5标签
- [ ] 添加结构化数据（Organization）

### 产品列表页（PLP）
- [ ] 页面标题包含分类名称
- [ ] 面包屑导航正确
- [ ] 产品卡片图片有alt属性
- [ ] 筛选器使用语义化标签
- [ ] 分页链接正确

### 产品详情页（PDP）
- [ ] H1标签：产品名称（只出现一次）
- [ ] 产品图片有详细alt描述
- [ ] 参数表格使用正确的表格结构
- [ ] 添加Product Schema结构化数据
- [ ] 面包屑导航正确
- [ ] 相关产品链接正确

### 导航菜单
- [ ] 使用 `<nav>` 标签
- [ ] 菜单项有明确的链接文字
- [ ] 下拉菜单可访问（键盘导航）
- [ ] 当前页面有 `aria-current="page"`

## 🔍 SEO最佳实践

### 内容优化
1. **标题层级**
   - H1：每页只有一个，包含主要关键词
   - H2：主要章节标题
   - H3：子章节标题

2. **关键词使用**
   - 自然融入内容，避免堆砌
   - 在标题、描述、alt属性中使用
   - 使用长尾关键词（如 "wall lights Australia"）

3. **内部链接**
   - 使用描述性锚文本
   - 链接到相关产品和页面
   - 建立清晰的网站结构

### 技术SEO
1. **URL结构**
   - 简洁、描述性URL
   - 使用连字符分隔单词
   - 避免过深层级

2. **robots.txt**
   - 允许搜索引擎爬取
   - 禁止爬取管理页面

3. **sitemap.xml**
   - 自动生成（使用Rank Math）
   - 提交到Google Search Console

4. **页面速度**
   - Core Web Vitals优化
   - LCP < 2.5s
   - FID < 100ms
   - CLS < 0.1

## 🚀 立即执行

1. **安装Rank Math SEO插件**
   - 配置基本SEO设置
   - 启用结构化数据
   - 配置sitemap

2. **检查所有页面**
   - 确保每个页面有唯一title和description
   - 检查H1标签使用
   - 验证图片alt属性

3. **提交sitemap**
   - Google Search Console
   - Bing Webmaster Tools

4. **测试页面速度**
   - Google PageSpeed Insights
   - GTmetrix
   - 根据建议优化







