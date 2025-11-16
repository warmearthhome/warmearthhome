# FTP Upload Script for MU Plugin
$ftpHost = "ftp.warmearthhome.com"
$ftpUser = "u443357553.wehtemp"
$ftpPass = "Czm@520240"
$muPluginsDir = "wp-content/mu-plugins"
$localFile = "warmearthhome-mu-plugin.php"
$remoteFile = "$muPluginsDir/$localFile"

function CreateFtpDirectory {
    param([string]$dirPath)
    try {
        $uri = [System.Uri]("ftp://$ftpHost/$dirPath")
        $ftpRequest = [System.Net.FtpWebRequest]::Create($uri)
        $ftpRequest.Credentials = New-Object System.Net.NetworkCredential($ftpUser, $ftpPass)
        $ftpRequest.Method = [System.Net.WebRequestMethods+Ftp]::MakeDirectory
        $ftpRequest.UsePassive = $true
        $response = $ftpRequest.GetResponse()
        Write-Host "Created directory: $dirPath"
        $response.Close()
        return $true
    } catch {
        if ($_.Exception.Response.StatusCode -eq 550) {
            Write-Host "Directory already exists: $dirPath"
            return $true
        } else {
            Write-Host "Error creating directory $dirPath : $_"
            return $false
        }
    }
}

try {
    # Create mu-plugins directory
    Write-Host "Creating mu-plugins directory..."
    CreateFtpDirectory -dirPath $muPluginsDir | Out-Null

    # Upload file
    Write-Host "Uploading file: $localFile to $remoteFile"
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
    Write-Host ""
    Write-Host "=== Upload successful! ===" 
    Write-Host "Status: $($response.StatusDescription)"
    Write-Host "File uploaded to: wp-content/mu-plugins/warmearthhome-mu-plugin.php"
    Write-Host ""
    Write-Host "Next step: Visit https://warmearthhome.com/wp-admin/?weh_setup=1 to initialize"
    $response.Close()
} catch {
    Write-Host "Error: $_"
    Write-Host $_.Exception.Message
    exit 1
}
