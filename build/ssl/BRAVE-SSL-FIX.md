# Fix SSL Certificate Trust for Brave Browser

## Why Brave Doesn't Work But Chrome Does

Brave browser, while based on Chromium, has stricter security settings and may not automatically trust certificates installed in the **CurrentUser** certificate store. Chrome might work because:

1. **Different Certificate Store**: Chrome may check both CurrentUser and LocalMachine stores, while Brave might only check LocalMachine
2. **Stricter Security**: Brave has additional security checks that block localhost certificates by default
3. **Certificate Caching**: Brave might cache certificate validation differently

## Solution Options

### Option 1: Install Root CA to LocalMachine Store (Recommended)

This requires Administrator privileges but works for all browsers:

1. **Right-click PowerShell** → **Run as Administrator**
2. Run this command:
   ```powershell
   $certPath = "$env:LOCALAPPDATA\mkcert\rootCA.pem"
   Import-Certificate -FilePath $certPath -CertStoreLocation Cert:\LocalMachine\Root
   ```
3. **Restart Brave browser**

### Option 2: Enable Brave Insecure Localhost Flag (Easiest)

This is the quickest solution for development:

1. Open **Brave browser**
2. Navigate to: `brave://flags/#allow-insecure-localhost`
3. Set the flag to **"Enabled"**
4. Click **"Relaunch"** to restart Brave
5. Navigate to `https://localhost/` - should work now!

### Option 3: Manually Import Certificate in Brave

1. Open **Brave browser**
2. Navigate to: `brave://settings/security`
3. Scroll down to **"Manage certificates"**
4. Click the **"Authorities"** tab
5. Click **"Import"**
6. Navigate to: `C:\Users\[YourUsername]\AppData\Local\mkcert\rootCA.pem`
7. Check **"Trust this certificate for identifying websites"**
8. Click **"OK"**
9. Restart Brave browser

### Option 4: Use the Helper Script

Run the helper script (as Administrator for best results):

```powershell
# Right-click PowerShell → Run as Administrator
cd C:\laragon\www\Laragon-Dashboard
powershell -ExecutionPolicy Bypass -File .\fix-brave-ssl.ps1
```

## Quick Fix Script

I've created `fix-brave-ssl.ps1` that will:
- Check if mkcert root CA exists
- Attempt to install to LocalMachine store (if running as Admin)
- Provide step-by-step instructions for all options

## Verify It's Working

After applying one of the solutions:

1. **Restart Brave completely** (close all windows)
2. **Clear browser cache**: `Ctrl+Shift+Delete` → Clear cached images and files
3. Navigate to: `https://localhost/`
4. You should see a **🔒 secure connection** with **no warnings**

## Why This Happens

- **Chrome**: More lenient with localhost certificates, checks multiple certificate stores
- **Brave**: Stricter security by default, may only check LocalMachine store or require explicit trust
- **mkcert default**: Installs to CurrentUser store, which Chrome accepts but Brave may not

## Recommendation

For the best compatibility across all browsers:
1. **Install root CA to LocalMachine store** (Option 1) - requires Admin but works everywhere
2. **OR enable the Brave flag** (Option 2) - quickest for development

Both solutions are safe for local development!

