# WooCommerce 产品导入指南（CSV）

文件：`products-sample.csv`

## 导入步骤
1. WordPress 后台 → WooCommerce → Products → All Products → Import
2. 选择 `products-sample.csv`
3. 勾选 “Update existing products” 仅在你要覆盖时使用
4. 字段映射确认 → Run the importer

## 字段说明（建议映射）
- name → Product Name
- slug → URL
- regular_price → Regular price
- sku → SKU
- stock_status → Stock status (instock/outofstock)
- categories → Categories（支持层级 "Lighting > Wall Lights"）
- tags → Tags（用 `|` 分隔，例如 `Bedroom|Living Room`）
- images → Images（多图用 `|` 分隔）
- short_description → Short description
- description → Description
- attributes → Attributes（格式：`Name|visible|global|value`，多属性以 `||` 分隔）

### attributes 字段示例
```
Materials|1|0|Brass; Opal Glass || Dimensions|1|0|W200 x H300 x D120 mm || Voltage|1|0|220-240V || Bulb|1|0|E27
```
- visible: 1 显示，0 不显示
- global: 1 使用全局属性taxonomy，0 使用自定义属性

## 分类与标签基线
- 分类：Lighting 下有 Wall Lights / Pendant Lights / Table Lamps / Floor Lamps
- 房间标签（Shop by Room）：Bedroom / Living Room / Dining / Kitchen / Entryway / Bathroom
- 系列标签（Collections）：Scandinavian Wood & Linen / Warm Brass & Opal Glass

## 导入后检查
- 分类页是否出现新产品（各类至少2件）
- Shop by Space（房间标签）是否可点击并显示产品
- Collections 是否可点击并显示产品
- PDP 规格区是否展示 Materials/Dimensions/Voltage/Bulb

## 替换占位图片
- 现为 `https://via.placeholder.com/2000x2000.jpg`
- 上线前替换为你实际上传的媒体库URL
