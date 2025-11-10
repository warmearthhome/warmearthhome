# Warm Earth Home – Support Center Blueprint

> 版本：2025-11-10 · Brand定位版  
> 目标：提供清晰、温暖、易于操作的售后与咨询流程，提升客户信任度。

---

## 1️⃣ 页面结构

1. **Hero Area**
   - 标题：`How can we help you light up with ease?`  
   - 副标题：说明客服时间、响应速度（24h内回复）  
   - CTA：`Contact us`（锚点到表单）

2. **Quick Links (Cards)**
   - Shipping & Returns  
   - Installation Guides  
   - FAQ  
   - Contact / Styling Consultation

3. **FAQ Accordion**
   - 分类：
     - Orders & Delivery  
     - Returns & Exchanges  
     - Installation & Care  
     - Product Warranty  
     - Payments & Invoices
   - 每项提供简洁回答 + 跳转链接

4. **Shipping & Returns Summary**
   - Shipping：澳洲境内免邮门槛、处理时间、快递选项  
   - Returns：30 天退换政策，流程步骤（联系客服 → 安排回寄 → 退款/换货）  
   - 重要提醒：灯具需原包装，退货运费说明

5. **Installation Guides**
   - 提供 PDF 下载列表（按系列/灯具类型）  
   - 分 `Hardwired` 与 `Plug-in`  说明安装注意事项  
   - 提供安全提示 & 推荐持证电工

6. **Contact / Styling Help**
   - 表单字段：姓名、邮箱、电话、订单号、问题类别、留言  
   - 提供 `Book a styling call` 链接（Calendly 或邮件预约）

7. **Social & Community**
   - 提示关注 Instagram/Pinterest 获取布置灵感  
   - 引导加入邮件列表获取安装技巧与新品通知

---

## 2️⃣ 文案与语气

- 温柔、专业、鼓励式的语气：
  > “We’re here to make warm lighting effortless. Let us know how we can help.”
- FAQ 回答保持清晰、步骤化，避免专业术语  
- 强调对租房用户的友好（Plug-in 选项、无需破坏墙面）

---

## 3️⃣ 技术与交互

- Accordion 支持一次展开多个问题  
- 表单提交后显示成功提示 + 预计回复时间  
- 下载链接使用 CDN，统计下载量  
- 页底固定客服邮箱 `hello@warmearthhome.com`

---

## 4️⃣ 数据埋点

| 事件 | 说明 | 参数 |
|------|------|------|
| `faq_open` | 展开某个 FAQ | category / question |
| `download_guide` | 下载安装指南 | file_name |
| `contact_submit` | 提交表单 | issue_type |
| `schedule_call` | 点击预约 Styling | source |

---

## 5️⃣ QA 检查

- [ ] FAQ 内容无死链接、语法准确  
- [ ] 所有 PDF 可下载且 checksum 通过  
- [ ] 表单验证（必填、邮箱格式）  
- [ ] 成功/错误提示文案  
- [ ] 事件埋点在 GA4 / Meta 中正确记录  
- [ ] 页脚邮箱及社交链接正常

---

**结论**：Support 页面应快速传达 Warm Earth Home 的服务承诺，提供租房友好、安装简易的支持信息，并引导用户进行深层互动（预约 Styling、订阅邮件）。
