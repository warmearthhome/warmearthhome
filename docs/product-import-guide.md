# WooCommerce 产品导入指南（首批SKU）

## 1. 文件位置
- CSV：`data/initial-products.csv`
- 建议图片路径（占位）：`https://warmearthhome.com/wp-content/uploads/products/` 下（请按 SKU 命名）

## 2. 导入步骤
1. 登录 WordPress 后台 → WooCommerce → Products → Import
2. 选择文件 `data/initial-products.csv`
3. 勾选「Update existing products」仅在你打算覆盖同 SKU 时
4. 字段映射：
   - name → Name
   - slug → Slug
   - type → Type (simple)
   - regular_price → Regular price
   - sku → SKU
   - stock_status → Stock status
   - categories → Categories（层级用 `>`，多个用`,`）
   - tags → Tags（多个用`,`）
   - images → Images（多图用 `|` 分隔）
   - short_description → Short description
   - description → Description
   - attributes → Attributes（用 `|` 分隔多个，键值用 `:` 或 `;`）
5. 开始导入 → 完成后检查 PLP/PDP

## 3. 建议图片命名与Alt文本
- 命名：`<SKU>-<index>.jpg`，例如 `WEH-GL-001-1.jpg`
- 尺寸：长边 2000px，JPG，≤ 300KB
- Alt 文本模板：`<Product Name> – <Material>/<Color>, <Room> lighting`
  - 例：`Opal Glass Wall Light – Brass/Opal Glass, Bedroom lighting`

## 4. 最小校验清单
- 分类页：4 个 Lighting 子类均可看到产品
- Shop by Room：Bedroom/ Living/ Dining-Kitchen/ Entryway 至少各 2 个产品
- Collections：两个系列各至少 2 个产品
- PDP：规格（Voltage/Plug/Materials/Dimensions）显示正确

## 5. 常见问题
- 分类未出现：检查「产品 > 分类」是否已由初始化脚本创建
- 图片不显示：确认图片URL有效，或先在媒体库上传并替换为站内URL
- 标签未生效：标签使用英文，多个用逗号分隔
