# استخدم صورة PHP الرسمية للـ Laravel
FROM php:8.1-fpm

# تثبيت أدوات النظام ومتطلبات PHP الإضافية
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# تثبيت امتدادات PHP المطلوبة
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تحديد مجلد العمل
WORKDIR /var/www

# نسخ ملفات Laravel
COPY . .

# تثبيت مكتبات Laravel
RUN composer install --no-dev --optimize-autoloader

# ضبط صلاحيات المجلدات المطلوبة
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# إعداد متغيرات البيئة
COPY .env.example .env
RUN php artisan key:generate

# منفذ الاتصال
EXPOSE 8000

# بدء خادم Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
