# 团队协作手册

> 版本：2025-11-10

## 1. 团队概览

| 成员 | GitHub 身份 | 角色定位 | 主要职责 |
| --- | --- | --- | --- |
| lijie | @lijie520240 | 产品负责人 / 运营 | 需求规划、上线决策、部署执行、运营落地 |
| 尼克（Nick） | GitHub @warmearthhome/core | 技术负责人 | 技术方案、代码实现、流程维护、质量把控 |
| 吉米（Jimmy, GPT） | ChatGPT 协作者 | 设计与内容顾问 | 文案、UI/UX 建议、SEO/营销素材、代码草稿支持 |

> 说明：仓库托管在 GitHub 组织 **warmearthhome**，核心团队为 `@warmearthhome/core`。所有代码提交与发布动作均需由 lijie 最终确认。

## 2. 协作流程总览

1. **需求/问题收集**
   - 在仓库创建 Issue（使用模版）
   - Issue 自动进入网站建设 Roadmap 看板的 `Todo`
2. **方案确认**
   - 在 Issue 评论区同步方案与验收标准
   - 必要时在 Docs 中补充设计/调研
3. **开发实现**
   - 从 `main` 创建分支：`feature/<描述>` 或 `fix/<描述>`
   - 在 Cursor 内由尼克/吉米协助编码，lijie 本地验证
4. **自测与提交**
   - 自测通过后提交，保持语义化提交信息（例：`feat: 添加导航菜单`）
   - 推送到远程并创建 PR，关联 Issue（`Closes #编号`）
5. **审查与合并**
   - 使用 PR 模板完成自检清单
   - GitHub 分支保护要求通过 PR 合并（允许自审自合并）
6. **上线与回顾**
   - 线下部署到 WordPress（Staging → Production）
   - 在 `CHANGELOG.md` 记录变更
   - 将 Issue 移到 Done（自动化已启用）

## 3. Git 工作流细则

- **分支命名**
  - 功能：`feature/<简短描述>`
  - 修复：`fix/<问题描述>`
  - 快速修复可使用 `hotfix/`
- **提交信息格式**（建议遵循 Conventional Commits）
  - `feat:` 新功能
  - `fix:` Bug 修复
  - `docs:` 文档变更
  - `style:` 格式调整（无逻辑变更）
  - `refactor:` 重构
  - `chore:` 构建/脚本/工具
- **PR 要求**
  - 说明变更背景、测试情况、截图等
  - 引用相关 Issue：`Closes #12`
  - 若涉及 WordPress 配置，附上线操作步骤

## 4. Issue 与看板管理

- 使用 GitHub Templates 创建 Issue（Bug / Feature）
- 自动化规则
  - 新建 Issue → 自动加入 [网站建设 Roadmap 看板](https://github.com/orgs/warmearthhome/projects/1) `Todo`
  - Issue/PR 关闭 → 自动移动到 `Done`
- 看板列定义
  - `Todo`：待规划/未开始的任务
  - `In Progress`：正在开发或验证
  - `Done`：已完成并上线
- 建议为每个 Issue 指定负责人（默认 lijie），在评论记录决策与验收结果

## 5. 质量与测试规范

- **代码检查**
  - 保持文件编码 UTF-8，避免中文提交信息乱码
  - 提交前运行相关格式化（CSS/HTML）
- **功能测试**
  - 后台（WordPress）操作截图或说明
  - 前台页面（桌面 + 移动）截图或验证说明
  - 若改动涉及性能/SEO，记录 Lighthouse 或第三方检测结果
- **发布流程**
  1. 在 Staging 环境验证
  2. 备份线上站点（主题、数据库）
  3. 同步到 Production 并确认
  4. 更新 `CHANGELOG.md` 与项目看板

## 6. 文档与知识沉淀

- 关键文档路径
  - `docs/collaboration-playbook.md`：协作守则（本文件）
  - `CHANGELOG.md`：上线与版本变更记录
  - `wordpress-setup-guide.md`：环境与安装说明
  - `问题诊断和解决方案.md`：常见故障及处理
- 建议在 Docs 中记录：设计稿、SEO 方案、运营计划、第三方集成配置等
- 大型需求可以建立子目录 `docs/<topic>/` 存放详细资料

## 7. 常用命令备忘

```bash
# 从主分支拉取最新代码
git checkout main
git pull

# 创建功能分支
git checkout -b feature/<name>

# 推送并建立上游
git push -u origin feature/<name>

# 强制更新远程（谨慎使用，仅当需重写提交历史）
git push -f origin feature/<name>
```

> 如需在多台电脑协作，记得更新 Git 远程地址：`git remote set-url origin https://github.com/warmearthhome/warmearthhome.git`

## 8. 支持渠道

- GitHub Discussions：暂未启用，可按需开启
- 内部沟通：推荐在 Issue / PR 评论区记录决策
- 紧急问题：lijie 通过站点后台或服务器直接处理，并在仓库补充记录

---

如流程有变动，更新本手册并在 `CHANGELOG.md` 中记录，以便团队保持同步。
