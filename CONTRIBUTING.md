# 贡献指南

欢迎参与 Warm Earth Home 项目的开发！本指南将帮助你了解如何参与协作。

## 协作流程

### 1. 创建分支
所有新功能或bug修复都应该在独立的分支上开发：

```bash
# 从 main 分支创建新分支
git checkout main
git pull origin main
git checkout -b feature/功能名称
# 或
git checkout -b fix/bug描述
```

### 2. 开发与提交
- 编写代码并测试
- 提交时使用清晰的提交信息：
  ```
  feat: 添加产品详情页模板
  fix: 修复移动端样式问题
  docs: 更新安装指南
  ```

### 3. 创建 Pull Request
1. 推送分支到远程：
   ```bash
   git push -u origin feature/功能名称
   ```
2. 在 GitHub 上创建 Pull Request
3. 填写 PR 模板中的所有信息
4. 等待审查（自己审查也可以）

### 4. 合并到 main
- PR 通过审查后，合并到 main 分支
- 删除已合并的分支

## 代码规范

### 提交信息格式
- `feat:` 新功能
- `fix:` Bug修复
- `docs:` 文档更新
- `style:` 代码格式调整（不影响功能）
- `refactor:` 代码重构
- `test:` 测试相关
- `chore:` 构建/工具相关

### 代码风格
- 保持代码简洁易读
- 添加必要的注释
- 遵循项目现有的代码风格

## 报告问题

### Bug报告
使用 [Bug报告模板](.github/ISSUE_TEMPLATE/bug_report.md) 创建Issue，包含：
- 清晰的bug描述
- 复现步骤
- 预期行为 vs 实际行为
- 环境信息

### 功能请求
使用 [功能请求模板](.github/ISSUE_TEMPLATE/feature_request.md) 创建Issue，包含：
- 功能描述
- 解决的问题
- 建议的实现方案

## 协作工具

### GitHub Projects
使用 GitHub Projects 看板管理任务：
- **Todo**: 待开始的任务
- **In Progress**: 进行中的任务
- **Done**: 已完成的任务

### Issues
- 使用 Issues 跟踪bug和功能请求
- 为Issue添加合适的标签
- 将Issue关联到PR（使用 `Closes #Issue编号`）

## 需要帮助？

如果你有任何问题，可以：
- 创建Issue询问
- 查看项目文档
- 联系项目维护者

感谢你的贡献！🎉

