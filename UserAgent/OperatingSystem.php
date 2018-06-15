<?php
/**
 * Detect Operating System
 * @package php-useragent
 * @author zsx <zsx@zsxsoft.com>
 * @author Kyle Baker <kyleabaker@gmail.com>
 * @author Fernando Briano <transformers.es@gmail.com>
 * @copyright Copyright 2014-2017 zsx
 * @copyright Copyright 2008-2014 Kyle Baker (email: kyleabaker@gmail.com)
 * @copyright 2008 Fernando Briano (email : transformers.es@gmail.com)
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

/**
 * Detect Operating System
 */

class useragent_detect_os {
    private static $_windows_version = array(
        "10.0" => array("10", "6"),
        "6.4" => array("10", "6"), // Windows 10 before 10240
        "6.3" => array("8.1", "5"),
        "6.2" => array("8", "5"),
        "6.1" => array("7", "4"),
        "6.0" => array("Vista", "3"),
        "5.2" => array("Server 2003", "2"),
        "5.1" => array("XP", "2"),
        "5.01" => array("2000 Service Pack 1", "1"),
        "5.0" => array("2000", "1"),
        "4.0" => array("NT 4.0", "1"),
        "3.51" => array("NT 3.11", "1"),
    );

    public static function analyze($useragent) {

        $result = array();

        // Check if is AMD64
        $x64 = false;
        if (preg_match('/x86_64|Win64; x64|WOW64|IRIX64/i', $useragent)) {
            $x64 = true;
        }

        // Check Linux
        if (preg_match('/Windows|Win(NT|32|95|98|16)|ZuneWP7|WPDesktop/i', $useragent)) {
            $result = self::analyzeWindows($useragent);
        } elseif (preg_match('/Linux/i', $useragent) && !preg_match('/Android|ADR|Tizen/', $useragent)) {
            $result = self::analyzeLinux($useragent);
        } else {
            $result = self::analyzeOther($useragent);
        }

        $result['x64'] = $x64;
        $result['title'] = $result['name'] . ($result['version'] == "" ? '' : ' ' . $result['version']) . ($x64 ? ' x64' : '');
        $result['type'] = 'os';
        $result['dir'] = 'os';

        return $result;
    }

    private static function _returnWindows(&$return, $index) {
        $return['image_url'] = 'win-' . self::$_windows_version[$index][1];
        $return['version'] = self::$_windows_version[$index][0];
    }

    public static function analyzeWindows($useragent) {
        $link = "http://www.microsoft.com/windows/";
        $name = 'Windows';
        $version = '';
        $image_url = 'win-2';
        $return = array(
            "image_url" => "",
            "version" => "",
        );

        if (preg_match('/Windows Phone|WPDesktop|ZuneWP7|WP7/i', $useragent)) {
            $link = "https://www.microsoft.com/windows/phones";
            $name .= ' Phone';
            $image_url = "windowsphone";
            if (preg_match('/Windows Phone (OS )?([0-9\.]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[2];
                $intVersion = (int) $version;
                if ($intVersion == 10) {
                    $name = "Windows";
                    $version = "10 Mobile";
                    $image_url = "win-6";
                } elseif ($intVersion == 7) {
                    $image_url = "wp7";
                }
            }
        } elseif (preg_match('/Windows NT (\d+\.\d+)/i', $useragent, $regmatch)) {
            if (isset(self::$_windows_version[$regmatch[1]])) {
                self::_returnWindows($return, $regmatch[1]);
            }
        } elseif (preg_match('/Windows 2000/i', $useragent)) {
            self::_returnWindows($return, "5.0");
        } elseif (preg_match('/Windows XP/i', $useragent)) {
            self::_returnWindows($return, "5.1");
        } elseif (preg_match('/Win(dows )?NT ?4.0|WinNT4.0/i', $useragent)) {
            self::_returnWindows($return, "4.0");
        } elseif (preg_match('/Win(dows )?NT ?3.51|WinNT3.51/i', $useragent)) {
            self::_returnWindows($return, "3.51");
        } elseif (preg_match('/Win(dows )?3.11|Win16/i', $useragent)) {
            $version = "3.11";
            $image_url = "win-1";
        } elseif (preg_match('/Windows 3.1/i', $useragent)) {
            $version = "3.1";
            $image_url = "win-1";
        } elseif (preg_match('/Win 9x 4.90|Windows ME/i', $useragent)) {
            $version = "Me";
            $image_url = "win-1";
        } elseif (preg_match('/Win98/i', $useragent)) {
            $version = "98 SE";
            $image_url = "win-1";
        } elseif (preg_match('/Windows (98|4\.10)/i', $useragent)) {
            $version = "98";
            $image_url = "win-1";
        } elseif (preg_match('/Windows 95/i', $useragent)
            || preg_match('/Win95/i', $useragent)) {
            $version = "95";
            $image_url = "win-1";
        } elseif (preg_match('/Windows CE|Windows .+Mobile/i', $useragent)) {
            $version = "CE";
            $image_url = "win-2";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/WM5/i', $useragent)) {
            $name .= " Mobile";
            $version = "5";
            $image_url = "win-phone";
        } elseif (preg_match('/WindowsMobile/i', $useragent)) {
            $name .= " Mobile";
            $image_url = "win-phone";
        }
        // @codeCoverageIgnoreEnd

        if ($return['image_url'] !== "") {
            $image_url = $return['image_url'];
        }
        if ($return['version'] !== "") {
            $version = $return['version'];
        }

        return array(
            'link' => $link,
            'name' => $name,
            'version' => $version,
            'code' => $image_url,
        );
    }

    public static function analyzeLinux($useragent) {
        $link = '';
        $name = '';
        $image_url = '';
        $version = '';

        if (preg_match('/[^A-Za-z]Arch/i', $useragent)) {
            $link = "http://www.archlinux.org/";
            $name = "Arch Linux";
            $image_url = "archlinux";
        } elseif (preg_match('/CentOS/i', $useragent)) {
            $link = "http://www.centos.org/";
            $name = "CentOS";

            if (preg_match('/.el([.0-9a-zA-Z]+).centos/i', $useragent, $regmatch)) {
                $version = $regmatch[1];
            }

            $image_url = "centos";
// @codeCoverageIgnoreStart
        } elseif (preg_match('/Chakra/i', $useragent)) {
            $link = "http://www.chakra-linux.org/";
            $name = "Chakra Linux";
            $image_url = "chakra";
// @codeCoverageIgnoreEnd
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Crunchbang/i', $useragent)) {
            $link = "http://www.crunchbanglinux.org/";
            $name = "Crunchbang";
            $image_url = "crunchbang";
// @codeCoverageIgnoreEnd
        } elseif (preg_match('/Debian/i', $useragent)) {
            $link = "http://www.debian.org/";
            $name = "Debian GNU/Linux";
            $image_url = "debian";
// @codeCoverageIgnoreStart
        } elseif (preg_match('/Edubuntu/i', $useragent)) {
            $link = "http://www.edubuntu.org/";
            $name = "Edubuntu";

            if (preg_match('/Edubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];

                if ($regmatch[1] < 10) {
                    $image_url = "edubuntu-1";
                } else {
                    $image_url = "edubuntu-2";
                }

            }

            if (strlen($version) > 1) {
                $name .= $version;
            }
// @codeCoverageIgnoreEnd
        } elseif (preg_match('/Fedora/i', $useragent)) {
            $link = "http://www.fedoraproject.org/";
            $name = "Fedora";

            if (preg_match('/.fc([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];

            }

            $image_url = "fedora";
        } elseif (preg_match('/Foresight\ Linux/i', $useragent)) {
            $link = "http://www.foresightlinux.org/";
            $name = "Foresight Linux";

            if (preg_match('/Foresight\ Linux\/([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];

            }

            $image_url = "foresight";
        } elseif (preg_match('/Gentoo/i', $useragent)) {
            $link = "http://www.gentoo.org/";
            $name = "Gentoo";
            $image_url = "gentoo";

        } elseif (preg_match('/Jolla/i', $useragent)) {
            $link = "https://jolla.com/";
            $name = "Jolla";
            $image_url = "jolla";
        } elseif (preg_match('/Kanotix/i', $useragent)) {
            $link = "http://www.kanotix.com/";
            $name = "Kanotix";
            $image_url = "kanotix";
// @codeCoverageIgnoreStart
        } elseif (preg_match('/Knoppix/i', $useragent)) {
            $link = "http://www.knoppix.net/";
            $name = "Knoppix";
            $image_url = "knoppix";
// @codeCoverageIgnoreEnd
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Kubuntu/i', $useragent)) {
            $link = "http://www.kubuntu.org/";
            $name = "Kubuntu";

            if (preg_match('/Kubuntu[\/|\ ]([.0-9]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];

                if ($regmatch[1] < 10) {
                    $image_url = "kubuntu-1";
                } else {
                    $image_url = "kubuntu-2";
                }
            } else {
                $image_url = "kubuntu-2";
            }

// @codeCoverageIgnoreEnd
        } elseif (preg_match('/LindowsOS/i', $useragent)) {
            $link = "http://en.wikipedia.org/wiki/Lsongs";
            $name = "LindowsOS";
            $image_url = "lindowsos";

        } elseif (preg_match('/Linspire/i', $useragent)) {
            $link = "http://www.linspire.com/";
            $name = "Linspire";
            $image_url = "lindowsos";

        } elseif (preg_match('/Linux\ Mint/i', $useragent)) {
            $link = "http://www.linuxmint.com/";
            $name = "Linux Mint";

            if (preg_match('/Linux\ Mint\/([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];

            }

            $image_url = "linuxmint";
// @codeCoverageIgnoreStart

        } elseif (preg_match('/Lubuntu/i', $useragent)) {
            $link = "http://www.lubuntu.net/";
            $name = "Lubuntu";

            if (preg_match('/Lubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];

                if ($regmatch[1] < 10) {
                    $image_url = "lubuntu-1";
                } else {
                    $image_url = "lubuntu-2";
                }
            }

            if (strlen($version) > 1) {
                $name .= $version;
            }
// @codeCoverageIgnoreEnd

// @codeCoverageIgnoreStart

        } elseif (preg_match('/Mageia/i', $useragent)) {
            $link = "http://www.mageia.org/";
            $name = "Mageia";
            $image_url = "mageia";
// @codeCoverageIgnoreEnd
        } elseif (preg_match('/Mandriva/i', $useragent)) {
            $link = "http://www.mandriva.com/";
            $name = "Mandriva";
// @codeCoverageIgnoreStart

            if (preg_match('/mdv([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];

            }
// @codeCoverageIgnoreEnd

            $image_url = "mandriva";

        } elseif (preg_match('/moonOS/i', $useragent)) {
            $link = "http://www.moonos.org/";
            $name = "moonOS";

            if (preg_match('/moonOS\/([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];

            }

            $image_url = "moonos";
        } elseif (preg_match('/Nova/i', $useragent)) {
            $link = "http://www.nova.cu";
            $name = "Nova";

            if (preg_match('/Nova[\/|\ ]([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];

            }

            $image_url = "nova";
// @codeCoverageIgnoreStart

        } elseif (preg_match('/Oracle/i', $useragent)) {
            $link = "http://www.oracle.com/us/technologies/linux/";
            $name = "Oracle";

            if (preg_match('/.el([._0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $name .= " Enterprise Linux";
                $version = str_replace("_", ".", $regmatch[1]);
            } else {
                $name .= " Linux";
            }
            $image_url = "oracle";
// @codeCoverageIgnoreEnd

        } elseif (preg_match('/Pardus/i', $useragent)) {
            $link = "http://www.pardus.org.tr/en/";
            $name = "Pardus";
            $image_url = "pardus";

        } elseif (preg_match('/Red\ Hat/i', $useragent)
            || preg_match('/RedHat/i', $useragent)) {
            $link = "http://www.redhat.com/";
            $name = "Red Hat";

            if (preg_match('/.el([._0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $name .= " Enterprise Linux";
                $version = str_replace("_", ".", $regmatch[1]);
            }

            $image_url = "red-hat";

        } elseif (preg_match('/Slackware/i', $useragent)) {
            $link = "http://www.slackware.com/";
            $name = "Slackware";
            $image_url = "slackware";
        } elseif (preg_match('/Suse/i', $useragent)) {
            $link = "http://www.opensuse.org/";
            $name = "openSUSE";
            $image_url = "suse";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Xubuntu/i', $useragent)) {
            $link = "http://www.xubuntu.org/";
            $name = "Xubuntu";

            if (preg_match('/Xubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];

                if ($regmatch[1] < 10) {
                    $image_url = "xubuntu-1";
                } else {
                    $image_url = "xubuntu-2";
                }

            }

// @codeCoverageIgnoreEnd
        } elseif (preg_match('/Zenwalk/i', $useragent)) {
            $link = "http://www.zenwalk.org/";
            $name = "Zenwalk GNU Linux";
            $image_url = "zenwalk";
        }

        // Pulled out of order to help ensure better detection for above platforms
        elseif (preg_match('/Ubuntu/i', $useragent)) {
            $link = "http://www.ubuntu.com/";
            $name = "Ubuntu";

            if (preg_match('/Ubuntu[\/|\ ]([.0-9]+[.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];
                if ($regmatch[1] < 10) {
                    $image_url = "ubuntu-1";
                }
            }

            if ($image_url == '') {
                $image_url = "ubuntu-2";
            }

        } else {
            $link = "http://www.linux.org/";
            $name = "GNU/Linux";
            $image_url = "linux";
        }

        return array(
            'link' => $link,
            'name' => $name,
            'version' => $version,
            'code' => $image_url,
        );
    }

    public static function analyzeOther($useragent) {
        $link = '';
        $name = '';
        $image_url = '';
        $version = '';

        // Opera's Useragent does not contains 'Linux'
        if (preg_match('/Android|ADR /i', $useragent)) {
            $link = "http://www.android.com/";
            $name = "Android";
            $image_url = "android";

            if (preg_match('/(Android|Adr)[\ |\/]([.0-9]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[2];
            }
        } elseif (preg_match('/CPU\ (iPhone )?OS\ ([._0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
            $link = "http://www.apple.com/";
            $name = "iOS";
            $image_url = "mac-3";
            $version = str_replace("_", ".", $regmatch[2]);
        } elseif (preg_match('/AmigaOS/i', $useragent)) {
            $link = "http://en.wikipedia.org/wiki/AmigaOS";
            $name = "AmigaOS";

            if (preg_match('/AmigaOS\ ([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];
            }

            $image_url = "amigaos";
        } elseif (preg_match('/BB10/i', $useragent)) {
            $link = "http://www.blackberry.com/";
            $name = "BlackBerry OS";
            $version = "10";
            $image_url = "blackberry";

        } elseif (preg_match('/BeOS/i', $useragent)) {
            $link = "http://en.wikipedia.org/wiki/BeOS";
            $name = "BeOS";
            $image_url = "beos";

        } elseif (preg_match('/\b(?!Mi)CrOS(?!oft)/i', $useragent)) {
            $link = "http://en.wikipedia.org/wiki/Google_Chrome_OS";
            $name = "Google Chrome OS";
            $image_url = "chromeos";
        } elseif (preg_match('/DragonFly/i', $useragent)) {
            $link = "http://www.dragonflybsd.org/";
            $name = "DragonFly BSD";
            $image_url = "dragonflybsd";

        } elseif (preg_match('/FreeBSD/i', $useragent)) {
            $link = "http://www.freebsd.org/";
            $name = "FreeBSD";
            $image_url = "freebsd";

        } elseif (preg_match('/Inferno/i', $useragent)) {
            $link = "http://www.vitanuova.com/inferno/";
            $name = "Inferno";
            $image_url = "inferno";

        } elseif (preg_match('/IRIX/i', $useragent)) {
            $link = "http://www.sgi.com/partners/?/technology/irix/";
            $name = "IRIX";

            if (preg_match('/IRIX(64)?\ ([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {

                if ($regmatch[2]) {
                    $version = $regmatch[2];
                }
            }

            $image_url = "irix";

        } elseif (preg_match('/Mac/i', $useragent)
            || preg_match('/Darwin/i', $useragent)) {
            $link = "http://www.apple.com/macosx/";

            if (preg_match('/(Mac OS ?X)/i', $useragent, $regmatch)) {
                $name = substr($useragent, strpos(strtolower($useragent), strtolower($regmatch[1])));
                $name = substr($name, 0, strpos($name, ")"));

                if (strpos($name, ";")) {
                    $name = substr($name, 0, strpos($name, ";"));
                }

                $name = str_replace("_", ".", $name);
                $name = str_replace("OSX", "OS X", $name);

                $image_url = $regmatch[1] == "Mac OSX" ? "mac-2" : "mac-3";
            } elseif (preg_match('/Darwin/i', $useragent)) {
                $name = "Mac OS Darwin";
                $image_url = "mac-1";
            } else {
                $name = "Macintosh";
                $image_url = "mac-1";
            }
        } elseif (preg_match('/Meego/i', $useragent)) {
            $link = "http://meego.com/";
            $name = "Meego";
            $image_url = "meego";

        } elseif (preg_match('/MorphOS/i', $useragent)) {
            $link = "http://www.morphos-team.net/";
            $name = "MorphOS";
            $image_url = "morphos";

        } elseif (preg_match('/NetBSD/i', $useragent)) {
            $link = "http://www.netbsd.org/";
            $name = "NetBSD";
            $image_url = "netbsd";

        } elseif (preg_match('/OpenBSD/i', $useragent)) {
            $link = "http://www.openbsd.org/";
            $name = "OpenBSD";
            $image_url = "openbsd";
        } elseif (preg_match('/RISC OS/i', $useragent)) {
            $link = "https://www.riscosopen.org/";
            $name = "RISC OS";
            $image_url = "risc";

            if (preg_match('/RISC OS ([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[1];
            }

        } elseif (preg_match('/Solaris|SunOS/i', $useragent)) {
            $link = "http://www.sun.com/software/solaris/";
            $name = "Solaris";
            $image_url = "solaris";

        } elseif (preg_match('/Symb(ian)?(OS)?/i', $useragent)) {
            $link = "http://www.symbianos.org/";
            $name = "SymbianOS";

            if (preg_match('/Symb(ian)?(OS)?\/([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
                $version = $regmatch[3];
            }

            $image_url = "symbian";

        } elseif (preg_match('/Tizen/i', $useragent)) {
            $link = "https://www.tizen.org/";
            $name = "Tizen";
            $image_url = "tizen";
// @codeCoverageIgnoreStart

        } elseif (preg_match('/Unix/i', $useragent)) {
            $link = "http://www.unix.org/";
            $name = "Unix";
            $image_url = "unix";
// @codeCoverageIgnoreStart

        } elseif (preg_match('/webOS/i', $useragent)) {
            $link = "http://en.wikipedia.org/wiki/WebOS";
            $name = "Palm webOS";
            $image_url = "palm";
        } elseif (preg_match('/J2ME\/MIDP/i', $useragent)) {
            $link = "http://java.sun.com/javame/";
            $name = "J2ME/MIDP Device";
            $image_url = "java";
        } else {
            $image_url = "null";
        }

        return array(
            'link' => $link,
            'name' => $name,
            'version' => $version,
            'code' => $image_url,
        );
    }
}
