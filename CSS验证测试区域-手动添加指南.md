# CSS验证测试区域 - 手动添加指南

由于通过浏览器工具操作Gutenberg编辑器比较复杂，我为您准备了手动添加的详细步骤。

## 步骤1：在WordPress后台编辑首页

1. 登录WordPress后台（https://warmearthhome.com/wp-admin）
2. 导航到 **页面** > **所有页面**
3. 找到并点击 **Home** 页面进行编辑

## 步骤2：添加Custom HTML区块

1. 在Gutenberg编辑器中，滚动到页面底部（Cover区块之后）
2. 点击空区块，或者点击 **+** 按钮（区块插入器）
3. 在搜索框中输入 **"html"** 或 **"自定义HTML"**
4. 选择 **"Custom HTML"** 或 **"自定义HTML"** 区块

## 步骤3：粘贴测试区域HTML代码

将以下HTML代码粘贴到Custom HTML区块中：

```html
<!-- CSS样式验证测试区域 -->
<section class="weh-css-test-area" style="padding: 40px 20px; background: #F9F9F9; margin: 40px 0;">
  <div style="max-width: 1200px; margin: 0 auto;">
    <h2 style="text-align: center; margin-bottom: 30px; color: #1a1a1a;">CSS样式验证测试区域</h2>
    
    <!-- 按钮测试 -->
    <div style="margin-bottom: 30px;">
      <h3 style="margin-bottom: 15px; color: #666;">按钮样式测试</h3>
      <button class="wp-element-button is-style-primary" style="margin-right: 10px;">主按钮</button>
      <button class="wp-element-button is-style-secondary">次按钮</button>
    </div>
    
    <!-- 信任提示条测试 -->
    <div style="margin-bottom: 30px;">
      <h3 style="margin-bottom: 15px; color: #666;">信任提示条测试</h3>
      <section class="weh-trust-badge" aria-label="Product guarantees">
        <div class="weh-trust-badge-item">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="width: 20px; height: 20px;">
            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
          </svg>
          <span>支持澳规插头 / RCM认证</span>
        </div>
        <div class="weh-trust-badge-item">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="width: 20px; height: 20px;">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
          </svg>
          <span>30天退换 / 适配220-240V</span>
        </div>
      </section>
    </div>
    
    <!-- 参数表格测试 -->
    <div style="margin-bottom: 30px;">
      <h3 style="margin-bottom: 15px; color: #666;">参数表格测试</h3>
      <table class="weh-spec-table">
        <thead>
          <tr>
            <th scope="col">规格项</th>
            <th scope="col">详情</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">尺寸 (Dimensions)</th>
            <td>XX x XX x XX cm</td>
          </tr>
          <tr>
            <th scope="row">材质 (Materials)</th>
            <td>测试材质</td>
          </tr>
          <tr>
            <th scope="row">电压 (Voltage)</th>
            <td>220-240V</td>
          </tr>
          <tr>
            <th scope="row">插头 (Plug)</th>
            <td>AU Plug</td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <!-- 分类卡片测试 -->
    <div style="margin-bottom: 30px;">
      <h3 style="margin-bottom: 15px; color: #666;">分类卡片测试</h3>
      <div class="weh-category-card" style="max-width: 300px; margin: 0 auto;">
        <img src="https://via.placeholder.com/200x200?text=Category" alt="Test category" width="200" height="200" loading="lazy" style="width: 100%; max-width: 200px; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 16px; background: #FFFFFF;">
        <h3>测试分类</h3>
        <p>这是分类卡片的测试内容</p>
      </div>
    </div>
    
    <!-- 服务承诺条测试 -->
    <div style="margin-bottom: 30px;">
      <h3 style="margin-bottom: 15px; color: #666;">服务承诺条测试</h3>
      <nav class="weh-trust-bar" aria-label="Service guarantees">
        <span aria-label="Free shipping over $150">Free Shipping Over $150</span>
        <span aria-label="30 day returns">30-Day Returns</span>
        <span aria-label="RCM certified">RCM Certified</span>
        <span aria-label="AU plug ready">AU Plug Ready</span>
      </nav>
    </div>
  </div>
</section>
```

## 步骤4：保存并发布

1. 点击右上角的 **"保存"** 或 **"更新"** 按钮
2. 点击 **"查看"** 或 **"Preview"** 按钮查看效果

## 步骤5：验证CSS应用

访问 https://warmearthhome.com/ 查看测试区域是否显示，并验证以下内容：

- ✅ 按钮样式是否正确（主按钮应该是棕色背景，次按钮应该是透明背景带边框）
- ✅ 信任提示条是否显示为2列网格布局
- ✅ 参数表格是否有正确的样式（表头灰色背景）
- ✅ 分类卡片是否有悬停效果
- ✅ 服务承诺条是否显示在页面顶部

## 注意事项

1. **清除缓存**：如果看不到更改，请清除LiteSpeed Cache缓存
2. **浏览器缓存**：使用无痕模式或清除浏览器缓存
3. **测试完成后**：验证CSS正常工作后，可以删除这个测试区域

## 如果测试区域显示正常

说明CSS代码已成功应用！您可以：
1. 删除测试区域
2. 开始使用这些CSS类创建实际的UI元素
3. 继续添加产品和其他内容

---

**创建时间**: 2025-11-10  
**用途**: 验证CSS代码是否正确应用到网站


