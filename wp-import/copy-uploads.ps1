<#
    copy-uploads.ps1

    Copies ONLY the legacy media files that the imported blog posts actually reference
    (listed in files.txt), preserving the year/month folder structure.

    Usage — open PowerShell and run:

        cd C:\xampp\htdocs\website\wp-import
        .\copy-uploads.ps1 -Source "PATH\TO\OLD\wp-content\uploads"

    e.g. -Source "D:\backups\bluerabbit\b\wp-content\uploads"

    Anything it can't find is written to missing.txt so you know exactly what's absent.
#>
param(
    [Parameter(Mandatory = $true)]
    [string]$Source,

    [string]$Dest = "C:\xampp\htdocs\website\public\assets\uploads",

    [string]$List = "C:\xampp\htdocs\website\wp-import\files.txt"
)

if (-not (Test-Path -LiteralPath $Source)) {
    Write-Error "Source folder not found: $Source"
    exit 1
}
if (-not (Test-Path -LiteralPath $List)) {
    Write-Error "File list not found: $List"
    exit 1
}

$files   = Get-Content -LiteralPath $List | Where-Object { $_.Trim() -ne '' }
$copied  = 0
$missing = New-Object System.Collections.Generic.List[string]

foreach ($rel in $files) {
    $relWin = $rel -replace '/', '\'
    $src    = Join-Path $Source $relWin
    $dst    = Join-Path $Dest   $relWin

    if (Test-Path -LiteralPath $src) {
        $dir = Split-Path -Parent $dst
        if (-not (Test-Path -LiteralPath $dir)) {
            New-Item -ItemType Directory -Path $dir -Force | Out-Null
        }
        Copy-Item -LiteralPath $src -Destination $dst -Force
        $copied++
    }
    else {
        $missing.Add($rel) | Out-Null
    }
}

Write-Host ""
Write-Host "Copied  : $copied of $($files.Count)" -ForegroundColor Green

if ($missing.Count -gt 0) {
    $missingPath = Join-Path (Split-Path -Parent $List) 'missing.txt'
    $missing | Set-Content -LiteralPath $missingPath
    Write-Host "Missing : $($missing.Count)  ->  $missingPath" -ForegroundColor Yellow
}
else {
    Write-Host "Missing : 0  - every referenced file was found." -ForegroundColor Green
}

Write-Host "Dest    : $Dest"
Write-Host ""
