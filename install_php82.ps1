# Install PHP 8.2 for Windows
Write-Host "Downloading PHP 8.2..." -ForegroundColor Green

# Create directory for PHP
$phpDir = "C:\php82"
if (!(Test-Path $phpDir)) {
    New-Item -ItemType Directory -Path $phpDir -Force
}

# URL for PHP 8.2 download (Thread Safe x64)
$phpUrl = "https://windows.php.net/downloads/releases/php-8.2.29-Win32-vs16-x64.zip"
$zipPath = "$env:TEMP\php82.zip"

try {
    # Download PHP
    Write-Host "Downloading from: $phpUrl" -ForegroundColor Yellow
    Invoke-WebRequest -Uri $phpUrl -OutFile $zipPath -UseBasicParsing
    
    # Extract files
    Write-Host "Extracting files..." -ForegroundColor Yellow
    Expand-Archive -Path $zipPath -DestinationPath $phpDir -Force
    
    # Copy php.ini
    $phpIniSource = "$phpDir\php.ini-development"
    $phpIniTarget = "$phpDir\php.ini"
    if (Test-Path $phpIniSource) {
        Copy-Item $phpIniSource $phpIniTarget -Force
        Write-Host "Created php.ini file" -ForegroundColor Green
    }
    
    # Update PATH (User level)
    Write-Host "Updating PATH..." -ForegroundColor Yellow
    $currentPath = [Environment]::GetEnvironmentVariable("PATH", "User")
    if ($currentPath -notlike "*$phpDir*") {
        $newPath = "$phpDir;$currentPath"
        [Environment]::SetEnvironmentVariable("PATH", $newPath, "User")
        Write-Host "Updated PATH successfully" -ForegroundColor Green
    }
    
    # Remove zip file
    Remove-Item $zipPath -Force
    
    Write-Host "PHP 8.2 installation completed!" -ForegroundColor Green
    Write-Host "Please open a new Command Prompt and run 'php -v' to verify" -ForegroundColor Cyan
    
} catch {
    Write-Host "Error occurred: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "Please download and install manually from: https://windows.php.net/download/" -ForegroundColor Yellow
}
