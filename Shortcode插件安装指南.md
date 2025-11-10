# CSS测试区域Shortcode插件安装指南

## 问题说明

Custom HTML区块无法保存大量HTML内容，因此使用Shortcode方式来解决。

## 安装步骤

### 1. 上传插件文件

1. 登录WordPress后台
2. 进入 **插件 > 添加插件**
3. 点击 **上传插件**
4. 选择文件 `weh-css-test-shortcode.php`
5. 点击 **立即安装**
6. 安装完成后，点击 **启用插件**

### 2. 验证安装

1. 进入 **首页编辑页面** (`/wp-admin/post.php?post=15&action=edit`)
2. 找到Custom HTML区块
3. 确认内容为：`[weh_css_test]`
4. 点击 **保存** 按钮

### 3. 清除缓存

1. 进入 **LiteSpeed Cache > 仪表盘**
2. 点击 **清除全部缓存** 按钮
3. 或者点击顶部工具栏的 **LiteSpeed缓存清除全部** 图标

### 4. 验证测试区域

1. 访问首页：`https://warmearthhome.com/`
2. 向下滚动，应该能看到"CSS样式验证测试区域"
3. 检查以下元素是否正确显示：
   - ✅ 按钮样式（主按钮、次按钮）
   - ✅ 信任提示条
   - ✅ 参数表格
   - ✅ 分类卡片
   - ✅ 服务承诺条

## 使用方法

在任何页面或文章中，使用以下Shortcode：

```
[weh_css_test]
```

## 文件位置

插件文件：`weh-css-test-shortcode.php`

需要上传到：`/wp-content/plugins/weh-css-test-shortcode/weh-css-test-shortcode.php`

## 注意事项

- 确保插件已激活
- 清除缓存后测试区域才会显示
- 如果测试区域不显示，检查插件是否已激活

## 故障排除

### 测试区域不显示

1. 检查插件是否已激活
   - 进入 **插件 > 已安装插件**
   - 确认"Warm Earth Home - CSS Test Area Shortcode"已激活

2. 检查Shortcode是否正确
   - 进入首页编辑页面
   - 确认Custom HTML区块内容为：`[weh_css_test]`

3. 清除缓存
   - 清除LiteSpeed Cache
   - 清除浏览器缓存

4. 检查PHP错误
   - 进入 **工具 > 站点健康**
   - 查看是否有错误信息

---

**创建时间**: 2025-11-10  
**插件版本**: 1.0.0

