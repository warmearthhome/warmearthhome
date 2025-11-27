# FTP Upload Script for Homepage Setup
$ftpHost = "ftp.warmearthhome.com"
$ftpUser = "u443357553.wehtemp"
$ftpPass = "Czm@520240"
$localFiles = @("setup-homepage.php", "templates/wordpress/page-homepage.php")

function UploadFile {
    param(
        [string]$localFile,
        [string]$remoteFile
    )
    
    try {
        Write-Host "Uploading: $localFile -> $remoteFile"
        $remotePath = $remoteFile.TrimStart('/')
        $uploadUri = [System.Uri]("ftp://$ftpHost/$remotePath")
        $ftpRequest = [System.Net.FtpWebRequest]::Create($uploadUri)
        $ftpRequest.Credentials = New-Object System.Net.NetworkCredential($ftpUser, $ftpPass)
        $ftpRequest.Method = [System.Net.WebRequestMethods+Ftp]::UploadFile
        $ftpRequest.UseBinary = $true
        $ftpRequest.UsePassive = $true

        if (-not (Test-Path $localFile)) {
            Write-Host "Error: Local file not found: $localFile" -ForegroundColor Red
            return $false
        }

        $fileContent = [System.IO.File]::ReadAllBytes($localFile)
        $ftpRequest.ContentLength = $fileContent.Length

        $requestStream = $ftpRequest.GetRequestStream()
        $requestStream.Write($fileContent, 0, $fileContent.Length)
        $requestStream.Close()

        $response = $ftpRequest.GetResponse()
        Write-Host "✓ Upload successful: $remoteFile" -ForegroundColor Green
        $response.Close()
        return $true
    } catch {
        Write-Host "✗ Upload failed: $remoteFile" -ForegroundColor Red
        Write-Host "  Error: $_" -ForegroundColor Red
        return $false
    }
}

Write-Host ""
Write-Host "=== Uploading Homepage Setup Files ===" -ForegroundColor Cyan
Write-Host ""

$successCount = 0
$failCount = 0

# Upload setup script
if (UploadFile -localFile "setup-homepage.php" -remoteFile "setup-homepage.php") {
    $successCount++
} else {
    $failCount++
}

# Upload template file (need to check theme directory structure)
# For Blocksy child theme: wp-content/themes/blocksy-child/templates/wordpress/
# We'll upload to a known location first
$templateRemotePath = "wp-content/themes/blocksy-child/templates/wordpress/page-homepage.php"
if (UploadFile -localFile "templates/wordpress/page-homepage.php" -remoteFile $templateRemotePath) {
    $successCount++
} else {
    $failCount++
}

Write-Host ""
Write-Host "=== Upload Summary ===" -ForegroundColor Cyan
Write-Host "Success: $successCount" -ForegroundColor Green
Write-Host "Failed: $failCount" -ForegroundColor $(if ($failCount -gt 0) { "Red" } else { "Green" })
Write-Host ""

if ($successCount -gt 0) {
    Write-Host "Next step: Visit https://warmearthhome.com/setup-homepage.php?weh_setup_homepage=1&key=weh_import_2025_secure_key" -ForegroundColor Yellow
}

