# Execute Homepage Setup
$url = "https://warmearthhome.com/setup-homepage.php?weh_setup_homepage=1&key=weh_import_2025_secure_key"

Write-Host ""
Write-Host "=== Executing Homepage Setup ===" -ForegroundColor Cyan
Write-Host "URL: $url"
Write-Host ""

try {
    $response = Invoke-WebRequest -Uri $url -UseBasicParsing -TimeoutSec 30
    $content = $response.Content
    
    Write-Host "=== Setup Results ===" -ForegroundColor Green
    Write-Host ""
    
    # Extract key information
    if ($content -match "✓|成功|设置") {
        $matches = [regex]::Matches($content, "(?:✓|成功|设置)[^<]*")
        foreach ($match in $matches) {
            if ($match.Value.Length -lt 100) {
                Write-Host $match.Value -ForegroundColor Green
            }
        }
    }
    
    # Show summary
    Write-Host ""
    Write-Host "=== Full Response (first 1500 chars) ===" -ForegroundColor Cyan
    Write-Host $content.Substring(0, [Math]::Min(1500, $content.Length))
    
} catch {
    Write-Host "Error: $_" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
}

Write-Host ""

