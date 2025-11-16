# Check Initialization Status
Write-Host "=== Warm Earth Home 初始化状态检查 ===" -ForegroundColor Cyan
Write-Host ""

# Check if initialization has been run
Write-Host "初始化脚本已在服务器上。" -ForegroundColor Green
Write-Host ""
Write-Host "请在 WordPress 后台访问以下链接以触发初始化：" -ForegroundColor Yellow
Write-Host "https://warmearthhome.com/wp-admin/?weh_setup=1" -ForegroundColor White
Write-Host ""
Write-Host "或者检查以下项目以确认初始化是否成功：" -ForegroundColor Yellow
Write-Host "1. 产品 > 分类：查看是否有 Lighting 分类" -ForegroundColor White
Write-Host "2. 产品 > 标签：查看是否有房间和系列标签" -ForegroundColor White
Write-Host "3. 页面：查看是否有 About Us、Shipping & Returns、Contact 页面" -ForegroundColor White
Write-Host "4. 外观 > 菜单：查看是否有 Main Navigation 菜单" -ForegroundColor White
Write-Host "5. 设置 > 阅读：查看首页是否设置为静态页面" -ForegroundColor White

