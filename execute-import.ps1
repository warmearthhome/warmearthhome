# Execute Product Import
$url = "https://warmearthhome.com/import-products.php?weh_import=1&key=weh_import_2025_secure_key"

Write-Host ""
Write-Host "=== Executing Product Import ===" -ForegroundColor Cyan
Write-Host "URL: $url"
Write-Host ""

try {
    $response = Invoke-WebRequest -Uri $url -UseBasicParsing -TimeoutSec 300
    $content = $response.Content
    
    # Extract key information
    Write-Host "=== Import Results ===" -ForegroundColor Green
    Write-Host ""
    
    # Find success messages
    if ($content -match "导入成功|✓ 导入成功") {
        $matches = [regex]::Matches($content, "(?:✓ 导入成功|导入成功)[^<]*")
        foreach ($match in $matches) {
            Write-Host $match.Value -ForegroundColor Green
        }
    }
    
    # Find summary
    if ($content -match "成功导入[^<]*") {
        $summary = [regex]::Match($content, "成功导入[^<]*").Value
        Write-Host $summary -ForegroundColor Green
    }
    
    if ($content -match "跳过[^<]*") {
        $skipped = [regex]::Match($content, "跳过[^<]*").Value
        Write-Host $skipped -ForegroundColor Yellow
    }
    
    if ($content -match "导入完成") {
        Write-Host ""
        Write-Host "✓ Import completed!" -ForegroundColor Green
    }
    
    # Show full content if needed (truncated)
    Write-Host ""
    Write-Host "=== Full Response (first 2000 chars) ===" -ForegroundColor Cyan
    Write-Host $content.Substring(0, [Math]::Min(2000, $content.Length))
    
} catch {
    Write-Host "Error: $_" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
}

Write-Host ""

