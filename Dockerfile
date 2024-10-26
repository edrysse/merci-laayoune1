# استخدام صورة PHP 8.2 مع FPM
FROM php:8.2-fpm

# تثبيت الحزم اللازمة
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# تثبيت إضافات PHP المطلوبة
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# إعداد مجلد العمل
WORKDIR /var/www

# نسخ ملفي composer.json و composer.lock
COPY composer.json composer.lock ./

# تثبيت مكتبات Composer مع السماح بتشغيله كـ root
RUN export COMPOSER_ALLOW_SUPERUSER=1 && composer install --no-dev --optimize-autoloader

# نسخ كافة ملفات المشروع
COPY . .

# ضبط صلاحيات الملفات والمجلدات
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# تعيين المستخدم إلى www-data
USER www-data

# إعداد Entrypoint لبدء السيرفر
CMD php artisan serve --host=0.0.0.0 --port=8000
