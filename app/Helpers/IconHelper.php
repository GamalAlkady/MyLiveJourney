<?php

namespace App\Helpers;

class IconHelper
{
    /**
     * قائمة الأيقونات الأساسية.
     */
    protected static array $icons = [
        'id'       => 'fa fa-id-card',
        'name'     => 'fa fa-tag',
        'email'    => 'fa fa-envelope',
        'phone'    => 'fa fa-phone',
        'password' => 'fa fa-key',
        'mony'    => 'fa fa-money-bill',
        'date'     => 'fa fa-calendar',
        'time'     => 'fa fa-clock',
        'tour'       => 'fa fa-map',
        'vr'         => 'fa fa-vr-cardboard',
        'chat'       => 'fa fa-comments',
        'organize'   => 'fa fa-sitemap',
        'user'       => 'fa fa-user',
        'users'      => 'fa fa-users',
        'guide'      => 'fa fa-compass',
        'booking'    => 'fa fa-ticket-alt',
        'location'   => 'fa fa-map-marker-alt',
        'default'    => 'fa fa-question-circle',
        'active'     => 'fa fa-check',
        'backTo'     => 'fa fa-arrow-left',
        'facebook'   => 'fab fa-facebook',
        'twitter'    => 'fab fa-twitter',
        'instagram'  => 'fab fa-instagram',
        'youtube'    => 'fab fa-youtube',
        'linkedin'   => 'fab fa-linkedin',
    ];

    /**
     * إرجاع كود الأيقونة كـ HTML.
     *
     * @param string $name اسم الأيقونة
     * @param string|null $class كلاس إضافي (لون - حجم ...الخ)
     */
    public static function get(string $name, ?string $class = null): string
    {
        $icon = static::$icons[$name] ?? static::$icons['default'];

        return '<i class="' . $icon . ' ' . ($class ?? '') . '"></i>';
    }

    /**
     * الحصول على الكلاس فقط (بدون HTML).
     */
    public static function class(string $name): string
    {
        return static::$icons[$name] ?? static::$icons['default'];
    }

    /**
     * إضافة أيقونة جديدة في وقت التشغيل (اختياري).
     */
    public static function add(string $name, string $class): void
    {
        static::$icons[$name] = $class;
    }
}
