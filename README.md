# Warm Earth Home

Warm Earth Home 是一个温馨的 WordPress 电商网站项目，专注于提供温暖的居家照明产品。

## 项目简介

本项目是一个基于 WordPress + WooCommerce 的电商网站，提供：
- 🏠 温馨的居家照明产品
- 🛒 完整的在线购物体验
- 📱 响应式设计，支持多设备访问
- 🎨 精心设计的UI/UX

## 技术栈

- **CMS**: WordPress
- **电商**: WooCommerce
- **前端**: HTML, CSS, JavaScript
- **后端**: PHP
- **版本控制**: Git + GitHub

## 快速开始

### 环境要求
- PHP 7.4+
- MySQL 5.7+
- WordPress 6.0+
- WooCommerce 8.0+

### 安装步骤

1. **克隆仓库**
   ```bash
   git clone https://github.com/warmearthhome/warmearthhome.git
   cd warmearthhome
   ```

2. **安装 WordPress**
   - 将项目文件上传到 WordPress 安装目录
   - 运行 `setup-warmearthhome.php` 进行初始配置

3. **安装插件**
   - 上传 `weh-css-test-shortcode.zip` 到 WordPress 后台
   - 激活插件

4. **配置主题**
   - 将 CSS 文件内容添加到主题的 `style.css`
   - 将 HTML 模板应用到相应页面

详细安装指南请参考 [wordpress-setup-guide.md](wordpress-setup-guide.md)

## 项目结构

```
warmearthhome/
├── .github/              # GitHub 协作模板
│   ├── ISSUE_TEMPLATE/  # Issue 模板
│   └── pull_request_template.md
├── docs/                # 协作手册、变更记录等
├── 网站图片/            # 图片资源
├── *.php               # WordPress 插件/主题文件
├── *.css               # 样式文件
├── *.html              # HTML 模板
├── *.md                # 文档文件
└── README.md           # 项目说明
```

## 协作流程

- 仓库由 GitHub 组织 **warmearthhome** 托管，核心团队为 `@warmearthhome/core`
- 所有改动需通过 Pull Request 合并至 `main`
- 新建 Issue 会自动添加到 [网站建设 Roadmap 看板](https://github.com/orgs/warmearthhome/projects/1)
- 关闭 Issue / PR 将自动移动到 Done 列，保持任务状态同步
- 详细协作指南请参考 [docs/collaboration-playbook.md](docs/collaboration-playbook.md) 与 [CONTRIBUTING.md](CONTRIBUTING.md)

Git Flow 工作流核心步骤：
1. **创建分支**: 从 `main` 创建 `feature/` 或 `fix/` 分支
2. **开发**: 在分支上实现需求或修复问题
3. **提交**: 使用语义化提交信息（例：`feat:`、`fix:`）
4. **PR**: 创建 Pull Request，填写模板并关联 Issue（`Closes #编号`）
5. **合并**: 自检通过后合并至 `main`，必要时更新发布说明

## 主要功能

- ✅ 产品分类管理
- ✅ 产品详情页模板
- ✅ CSS 验证测试区域
- ✅ Shortcode 插件
- ✅ SEO 优化
- ✅ 响应式设计

## 文档

- [安装指南](wordpress-setup-guide.md)
- [协作指南](CONTRIBUTING.md)
- [团队协作手册](docs/collaboration-playbook.md)
- [变更记录](CHANGELOG.md)
- [CSS验证指南](CSS验证指南.md)
- [SEO优化清单](SEO优化检查清单.md)

## 贡献

欢迎贡献代码！请先阅读 [CONTRIBUTING.md](CONTRIBUTING.md) 与 [docs/collaboration-playbook.md](docs/collaboration-playbook.md) 了解协作流程。

## 许可证

本项目为私有项目，保留所有权利。

## 联系方式

- **GitHub 组织**: [@warmearthhome](https://github.com/warmearthhome)
- **核心团队看板**: [网站建设 Roadmap](https://github.com/orgs/warmearthhome/projects/1)
- **网站**: https://warmearthhome.com

---

**注意**: 本项目正在积极开发中，API和功能可能会发生变化。

