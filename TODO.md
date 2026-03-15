# Secure File Storage System TODO

## Status: Active

1. [x] Complete composer create-project (done)
2. [x] Generate app key (done)
3. Configure .env for MySQL DB
4. Create MySQL database 'secure_file_storage'
5. [x] Install Laravel Breeze: `php artisan breeze:install blade`
6. [x] `npm install && npm run build`
7. [x] `php artisan make:model File -m`
8. [x] Edit File migration for fields
9. [x] `php artisan migrate`
10. [x] `php artisan make:controller FileController`
11. [x] Implement FileController methods with hybrid AES+RSA crypto
12. [x] Edit routes/web.php for protected routes
13. Create Blade views: dashboard, upload, files list with Tailwind UI
14. Add JS for drag-drop upload, progress, toasts
15. `php artisan storage:link`
16. Test upload/download/decrypt
17. Polish UI: sidebar, search, file icons, responsive
18. [ ] Deploy/test on XAMPP
