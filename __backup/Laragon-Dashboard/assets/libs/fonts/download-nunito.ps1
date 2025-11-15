# Download Nunito Font Files
$fonts = @(
    @{Name='Nunito-Light.ttf'; Url='https://cdn.jsdelivr.net/gh/google/fonts@main/ofl/nunito/Nunito-Light.ttf'},
    @{Name='Nunito-Regular.ttf'; Url='https://cdn.jsdelivr.net/gh/google/fonts@main/ofl/nunito/Nunito-Regular.ttf'},
    @{Name='Nunito-Medium.ttf'; Url='https://cdn.jsdelivr.net/gh/google/fonts@main/ofl/nunito/Nunito-Medium.ttf'},
    @{Name='Nunito-SemiBold.ttf'; Url='https://cdn.jsdelivr.net/gh/google/fonts@main/ofl/nunito/Nunito-SemiBold.ttf'},
    @{Name='Nunito-Bold.ttf'; Url='https://cdn.jsdelivr.net/gh/google/fonts@main/ofl/nunito/Nunito-Bold.ttf'},
    @{Name='Nunito-ExtraBold.ttf'; Url='https://cdn.jsdelivr.net/gh/google/fonts@main/ofl/nunito/Nunito-ExtraBold.ttf'}
)

foreach ($font in $fonts) {
    Write-Host "Downloading $($font.Name)..."
    try {
        Invoke-WebRequest -Uri $font.Url -OutFile $font.Name -UseBasicParsing
        Write-Host "Successfully downloaded $($font.Name)"
    } catch {
        Write-Host "Failed to download $($font.Name): $($_.Exception.Message)"
    }
}

Write-Host "Done!"

