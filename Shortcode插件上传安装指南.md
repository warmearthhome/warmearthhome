# Shortcode插件上传安装指南

## 文件位置

**ZIP文件路径**：
```
C:\Users\a1314\Desktop\warmearthhome\weh-css-test-shortcode.zip
```

**文件大小**：约 1.66 KB

## 安装步骤

### 方法1：通过WordPress后台上传（推荐）

1. **登录WordPress后台**
   - 访问：`https://warmearthhome.com/wp-admin/`
   - 使用您的管理员账号登录

2. **进入插件上传页面**
   - 点击左侧菜单：**插件** > **添加插件**
   - 或者直接访问：`https://warmearthhome.com/wp-admin/plugin-install.php?tab=upload`
   - 点击页面顶部的 **"上传插件"** 标签

3. **选择ZIP文件**
   - 点击 **"选择文件"** 或 **"插件 Zip 文件"** 按钮
   - 在文件选择对话框中，导航到：
     ```
     C:\Users\a1314\Desktop\warmearthhome\
     ```
   - 选择文件：`weh-css-test-shortcode.zip`
   - 点击 **"打开"**

4. **安装插件**
   - 点击 **"立即安装"** 按钮
   - 等待安装完成（通常几秒钟）

5. **启用插件**
   - 安装完成后，会显示成功消息
   - 点击 **"启用插件"** 按钮
   - 或者进入 **插件** > **已安装插件**，找到 "Warm Earth Home - CSS Test Area Shortcode"，点击 **"启用"**

### 方法2：通过FTP上传（如果方法1失败）

如果WordPress后台上传失败，可以使用FTP：

1. **解压ZIP文件**
   - 解压 `weh-css-test-shortcode.zip`
   - 会得到一个文件夹：`weh-css-test-shortcode`
   - 里面包含：`weh-css-test-shortcode.php`

2. **通过FTP上传**
   - 使用FTP客户端（如FileZilla）连接到您的服务器
   - 导航到：`/wp-content/plugins/`
   - 上传整个 `weh-css-test-shortcode` 文件夹到此目录

3. **在WordPress中启用**
   - 进入 **插件** > **已安装插件**
   - 找到 "Warm Earth Home - CSS Test Area Shortcode"
   - 点击 **"启用"**

## 验证安装

安装并启用后，Shortcode功能应该可以正常使用：

1. **检查插件状态**
   - 进入 **插件** > **已安装插件**
   - 确认 "Warm Earth Home - CSS Test Area Shortcode" 显示为 **"已启用"**

2. **测试Shortcode**
   - 在任何页面或文章中使用：`[weh_css_test]`
   - 应该会显示CSS验证测试区域

## 使用方法

在任何页面、文章或小工具中使用：

```
[weh_css_test]
```

Shortcode会自动输出CSS验证测试区域，包括：
- 按钮样式测试
- 信任提示条测试
- 参数表格测试
- 分类卡片测试
- 服务承诺条测试

## 故障排除

### 问题1：上传失败
- **原因**：文件大小限制或权限问题
- **解决**：使用方法2（FTP上传）

### 问题2：Shortcode不显示
- **原因**：插件未启用或缓存问题
- **解决**：
  1. 确认插件已启用
  2. 清除LiteSpeed Cache
  3. 清除浏览器缓存

### 问题3：显示为纯文本
- **原因**：Shortcode未注册
- **解决**：
  1. 检查插件是否正确安装
  2. 查看 **工具** > **站点健康** 是否有PHP错误
  3. 重新上传插件

## 注意事项

- 插件文件很小（约1.66 KB），上传应该很快
- 如果主题更新，通过functions.php添加的代码可能会丢失，但插件不会受影响
- 建议使用插件方式，而不是直接修改functions.php，因为更安全且易于管理

