<?php
namespace EkAndreas\Listig\Shortcode;

class ShortcodeService
{
    protected $shortcodes = [];

    public function __construct(array $shortcodeClasses)
    {
        foreach ($shortcodeClasses as $shortcode) {
            $this->register($shortcode);
        }
        $this->boot();
    }

    private function register($shortcode)
    {
        $interfaces = class_implements($shortcode);
        if (!in_array(__NAMESPACE__ . '\ShortcodeInterface', $interfaces)) {
            throw new \Exception("{$shortcode} does not implement ShortcodeInterface");
        }
        $this->shortcodes[] = $shortcode;
    }

    private function boot()
    {
        foreach ($this->shortcodes as $shortcode) {
            add_shortcode($shortcode::tag(), $shortcode . '::handle');
        }
    }
}
