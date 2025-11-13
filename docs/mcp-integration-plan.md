# MCP 服务接入方案（Warm Earth Home）

> 版本：2025-11-13  
> 适用对象：Warm Earth Home 运营团队（lijie、Nick、Jimmy）  
> 参考项目：`modelcontextprotocol/servers`（66k★，提供 1000+ MCP 服务连接器）

---

## 1. 背景与目标

- **运营现状**：网站面向澳大利亚客户，核心渠道包括 WooCommerce、Gmail、Instagram/Pinterest 内容、GA4 数据以及 Stripe/PayPal 支付。团队规模小，需降低重复性运营工作成本。
- **接入目标**：
  1. 将关键数据源统一接入 MCP 生态，为 AI 助手提供上下文（邮件、订单、分析指标、代码变更）。
  2. 建立“数据采集 → 筛选分析 → 任务执行/文案输出”的自动化闭环。
  3. 保证数据安全合规（遵循澳洲隐私法 Privacy Act 1988），并可逐步扩展。

---

## 2. 团队角色与分工

| 角色 | 职责 | MCP 相关任务 |
| --- | --- | --- |
| lijie（产品/运营） | 需求定义、上线决策、运营执行 | 提供业务需求、测试自动化结果、审批权限 |
| Nick（技术负责人） | 技术实现、部署、权限管理 | 部署 MCP 服务、维护凭证、编写脚本 |
| Jimmy（AI 协作者） | 文案、分析、自动化建议 | 使用 MCP 数据生成报告/文案，协助制定自动化方案 |

---

## 3. 数据源优先级与接入方式

| 优先级 | 数据源 / 服务 | 主要用途 | MCP 连接方式 | 备注 |
| --- | --- | --- | --- | --- |
| P0 | Gmail（运营邮箱） | 客户咨询、订单通知、邮件营销表现 | `gmail` 服务器（OAuth） | 需创建 OAuth Client，限制只读范围 |
| P0 | Google Analytics 4 | 站点流量、转化指标 | `google-analytics` 服务器（服务账号） | 生成服务账号 JSON，配置只读权限 |
| P0 | GitHub（仓库 `warmearthhome/warmearthhome`） | Issue、PR、部署记录 | `github` 服务器（PAT） | PAT 需最小权限：`repo:read`, `project:read` |
| P1 | WooCommerce 数据（MySQL 或 REST API） | 订单、库存、客户档案 | `mysql` / `woocommerce`（若有） | 建议创建只读数据库用户 |
| P1 | Stripe / PayPal | 支付数据、退款监控 | `stripe` 服务器 / 自建连接器 | 限制 API 密钥权限为只读 |
| P1 | Google Drive（运营文档） | 设计文档、方案、报告存档 | `google-drive` 服务器 | 只读访问 Docs/Sheets |
| P2 | Slack / Microsoft Teams | 团队通知、任务提醒 | 对应 `slack` 服务器 | 仅接收通知，不写入敏感信息 |
| P2 | Meta Marketing API / Pinterest API | 广告投放与图板数据 | 需确认 `modelcontextprotocol/servers` 是否已有连接器 | 如无，可后续自建 MCP 服务 |
| P2 | YouTube Data API | 教学视频表现 | `youtube` 服务器（如有） | 只读数据即可 |

---

## 4. 核心自动化场景设计

### 4.1 每周运营复盘
- **触发**：每周一 9:00 AEST
- **数据**：GA4（流量/转化）、Stripe（销售额/退款）、Gmail（客户投诉标签）、GitHub PR 变更摘要
- **输出**：Markdown 周报（核心指标、问题列表、改进建议），自动推送至 GitHub Issue 或 Slack

### 4.2 内容营销工作流
- **触发**：运营日历（Week1/Week3/Week4）或手动
- **数据**：Gmail 常见问题、Pinterest 趋势关键词、GA4 热门搜索词
- **输出**：文章大纲、SEO 关键词表、社交媒体文案草稿，存入 Google Drive 并在 PR 中引用

### 4.3 邮件自动化优化
- **触发**：邮件营销活动结束后
- **数据**：Gmail 营销邮箱、邮件工具导出的 CSV（可同步到 Drive）
- **输出**：打开率/点击率对比、主题行 A/B 测试建议、后续推送节奏

### 4.4 客户服务知识库更新
- **触发**：每日汇总
- **数据**：Gmail/Contact Form 导出、WooCommerce 订单备注
- **输出**：FAQ 更新列表（按话题聚合），生成 PR 草稿（`docs/design/support.md` 或 WooCommerce 导航提示）

### 4.5 技术变更影响评估
- **触发**：合并 PR 时
- **数据**：GitHub PR diff、GA4 站内事件
- **输出**：变更检查清单（SEO、性能、Schema、追踪代码），提醒运营测试重点

---

## 5. 实施路线图

### Phase 0：准备与治理（Week 0）
1. **部署方式确认**：可直接使用 `modelcontextprotocol/servers` 提供的现成实例，或在 VPS 上自托管（推荐 Docker 部署，便于权限控制）。
2. **凭证管理**：创建 `.mcp/credentials`（或使用 Vault/1Password），规范命名与过期检查。
3. **访问控制**：设置团队成员权限，Jimmy 仅以“外部审阅”角色访问汇总数据，不直接接触原始凭证。

### Phase 1：MVP（Week 1-2）
1. 接入 Gmail、GA4、GitHub 三个数据源。
2. 在 Cursor / IDE 中配置 MCP 客户端，使 Jimmy 可以读取周报所需数据。
3. 编写两个最小化自动化脚本：
   - `reports/weekly-ops.mcp`：生成运营周报
   - `content/idea-collector.mcp`：提取客户问题 → 内容题库
4. 与 lijie 共同验收，确认输出格式满足需求。

### Phase 2：扩展（Week 3-4）
1. 接入 WooCommerce（只读 DB 或 REST API）与 Stripe。
2. 增加运营看板同步（自动在 GitHub Issue 中更新 KPI）。
3. 构建“邮件营销复盘”与“客户服务知识库更新”自动化流程。

### Phase 3：深化（Week 5+）
1. 接入 Pinterest/Instagram/YouTube 数据源，完善社交媒体监控。
2. 引入 Slack 通知渠道（推送异常告警、日程提醒）。
3. 开发前端可视化（如将 MCP 输出同步到 Notion/Looker Studio）。
4. 建立季度审计机制：复查权限、凭证、日志留存。

---

## 6. 安全与合规要求

- **最小权限原则**：每个数据源创建独立只读凭证，定期轮换。
- **敏感数据隔离**：客户个人信息、订单详情在 MCP 内部仅用于统计；输出报告中需匿名化或聚合。
- **日志审计**：启用 MCP 访问日志；每月查看一次异常访问。
- **合规遵循**：确保所有自动化流程符合 Privacy Act 1988 与澳洲消费者法要求（明确告知用户数据使用场景）。
- **备份策略**：凭证与配置文件备份至加密存储（不限于本地 Git 仓库）。

---

## 7. 运维与监控

- 制定 MCP 版本升级节奏（每季度检查一次 `modelcontextprotocol/servers` 更新）。
- 监控脚本执行状态（失败自动通知 Nick）。
- 定期评估自动化成效（节省时间、减少错误、提升转化）。
- 与 GitHub Actions / Cron 整合，实现周期任务调度。

---

## 8. 下一步行动清单（建议优先顺序）

1. **确认部署模式**：是否自托管 MCP 服务，或使用托管实例。
2. **准备凭证**：申请 Gmail OAuth、创建 GA4 服务账号、生成 GitHub PAT。
3. **编写 MVP 脚本**：完成运营周报与内容题库两个场景。
4. **建立验收标准**：定义每个自动化输出的格式、粒度与审批流程。
5. **定期复盘**：2 周后评估自动化价值，决定是否进入 Phase 2。

---

> 如果需要我继续协助创建自动化脚本模板或配置清单，请在相关 Issue 中 @Nick 或 @Jimmy，我们可以基于本方案细化实现步骤。***

