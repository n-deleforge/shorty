![Header](/docs/header.png)

<div align="center">

[![GitHub license](https://img.shields.io/github/license/n-deleforge/shorty?style=for-the-badge)](https://github.com/n-deleforge/shorty/blob/main/LICENSE)
![GitHub last commit](https://img.shields.io/github/last-commit/n-deleforge/shorty?style=for-the-badge)
[![GitHub forks](https://img.shields.io/github/forks/n-deleforge/shorty?style=for-the-badge)](https://github.com/n-deleforge/shorty/network)
[![GitHub stars](https://img.shields.io/github/stars/n-deleforge/shorty?style=for-the-badge)](https://github.com/n-deleforge/shorty/stargazers)
[![Paypal](https://img.shields.io/badge/DONATE-PAYPAL.ME-lightgrey?style=for-the-badge)](https://www.paypal.com/paypalme/nicolasdeleforge)

**This is a only a beta and should not be used for a production environnement.**
</div>

# Features 

- Fast and easy to install on your own server.
- Works with a simple SQLite3 database.
- No additional files or any dependencies.

# Quick start

- Clone the repository.
- Look at the `install.php` file to change some settings if needed, like the admin password or the app language
- Upload it on your server; the installation is automatic (for Apache server only)

## Redirection and security

To make the application working, an **URL rewriting** is absolutely needed. The `data` directory and more precisly the `data.sqlite` file needs to be protected and only accessible by the application.  

For Apache, a `.htaccess` file is automatically generated at the start of the application. I do not use nginx, do not hesitate to share with me the equivalent.

# Changelog

- 0.2.1 : Some rewritings and some fixes. Minification added.
- 0.2 : STILL IN BETA. Shorty is now responsive (may be improved later).
- 0.1 : initial release.
