Nội thất thông minh

Install

git clone https://github.com/lequan1102/noithatthongminh.git

config db .env

php artisan migrate:rollback

php artisan migrate

php artisan db:seed 

php artisan migrate:refresh --seed


Tài liệu tham khảo

Tổng hợp về artisan

https://quickadminpanel.com/blog/list-of-16-artisan-make-commands-with-parameters/

Artisan của modular

https://nwidart.com/laravel-modules/v4/advanced-tools/artisan-commands

Sửa lỗi conflict khi merge vào staging

git checkout -f staging

git fetch --all && git reset --hard origin/staging

git merge --no-ff origin/branch_merge

→ sửa các file bị conflict ở đây

git commit -m “comment”

git push origin staging