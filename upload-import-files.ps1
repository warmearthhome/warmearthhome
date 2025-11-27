# FTP Upload Script for Product Import Files
$ftpHost = "ftp.warmearthhome.com"
$ftpUser = "u443357553.wehtemp"
$ftpPass = "Czm@520240"
$localFiles = @("import-products.php", "woo-products-sample.csv")

function UploadFile {
    param(
        [string]$localFile,
        [string]$remoteFile
    )
    
    try {
        Write-Host "Uploading: $localFile -> $remoteFile"
        # Remove leading slash for FTP URI
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
        Write-Host "  Status: $($response.StatusDescription)"
        $response.Close()
        return $true
    } catch {
        Write-Host "✗ Upload failed: $remoteFile" -ForegroundColor Red
        Write-Host "  Error: $_" -ForegroundColor Red
        return $false
    }
}

Write-Host ""
Write-Host "=== Warm Earth Home - Product Import Files Upload ===" -ForegroundColor Cyan
Write-Host ""

$successCount = 0
$failCount = 0

foreach ($localFile in $localFiles) {
    $remoteFile = $localFile
    if (UploadFile -localFile $localFile -remoteFile $remoteFile) {
        $successCount++
    } else {
        $failCount++
    }
    Write-Host ""
}

Write-Host "=== Upload Summary ===" -ForegroundColor Cyan
Write-Host "Success: $successCount" -ForegroundColor Green
Write-Host "Failed: $failCount" -ForegroundColor $(if ($failCount -gt 0) { "Red" } else { "Green" })
Write-Host ""

if ($successCount -eq $localFiles.Count) {
    Write-Host "✓ All files uploaded successfully!" -ForegroundColor Green
    Write-Host ""
    Write-Host "Next steps:" -ForegroundColor Yellow
    Write-Host "1. Make sure you are logged in to WordPress admin"
    Write-Host "2. Visit: https://warmearthhome.com/import-products.php?weh_import=1"
    Write-Host "3. The script will import 8 sample products"
    Write-Host "4. After import, delete import-products.php for security"
    Write-Host ""
} else {
    Write-Host "✗ Some files failed to upload. Please check the errors above." -ForegroundColor Red
    Write-Host ""
}

