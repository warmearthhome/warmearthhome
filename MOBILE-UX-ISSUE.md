#  Mobile UX 重构（Issue #?）

## 问题概述
- 移动端结构混乱：Hero 区占满屏但 CTA 被挤到折叠下方，缺少Shop Now可视入口。
- 信任条 pill 贴顶且横向滚动，遮挡 Logo；缺少 sticky 控制。
- 主体内容（Shop by Space、Best Sellers 等）没有移动栅格，导致巨幅留白/文字过宽。
- Footer 显示 /html、版权段落重复，整体未做移动布局。

## 目标
为移动端单独定义排版断点，确保首屏 CTA、导航和关键信息在 1 屏内清晰呈现，优化触控体验。

## 任务
1. Hero 结构
   - [ ] 将文字与图片垂直堆叠，按钮放在首屏可见区域
   - [ ] 为 CTA 添加 sticky/浮层或至少保持 48px 触控尺寸
   - [ ] Hero 图片裁切为 4:5 或 3:4，避免无意义留白
2. 信任条
   - [ ] 改为单行水平滑动或折叠，避免遮挡 Logo
   - [ ] 增加关闭按钮/隐藏逻辑，限制高度不超过 64px
3. 内容模块
   - [ ] Shop by Space / Best Sellers 调整为 1 列卡片 + 滚动滑块
   - [ ] Inspiration/Testimonial 调整为卡片滑动，限制宽度
4. Footer
   - [ ] 清理 /html 等调试文本
   - [ ] 提供移动版 Link 列表，字体 14px，行高 1.6

## 验收标准
- Lighthouse/Chrome DevTools 移动模拟下，Hero CTA 在首屏可见
- 信任条高度 < 64px，且不遮挡 Logo/菜单
- 所有按钮触控面积  44x44px
- Footer 不再显示 /html，版权与链接排版整齐

/cc @lijie520240  
Assigned: Nick
