# Docker: File ownership & local development

This document explains the recommended approach for file permissions when running the app in Docker and locally.

Why this matters
- Bind-mounted project folders (host -> container) may be created with owners that prevent the container's web user (`www-data`) from writing.
- Named volumes can also start empty and get initialized with root-owned files during first-run actions.

What we do in this repo
- The container entrypoint contains an idempotent step that ensures `/var/www/html/storage` and `/var/www/html/bootstrap/cache` are owned by `www-data:www-data` and that directories are `2775` (setgid). This keeps the runtime safe and predictable across environments.

Developer setup (run on host once)

1. Add yourself to the `www-data` group (so you can edit files without sudo):

```bash
sudo usermod -aG www-data $USER
# log out and log back in for group membership to take effect
```

2. Ensure local ownership/permissions:

```bash
sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 2775 storage bootstrap/cache
```

Container / CI fixes

```bash
# from host
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 2775 storage bootstrap/cache
```

Notes and tips
- `chmod 2775` sets the setgid bit so newly created files/directories inherit the `www-data` group.
- The entrypoint performs a cheap `stat` check first to avoid costly `chown -R` on every restart.
- For very strict multi-user environments, prefer ACLs (`setfacl`) for granular control.

If you want, I can add a small health-check script or make the README link to this doc — tell me which you prefer.