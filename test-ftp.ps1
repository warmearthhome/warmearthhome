# Test FTP Connection
$ftpHost = "ftp.warmearthhome.com"
$ftpUser = "u443357553.wehtemp"
$ftpPass = "Czm@520240"

try {
    # Test connection and list directories
    $uri = [System.Uri]("ftp://$ftpHost/")
    $ftpRequest = [System.Net.FtpWebRequest]::Create($uri)
    $ftpRequest.Credentials = New-Object System.Net.NetworkCredential($ftpUser, $ftpPass)
    $ftpRequest.Method = [System.Net.WebRequestMethods+Ftp]::ListDirectory
    $ftpRequest.UsePassive = $true

    $response = $ftpRequest.GetResponse()
    $responseStream = $response.GetResponseStream()
    $reader = New-Object System.IO.StreamReader($responseStream)
    $directoryListing = $reader.ReadToEnd()
    
    Write-Host "Connected successfully!"
    Write-Host "Root directory listing:"
    Write-Host $directoryListing
    
    $reader.Close()
    $response.Close()
} catch {
    Write-Host "Error: $_"
}

