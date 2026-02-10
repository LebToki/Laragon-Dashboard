# Laragon Dashboard Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [v3.1.7] - 2025-02-10

### Added
- **Auto-Update Notifications**: Dashboard now automatically checks for updates 3 seconds after page load (if preference enabled)
- **Check for Updates Button**: New manual "Check for Updates" button added to dashboard header
 Charts- **Animated**: Server vitals page features animated ApexCharts with real-time updates
- **Mini Sparkline Charts**: KPI cards now show mini charts for CPU, Memory, and Disk usage

### Changed
- **Simplified PHP Version Display**: PHP card now shows only the running version to avoid truncation
- **Improved Project Card Spacing**: Platform names now have proper padding from the 3-dots menu

### Fixed
- **Project Platform Alignment**: Fixed spacing issue where platform name was overlapping with 3-dots menu

### Technical
- **Auto-Update Mechanism**: Verified and documented the update mechanism for users
- **Version Detection**: Improved version detection for update checks

---

## [v3.1.6] - 2025-02-09

### Added
- Enhanced animated UI with real-time server monitoring charts
- ApexCharts integration for CPU, Memory, Disk, Network, and Service visualizations
- Real-time data updates every 5 seconds

### Technical
- Verified auto-update mechanism works reliably for users
- Improved update notification system

---

## [v3.1.5] - 2024-12

### Enhanced Auto-Update System
- Comprehensive improvements to the auto-update mechanism
- Better version detection using Git integration
- Enhanced error handling and logging
- Improved backup and restore functionality

---

## [v3.1.4] - 2024-11

### Improvements
- Initial auto-update system implementation
- Basic update checking from GitHub releases

---

## [v3.0.0] - 2024-early

### Major Release
- Complete dashboard redesign
- Bootstrap 5 integration
- Modern UI with themes (light/dark/monochrome)
- Multi-language support (8 languages)
- Full Laragon management features

---

## [Previous Versions]

For earlier versions, please refer to the [GitHub releases page](https://github.com/LebToki/Laragon-Dashboard/releases).

---

## Contributing

Contributions are welcome! Please read our [contributing guidelines](devfiles/CONTRIBUTING.md) before submitting PRs.

---

## Support

- **GitHub Issues**: [Report Issues](https://github.com/LebToki/Laragon-Dashboard/issues)
- **Documentation**: See [README.md](README.md)
- **Company**: [2TInteractive](https://2tinteractive.com)

---

**Made with ❤️ by [2TInteractive](https://2tinteractive.com)**
