# WordPress 网站结构搭建指南

## 步骤 1: 创建产品分类

### 在 WordPress 后台操作：

1. 进入 **产品 > 分类**
2. 创建以下分类：

#### Lighting（主分类）
- **名称**: Lighting
- **别名**: lighting
- **父分类**: 无

#### Wall Lights（子分类）
- **名称**: Wall Lights
- **别名**: wall-lights
- **父分类**: Lighting

#### Pendant Lights（子分类）
- **名称**: Pendant Lights
- **别名**: pendant-lights
- **父分类**: Lighting

#### Table Lamps（子分类）
- **名称**: Table Lamps
- **别名**: table-lamps
- **父分类**: Lighting

#### Floor Lamps（子分类）
- **名称**: Floor Lamps
- **别名**: floor-lamps
- **父分类**: Lighting

## 步骤 2: 创建产品标签（用于房间分类）

### 在 WordPress 后台操作：

1. 进入 **产品 > 标签**
2. 创建以下标签：

- Bedroom
- Living Room
- Dining / Kitchen
- Entryway

## 步骤 3: 创建产品系列标签

### 在 WordPress 后台操作：

1. 继续在 **产品 > 标签** 中添加：
- Scandinavian Wood & Linen
- Warm Brass & Opal Glass

## 步骤 4: 创建 Support 页面

### 在 WordPress 后台操作：

1. 进入 **页面 > 新建页面**

#### About Us 页面
- **标题**: About Us
- **别名**: about-us
- **内容**: （待补充品牌故事）

#### Shipping & Returns 页面
- **标题**: Shipping & Returns
- **别名**: shipping-returns
- **内容**: （待补充配送和退换政策）

#### Contact 页面
- **标题**: Contact
- **别名**: contact
- **内容**: （待补充联系表单）

## 步骤 5: 设置导航菜单

### 在 WordPress 后台操作：

1. 进入 **外观 > 菜单**
2. 创建新菜单或编辑现有菜单
3. 添加以下结构：

```
Lighting (父菜单)
  ├─ Wall Lights
  ├─ Pendant Lights
  ├─ Table Lamps
  └─ Floor Lamps

Shop by Room (父菜单)
  ├─ Bedroom
  ├─ Living Room
  ├─ Dining / Kitchen
  └─ Entryway

Collections (父菜单)
  ├─ Scandinavian Wood & Linen
  └─ Warm Brass & Opal Glass

Support (父菜单)
  ├─ About Us
  ├─ Shipping & Returns
  └─ Contact
```

## 步骤 6: 设置产品详情页模板

### 使用 WooCommerce 设置：

1. 进入 **WooCommerce > 设置 > 产品**
2. 确保启用产品详情页的完整布局

### 使用 Blocksy 主题自定义：

1. 进入 **外观 > 自定义**
2. 找到 **WooCommerce > 单个产品**
3. 配置产品页面布局

### 需要添加的元素：

1. **产品图片区域**（支持多图）
2. **产品信息区域**（标题、价格、描述、购买按钮）
3. **提示语区块**（购买按钮附近）
4. **参数表格**（使用自定义字段或插件）
5. **详细描述**
6. **推荐产品区块**

## 步骤 7: 设置商店状态

### 在 WooCommerce 设置：

1. 进入 **WooCommerce > 设置 > 常规**
2. 找到 **商店状态**
3. 将 "商店即将推出" 改为 "正常运营"

## 步骤 8: 搭建首页结构

### 使用 WordPress 区块编辑器：

1. 进入 **页面 > 所有页面 > 编辑首页**
2. 使用 Blocksy 的区块或 Gutenberg 区块搭建：

#### 区块结构：
1. **Cover Block**（Hero 区域）
   - 背景图片
   - 标题：WARM EARTH HOME
   - 副标题：Soft Light · Honest Materials · Calm Living
   - CTA 按钮

2. **Columns Block**（分类入口 - 6宫格）
   - 6列布局
   - 每个分类一个卡片

3. **Columns Block**（按房间选购 - 4宫格）
   - 4列布局
   - 每个房间一个卡片

4. **Products Block**（热销区）
   - 暂时留空或显示占位符

5. **Group Block**（品牌理念区）
   - 品牌故事内容

6. **Footer**（页脚）
   - 版权信息
   - 快速链接

## 注意事项

- 所有分类和标签的别名使用小写字母和连字符
- 确保菜单结构正确嵌套
- 产品详情页模板需要测试多个产品以确保一致性
- 首页区块可以先搭建框架，内容后续补充







