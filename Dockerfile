# استخدام صورة PHP 8.2 مع FPM
FROM php:8.2-fpm

# تثبيت الحزم اللازمة
RUN apt-get update && apt-get install --no-install-recommends -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت إضافات PHP المطلوبة
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# إعداد مجلد العمل
WORKDIR /var/www

# نسخ كافة ملفات المشروع
COPY . .

# ضبط صلاحيات الملفات والمجلدات
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# تثبيت مكتبات Composer مع السماح بتشغيله كـ root
RUN composer install --no-dev --optimize-autoloader

# تعيين المستخدم إلى www-data
USER www-data
