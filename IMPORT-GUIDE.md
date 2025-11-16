# WooCommerce 产品导入指南（Warm Earth Home）

本目录包含两份文件：
- `weh-products-sample.csv`：12 个示例产品（4 类别 × 3 个）
- 本指南：如何导入与验证

## 一、准备
- 管理员登录 WordPress 后台
- 确保 WooCommerce 已启用
- 确保我们已运行网站结构初始化（分类/标签/菜单已就绪）

## 二、导入步骤
1. 后台进入：WooCommerce > Products > All Products > Import
2. 选择文件：上传 `weh-products-sample.csv`
3. 勾选："Update existing products"（第一次不勾选；如果重复导入作为更新可勾选）
4. 下一步时确认字段映射（通常会自动匹配）：
   - name → Name
   - slug → Slug
   - regular_price → Regular price
   - sku → SKU
   - stock_status → Stock status
   - categories → Categories（“Lighting > Wall Lights” 等层级）
   - tags → Tags（使用 | 作为分隔）
   - images → Images（使用 | 作为分隔的图片 URL）
   - short_description → Short description
   - description → Description
   - attribute:* → 相应属性（Materials / Voltage / Plug / Bulb Type / Dimensions）
5. 开始导入，等待完成提示。

## 三、导入后检查
- 产品列表：应出现 12 个示例产品，状态为 Published
- 分类页：
  - Lighting > Wall Lights / Pendant Lights / Table Lamps / Floor Lamps 均可见产品
- 标签页：
  - Shop by Room：Bedroom / Living Room / Dining - Kitchen / Entryway / Bathroom
  - Collections：Scandinavian Wood & Linen / Warm Brass & Opal Glass
- 前台导航：
  - 顶部菜单点击各子分类、房间、系列均能看到产品

## 四、图片与内容替换建议
- 将 `images` 列中的 URL 替换为你上传到媒体库的真实图片 URL（多图用 | 分隔）
- 根据实际材料/尺寸/灯头等更新属性字段
- 将描述替换为品牌口吻与 SEO 友好的内容

## 五、常见问题
- 问：导入后分类没显示层级？
  - 答：确保 `categories` 字段格式为 `Lighting > Wall Lights`（英文，精确匹配）。
- 问：下拉菜单没有显示到新分类？
  - 答：我们的 MU 插件会自动绑定分类到主菜单，如未生效，访问 `wp-admin/?weh_setup=1` 触发一次初始化。
- 问：图片没显示？
  - 答：确认图片 URL 可访问；建议先上传到媒体库后复制 URL。

## 六、下一步（建议）
- 每个分类扩充到 6–8 个产品
- 每个房间标签至少 4 个产品
- 为首页模块选择 6–8 个主推产品替换占位内容
