<?php

namespace App\Helpers;

class IconHelper
{
    /**
     * قائمة الأيقونات الأساسية.
     */
    protected static array $icons = [
        'dashboard' => 'fas fa-tachometer-alt',
        'id' => 'fa fa-id-card',
        'name' => 'fa fa-tag',
        'email' => 'fa fa-envelope',
        'phone' => 'fa fa-phone',
        'password' => 'fa fa-key',
        'mony' => 'fa fa-money-bill',
        'date-alt' => 'fa fa-calendar-alt',
        'date' => 'fa fa-calendar',
        'time' => 'fa fa-clock',
        'vr' => 'fa fa-vr-cardboard',
        'chat' => 'fa fa-comments',
        'organize' => 'fa fa-sitemap',
        'user' => 'fa fa-user',
        'users' => 'fa fa-users',
        'guide' => 'fa fa-compass',
        'booking' => 'fas fa-calendar',
        'bookings' => 'fas fa-calendar-days',
        'approved_bookings' => 'fas fa-calendar-check',
        'location' => 'fa fa-map-marker-alt',
        'default' => 'fa fa-question-circle',
        'active' => 'fa fa-check',
        'backTo' => 'fa fa-arrow-left',
        'facebook' => 'fab fa-facebook',
        'twitter' => 'fab fa-twitter',
        'instagram' => 'fab fa-instagram',
        'youtube' => 'fab fa-youtube',
        'linkedin' => 'fab fa-linkedin',
        'district' => 'fas fa-chart-area',
        'districts' => 'fas fa-chart-area',
        'placetype' => 'fas fa-atlas',
        'placetypes' => 'fas fa-atlas',
        'tour' => 'fas fa-route',
        'tours' => 'fas fa-route',
        'place' => 'fas fa-map-marker-alt',
        'places' => 'fas fa-map-marker-alt',
        'booking_now'=>'fas fa-calendar-check',
        'send'=>'fas fa-send'

    ];

    /**
     * إرجاع كود الأيقونة كـ HTML.
     *
     * @param  string  $name  اسم الأيقونة
     * @param  string|null  $class  كلاس إضافي (لون - حجم ...الخ)
     */
    public static function get(string $name, ?string $class = null): string
    {
        $icon = static::$icons[$name] ?? static::$icons['default'];

        return '<i class="'.$icon.' '.($class ?? '').'"></i>';
    }

    public static function getWithText(string $name,$text=null, string $classIcon=null,$classText='hidden-xs'): string
    {
        $icon = static::get($name, $classIcon);
        return $icon." <span class='$classText'>".($text ?? __("titles.$name"))."</span>";
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
