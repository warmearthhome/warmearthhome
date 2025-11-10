# Cursor 团队功能检查指南

## 如何检查您的 Cursor 版本

### 方法1：通过 Cursor 界面检查

1. **打开 Cursor**
2. **查看菜单栏**
   - Windows: 点击左上角的 **"Cursor"** 菜单
   - Mac: 点击左上角的 **"Cursor"** 菜单
3. **选择 "About Cursor"** 或 **"关于 Cursor"**
4. **查看版本号**

### 方法2：通过设置检查

1. **打开设置**
   - Windows: `Ctrl + ,` 或 `File > Preferences > Settings`
   - Mac: `Cmd + ,` 或 `Cursor > Preferences > Settings`
2. **搜索 "version"** 或 **"版本"**
3. **查看版本信息**

## Cursor 团队功能（如果可用）

### 检查是否有团队功能

1. **打开设置**
   - `Ctrl + ,` (Windows) 或 `Cmd + ,` (Mac)
2. **搜索以下关键词**：
   - "team"（团队）
   - "collaboration"（协作）
   - "workspace"（工作区）
   - "invite"（邀请）
   - "share"（分享）

### 常见团队功能位置

如果 Cursor 支持团队功能，通常会在以下位置：

1. **账户设置**
   - `File > Preferences > Account`
   - 或 `Cursor > Settings > Account`

2. **工作区设置**
   - `File > Preferences > Workspace`
   - 或右键点击项目文件夹

3. **命令面板**
   - `Ctrl + Shift + P` (Windows) 或 `Cmd + Shift + P` (Mac)
   - 输入 "team" 或 "invite" 查看相关命令

## 当前 Cursor 版本的功能

### 已知功能（截至 2024-2025）

1. **`.cursorrules` 文件**
   - 可以在项目根目录创建 `.cursorrules` 文件
   - 团队成员克隆项目后会自动读取

2. **项目配置共享**
   - 通过 Git 共享项目配置
   - 团队成员拉取后自动应用

3. **设置同步**（如果可用）
   - 可能支持通过账户同步设置
   - 需要登录 Cursor 账户

## 如何邀请团队成员（如果功能可用）

### 如果 Cursor 有团队功能：

1. **打开项目设置**
   - 右键点击项目文件夹
   - 或通过命令面板

2. **查找 "Invite" 或 "邀请" 选项**
   - 可能在工作区设置中
   - 或在账户设置中

3. **输入团队成员邮箱**
   - 输入要邀请的成员邮箱地址
   - 选择权限级别（如果有）

4. **发送邀请**
   - 点击 "Send Invite" 或 "发送邀请"
   - 团队成员会收到邮件邀请

## 替代方案：通过 Git 协作

如果 Cursor 当前版本不支持团队邀请，可以通过以下方式协作：

### 1. 共享 `.cursorrules` 文件

在项目根目录创建 `.cursorrules` 文件：

```
# Warm Earth Home 项目规则

## 项目信息
- 网站：warmearthhome.com
- 平台：WordPress + WooCommerce
- 主题：Blocksy

## 编码规范
- 使用中文注释
- 遵循 WordPress 编码标准
- SEO 优化优先

## 工作流程
1. 所有代码必须简洁有效
2. 符合 SEO 优化逻辑
3. 使用语义化 HTML5 标签
```

### 2. 创建项目文档

创建 `README.md` 和 `CONTRIBUTING.md` 文件，说明：
- 项目结构
- 开发流程
- 代码规范
- 协作方式

### 3. 使用 Git 仓库

1. **创建 Git 仓库**
   - GitHub
   - GitLab
   - Bitbucket

2. **邀请团队成员**
   - 在 Git 平台邀请成员
   - 分配权限

3. **共享项目**
   - 团队成员克隆仓库
   - 自动获取 `.cursorrules` 和配置

## 检查步骤总结

1. ✅ 检查 Cursor 版本（菜单 > About）
2. ✅ 检查设置中是否有 "team" 或 "collaboration" 选项
3. ✅ 检查命令面板（`Ctrl+Shift+P`）中是否有团队相关命令
4. ✅ 查看 Cursor 官方文档：https://cursor.sh/docs
5. ✅ 查看 Cursor 更新日志，了解最新功能

## 建议

1. **查看官方文档**
   - 访问：https://cursor.sh/docs
   - 查看是否有团队功能说明

2. **检查更新**
   - 确保 Cursor 是最新版本
   - 新版本可能添加了团队功能

3. **联系支持**
   - 如果找不到团队功能，可以联系 Cursor 支持
   - 询问是否有团队协作功能

4. **使用替代方案**
   - 通过 Git 和 `.cursorrules` 文件协作
   - 这是最可靠的方式

