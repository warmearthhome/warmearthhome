#  Phase: 填充产品信息与 CSV 批量导入

## 目标
在站点中上架首批 812 个 SKU，覆盖四个子分类（Wall/Pendant/Table/Floor），并完成房间（Shop by Room）与系列（Collections）标签绑定，确保导航各入口均有内容可展示。

## 范围
- WooCommerce 产品基础信息录入（标题/价格/库存/SKU/分类）
- 图片与 Alt 文本配置（主图 + 场景图）
- 标签绑定（Room/Collections）
- 规格属性（Materials/Dimensions/Voltage/Plug/Bulb 等）
- 批量 CSV 导入与字段映射

## 任务清单
- [ ] 准备首批 812 个产品的基础资料（标题、价格、SKU、短描述、长描述）
- [ ] 准备图片（主图 2000px 白底、24 张场景图，Alt 文本）
- [ ] 完成分类绑定：Lighting > Wall/Pendant/Table/Floor
- [ ] 完成标签绑定：Shop by Room（Bedroom/Living Room/Dining- Kitchen/Entryway/Bathroom）
- [ ] 完成系列绑定：Collections（Scandinavian Wood & Linen / Warm Brass & Opal Glass）
- [ ] 设置规格属性（Materials、Dimensions、Voltage=220-240V、Plug=AU、Bulb、Wattage 等）
- [ ] 准备并导入 CSV（见下方模板），完成字段映射
- [ ] 检查 PLP/PDP 显示与导航跳转
- [ ] 首页模块替换占位为真实产品（Best Sellers/Shop by Space 等）

## CSV 模板（最小字段）
`
name,slug,regular_price,sku,stock_status,categories,tags,images,short_description,description,attributes
"Opal Glass Wall Light","opal-glass-wall-light","149","WEH-GL-001","instock","Lighting > Wall Lights","Bedroom|Scandinavian Wood & Linen","https://your-cdn.com/img/opal-wall-1.jpg|https://your-cdn.com/img/opal-wall-2.jpg","Warm ambient wall light with opal glass.","Materials: Brass + Opal Glass. AU plug ready. Easy install.","Materials:Brass+Opal Glass|Voltage:220-240V|Plug:AU Plug|Bulb:E27|Dimensions:W200 x H300 x D120mm"
`

> 导入路径：Products  All Products  Import  上传 CSV  字段映射（attributes  Attributes）

## 验收标准（Acceptance Criteria）
- [ ] 导航各入口（Lighting 四子类、Shop by Space、Collections）均能进入并显示 2 个产品
- [ ] PDP 显示规格表，包含 Voltage、Plug、Bulb、Dimensions 字段
- [ ] 图片加载正常，Alt 文本符合 SEO 规则
- [ ] 分类/标签面包屑与筛选可用
- [ ] 首页模块显示真实产品（不再是占位）

## 附加说明
- 图片大小建议 < 300KB；统一尺寸与比例
- URL Slug 使用英文；Meta Title/Description 可后续补齐

## 关联
- 关联 Issue：#8 视觉与架构（Phase 2/3 的实施依赖真实内容）

/cc @lijie520240  
Assigned: Nick（执行）
