<?php
/**
 * @file    Intl.php
 *
 * description
 *
 * copyright (c) 2019 Frank Hellenkamp [jonas@depage.net]
 *
 * @author    Frank Hellenkamp [jonas@depage.net]
 */

namespace Depage\Intl {

/**
 * @brief Intl
 * Class Intl
 */
class Intl
{
    // {{{ setLocale()
    /**
     * @brief setLocale
     *
     * @param mixed $lang
     * @return void
     **/
    public static function setLocale($lang)
    {
        $langToLocale = [
            "en" => "en_US.UTF-8",
            "de" => "de_DE.UTF-8",
        ];
        $locale = $lang;
        if (isset($langToLocale[$lang])) {
            $locale = $langToLocale[$lang];
        }

        $locale = setlocale(LC_ALL, $locale);
        if (is_callable("putenv")) {
            putenv('LANG=' . $locale);
            putenv('LC_ALL=' . $locale);
            putenv('LC_MESSAGES=' . $locale);
            putenv('LANGUAGE=' . $locale);
        }
        $_ENV['LANG'] = $locale;
        $_ENV['LC_ALL'] = $locale;
        $_ENV['LC_MESSAGES'] = $locale;
        $_ENV['LANGUAGE'] = $locale;
    }
    // }}}
    // {{{ getLocale()
    /**
     * @brief setLocale
     *
     * @param mixed $lang
     * @return void
     **/
    public static function getLocale()
    {
        return setlocale(LC_ALL, 0);
    }
    // }}}
    // {{{ getLanguageByBrowser()
    /**
     * @brief getLanguageByBrowser
     *
     * @param mixed $param
     * @return void
     **/
    public static function getLanguageByBrowser($acceptString, $availableLanguages)
    {
        $language = $availableLanguages[0];

        $browserLanguages = explode(',', $acceptString);

        foreach ($browserLanguages as $l) {
            $l = explode(';', $l);
            $l = explode('-', $l[0]);
            $l = trim($l[0]);
            if (in_array($l, $availableLanguages)) {
                $language = $l;
                break;
            }
        }

        return $language;
    }
    // }}}
}

}

// vim:set ft=php sw=4 sts=4 fdm=marker et :
