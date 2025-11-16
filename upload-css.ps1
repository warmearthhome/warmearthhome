# Upload CSS file to WordPress theme directory
$ftpHost = "ftp.warmearthhome.com"
$ftpUser = "u443357553.wehtemp"
$ftpPass = "Czm@520240"
$localFile = "assets\css\warm-earth-home.css"

# Try multiple possible paths
$possiblePaths = @(
    "wp-content/themes/blocksy/assets/css/warm-earth-home.css",
    "wp-content/themes/blocksy-child/assets/css/warm-earth-home.css",
    "wp-content/uploads/warm-earth-home.css"
)

foreach ($remoteFile in $possiblePaths) {
    Write-Host "Trying to upload to: $remoteFile"
    
    try {
        $uploadUri = [System.Uri]("ftp://$ftpHost/$remoteFile")
        $ftpRequest = [System.Net.FtpWebRequest]::Create($uploadUri)
        $ftpRequest.Credentials = New-Object System.Net.NetworkCredential($ftpUser, $ftpPass)
        $ftpRequest.Method = [System.Net.WebRequestMethods+Ftp]::UploadFile
        $ftpRequest.UseBinary = $true
        $ftpRequest.UsePassive = $true
        
        $fileContent = [System.IO.File]::ReadAllBytes($localFile)
        $ftpRequest.ContentLength = $fileContent.Length
        
        $requestStream = $ftpRequest.GetRequestStream()
        $requestStream.Write($fileContent, 0, $fileContent.Length)
        $requestStream.Close()
        
        $response = $ftpRequest.GetResponse()
        Write-Host "✅ Upload successful: $remoteFile - $($response.StatusDescription)" -ForegroundColor Green
        $response.Close()
        break
    }
    catch {
        Write-Host "❌ Failed: $remoteFile - $($_.Exception.Message)" -ForegroundColor Red
        continue
    }
}

Write-Host "`nIf all uploads failed, you may need to:" -ForegroundColor Yellow
Write-Host "1. Upload via WordPress admin: Appearance > Theme Editor > warm-earth-home.css" -ForegroundColor Yellow
Write-Host "2. Or create the directory structure first via FTP" -ForegroundColor Yellow



