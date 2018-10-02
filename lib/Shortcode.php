<?php

/**
 * 修改自 Wordpress 短代码API
 * 适用Typecho
 *
 * @author MaiCong
 * @link https://github.com/WordPress/WordPress/blob/master/wp-includes/shortcodes.php
 * @link https://maicong.me
 * @since 1.0.0
 */

$shortcode_tags = array();

function add_shortcode($tag, $func)
{
    global $shortcode_tags;
    if ('' == trim($tag)) {
        return;
    }
    if (0 !== preg_match('@[<>&/\[\]\x00-\x20=]@', $tag)) {
        return;
    }
    $shortcode_tags[$tag] = $func;
}

function do_shortcode($content, $ignore_html = false)
{
    global $shortcode_tags;
    if (false === strpos($content, '[')) {
        return $content;
    }
    if (empty($shortcode_tags) || !is_array($shortcode_tags)) {
        return $content;
    }
    //TODO
    // Find all registered tag names in $content.
    //20180603
    $pregRule = "/<p>\[(.*?)\]<\/p>/";
    $content = preg_replace($pregRule, '[${1}]', $content);

    preg_match_all('@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches);
    $tagnames = array_intersect(array_keys($shortcode_tags), $matches[1]);
    if (empty($tagnames)) {
        return $content;
    }
    $content = do_shortcodes_in_html_tags($content, $ignore_html, $tagnames);
    $pattern = get_shortcode_regex($tagnames);
    $content = preg_replace_callback("/$pattern/", 'do_shortcode_tag', $content);
    // Always restore square braces so we don't break things like <!--[if IE ]>
    $content = strtr($content, array('&#91;' => '[', '&#93;' => ']'));
    return $content;
}

function do_shortcode_tag($m)
{
    global $shortcode_tags;
    // allow [[foo]] syntax for escaping a tag
    if ($m[1] == '[' && $m[6] == ']') {
        return substr($m[0], 1, -1);
    }
    $tag = $m[2];
    $attr = shortcode_parse_atts($m[3]);
    if (!is_callable($shortcode_tags[$tag])) {
        /* translators: %s: shortcode tag */
        return $m[0];
    }
    if (isset($m[5])) {
        // enclosing tag - extra parameter
        return $m[1] . call_user_func($shortcode_tags[$tag], $attr, $m[5], $tag) . $m[6];
    } else {
        // self-closing tag
        return $m[1] . call_user_func($shortcode_tags[$tag], $attr, null, $tag) . $m[6];
    }
}

function shortcode_atts($pairs, $atts)
{
    $atts = (array) $atts;
    $out = array();
    foreach ($pairs as $name => $default) {
        if (array_key_exists($name, $atts)) {
            $out[$name] = $atts[$name];
        } else {
            $out[$name] = $default;
        }

    }
    return $out;
}

function shortcode_parse_atts($text)
{
    $atts = array();
    $pattern = '/([\w-]+)\s*=\s*"([^"]*)"(?:\s|$)|([\w-]+)\s*=\s*\'([^\']*)\'(?:\s|$)|([\w-]+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
    $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
    if (preg_match_all($pattern, $text, $match, PREG_SET_ORDER)) {
        foreach ($match as $m) {
            if (!empty($m[1])) {
                $atts[strtolower($m[1])] = stripcslashes($m[2]);
            } elseif (!empty($m[3])) {
                $atts[strtolower($m[3])] = stripcslashes($m[4]);
            } elseif (!empty($m[5])) {
                $atts[strtolower($m[5])] = stripcslashes($m[6]);
            } elseif (isset($m[7]) && strlen($m[7])) {
                $atts[] = stripcslashes($m[7]);
            } elseif (isset($m[8])) {
                $atts[] = stripcslashes($m[8]);
            }

        }
        // Reject any unclosed HTML elements
        foreach ($atts as &$value) {
            if (false !== strpos($value, '<')) {
                if (1 !== preg_match('/^[^<]*+(?:<[^>]*+>[^<]*+)*+$/', $value)) {
                    $value = '';
                }
            }
        }
    } else {
        $atts = ltrim($text);
    }
    return $atts;
}

function get_shortcode_regex($tagnames = null)
{
    global $shortcode_tags;
    if (empty($tagnames)) {
        $tagnames = array_keys($shortcode_tags);
    }
    $tagregexp = join('|', array_map('preg_quote', $tagnames));
    // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
    // Also, see shortcode_unautop() and shortcode.js.
    return
    '\\[' // Opening bracket
     . '(\\[?)' // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
     . "($tagregexp)"// 2: Shortcode name
     . '(?![\\w-])' // Not followed by word character or hyphen
     . '(' // 3: Unroll the loop: Inside the opening shortcode tag
     . '[^\\]\\/]*' // Not a closing bracket or forward slash
     . '(?:'
    . '\\/(?!\\])' // A forward slash not followed by a closing bracket
     . '[^\\]\\/]*' // Not a closing bracket or forward slash
     . ')*?'
    . ')'
    . '(?:'
    . '(\\/)' // 4: Self closing tag ...
     . '\\]' // ... and closing bracket
     . '|'
    . '\\]' // Closing bracket
     . '(?:'
    . '(' // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
     . '[^\\[]*+' // Not an opening bracket
     . '(?:'
    . '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
     . '[^\\[]*+' // Not an opening bracket
     . ')*+'
    . ')'
    . '\\[\\/\\2\\]' // Closing shortcode tag
     . ')?'
        . ')'
        . '(\\]?)'; // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
}

function do_shortcodes_in_html_tags($content, $ignore_html, $tagnames)
{
    // Normalize entities in unfiltered HTML before adding placeholders.
    $trans = array('&#91;' => '&#091;', '&#93;' => '&#093;');
    $content = strtr($content, $trans);
    $trans = array('[' => '&#91;', ']' => '&#93;');
    $pattern = get_shortcode_regex($tagnames);
    $textarr = html_split($content);
    foreach ($textarr as &$element) {
        if ('' == $element || '<' !== $element[0]) {
            continue;
        }
        $noopen = false === strpos($element, '[');
        $noclose = false === strpos($element, ']');
        if ($noopen || $noclose) {
            // This element does not contain shortcodes.
            if ($noopen xor $noclose) {
                // Need to encode stray [ or ] chars.
                $element = strtr($element, $trans);
            }
            continue;
        }
        if ($ignore_html || '<!--' === substr($element, 0, 4) || '<![CDATA[' === substr($element, 0, 9)) {
            // Encode all [ and ] chars.
            $element = strtr($element, $trans);
            continue;
        }
        $attributes = kses_attr_parse($element);
        if (false === $attributes) {
            // Some plugins are doing things like [name] <[email]>.
            if (1 === preg_match('%^<\s*\[\[?[^\[\]]+\]%', $element)) {
                $element = preg_replace_callback("/$pattern/", 'do_shortcode_tag', $element);
            }
            // Looks like we found some crazy unfiltered HTML.  Skipping it for sanity.
            $element = strtr($element, $trans);
            continue;
        }
        // Get element name
        $front = array_shift($attributes);
        $back = array_pop($attributes);
        $matches = array();
        preg_match('%[a-zA-Z0-9]+%', $front, $matches);
        $elname = $matches[0];
        // Look for shortcodes in each attribute separately.
        foreach ($attributes as &$attr) {
            $open = strpos($attr, '[');
            $close = strpos($attr, ']');
            if (false === $open || false === $close) {
                continue; // Go to next attribute.  Square braces will be escaped at end of loop.
            }
            $double = strpos($attr, '"');
            $single = strpos($attr, "'");
            if ((false === $single || $open < $single) && (false === $double || $open < $double)) {
                // $attr like '[shortcode]' or 'name = [shortcode]' implies unfiltered_html.
                // In this specific situation we assume KSES did not run because the input
                // was written by an administrator, so we should avoid changing the output
                // and we do not need to run KSES here.
                $attr = preg_replace_callback("/$pattern/", 'do_shortcode_tag', $attr);
            } else {
                // $attr like 'name = "[shortcode]"' or "name = '[shortcode]'"
                // We do not know if $content was unfiltered. Assume KSES ran before shortcodes.
                $count = 0;
                $new_attr = preg_replace_callback("/$pattern/", 'do_shortcode_tag', $attr, -1, $count);
                if ($count > 0) {
                    // Sanitize the shortcode output using KSES.
                    $new_attr = kses_one_attr($new_attr, $elname);
                    if ('' !== trim($new_attr)) {
                        // The shortcode is safe to use now.
                        $attr = $new_attr;
                    }
                }
            }
        }
        $element = $front . implode('', $attributes) . $back;
        // Now encode any remaining [ or ] chars.
        $element = strtr($element, $trans);
    }
    $content = implode('', $textarr);
    return $content;
}

function html_split($input)
{
    return preg_split(get_html_split_regex(), $input, -1, PREG_SPLIT_DELIM_CAPTURE);
}

function get_html_split_regex()
{
    static $regex;
    if (!isset($regex)) {
        $comments =
        '!' // Start of comment, after the <.
         . '(?:' // Unroll the loop: Consume everything until --> is found.
         . '-(?!->)' // Dash not followed by end of comment.
         . '[^\-]*+' // Consume non-dashes.
         . ')*+' // Loop possessively.
         . '(?:-->)?'; // End of comment. If not found, match all input.
        $cdata =
        '!\[CDATA\[' // Start of comment, after the <.
         . '[^\]]*+' // Consume non-].
         . '(?:' // Unroll the loop: Consume everything until ]]> is found.
         . '](?!]>)' // One ] not followed by end of comment.
         . '[^\]]*+' // Consume non-].
         . ')*+' // Loop possessively.
         . '(?:]]>)?'; // End of comment. If not found, match all input.
        $escaped =
        '(?=' // Is the element escaped?
         . '!--'
        . '|'
        . '!\[CDATA\['
        . ')'
        . '(?(?=!-)' // If yes, which type?
         . $comments
            . '|'
            . $cdata
            . ')';
        $regex =
        '/(' // Capture the entire match.
         . '<' // Find start of element.
         . '(?' // Conditional expression follows.
         . $escaped // Find end of escaped element.
         . '|' // ... else ...
         . '[^>]*>?' // Find end of normal element.
         . ')'
            . ')/';
    }
    return $regex;
}

function kses_attr_parse($element)
{
    $valid = preg_match('%^(<\s*)(/\s*)?([a-zA-Z0-9]+\s*)([^>]*)(>?)$%', $element, $matches);
    if (1 !== $valid) {
        return false;
    }
    $begin = $matches[1];
    $slash = $matches[2];
    $elname = $matches[3];
    $attr = $matches[4];
    $end = $matches[5];
    if ('' !== $slash) {
        // Closing elements do not get parsed.
        return false;
    }
    // Is there a closing XHTML slash at the end of the attributes?
    if (1 === preg_match('%\s*/\s*$%', $attr, $matches)) {
        $xhtml_slash = $matches[0];
        $attr = substr($attr, 0, -strlen($xhtml_slash));
    } else {
        $xhtml_slash = '';
    }

    // Split it
    $attrarr = kses_hair_parse($attr);
    if (false === $attrarr) {
        return false;
    }
    // Make sure all input is returned by adding front and back matter.
    array_unshift($attrarr, $begin . $slash . $elname);
    array_push($attrarr, $xhtml_slash . $end);

    return $attrarr;
}

function kses_hair_parse($attr)
{
    if ('' === $attr) {
        return array();
    }
    $regex =
    '(?:'
    . '[-a-zA-Z:]+' // Attribute name.
     . '|'
    . '\[\[?[^\[\]]+\]\]?' // Shortcode in the name position implies unfiltered_html.
     . ')'
    . '(?:' // Attribute value.
     . '\s*=\s*' // All values begin with '='
     . '(?:'
    . '"[^"]*"' // Double-quoted
     . '|'
    . "'[^']*'" // Single-quoted
     . '|'
    . '[^\s"\']+' // Non-quoted
     . '(?:\s|$)' // Must have a space
     . ')'
    . '|'
    . '(?:\s|$)' // If attribute has no value, space is required.
     . ')'
        . '\s*'; // Trailing space is optional except as mentioned above.
    // Although it is possible to reduce this procedure to a single regexp,
    // we must run that regexp twice to get exactly the expected result.
    $validation = "%^($regex)+$%";
    $extraction = "%$regex%";
    if (1 === preg_match($validation, $attr)) {
        preg_match_all($extraction, $attr, $attrarr);
        return $attrarr[0];
    } else {
        return false;
    }
}

function kses_one_attr($string, $element)
{
    $string = preg_replace(['/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '%&\s*\{[^}]*(\}\s*;?|$)%'], '', $string);

    // Preserve leading and trailing whitespace.
    $matches = array();
    preg_match('/^\s*/', $string, $matches);
    $lead = $matches[0];
    preg_match('/\s*$/', $string, $matches);
    $trail = $matches[0];
    if (empty($trail)) {
        $string = substr($string, strlen($lead));
    } else {
        $string = substr($string, strlen($lead), -strlen($trail));
    }

    // Parse attribute name and value from input.
    $split = preg_split('/\s*=\s*/', $string, 2);
    $name = $split[0];
    if (count($split) == 2) {
        $value = $split[1];
        // Remove quotes surrounding $value.
        // Also guarantee correct quoting in $string for this one attribute.
        if ('' == $value) {
            $quote = '';
        } else {
            $quote = $value[0];
        }
        if ('"' == $quote || "'" == $quote) {
            if (substr($value, -1) != $quote) {
                return '';
            }
            $value = substr($value, 1, -1);
        } else {
            $quote = '"';
        }
        // Sanitize quotes, angle braces, and entities.
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        // Sanitize URI values.
        $string = "$name=$quote$value$quote";
        $vless = 'n';
    } else {
        $value = '';
        $vless = 'y';
    }

    // Restore whitespace.
    return $lead . $string . $trail;
}

function autop($pee, $br = true)
{
    $pre_tags = array();
    if (trim($pee) === '') {
        return '';
    }
    // Just to make things a little easier, pad the end.
    $pee = $pee . "\n";
    /*
     * Pre tags shouldn't be touched by autop.
     * Replace pre tags with placeholders and bring them back after autop.
     */
    if (strpos($pee, '<pre') !== false) {
        $pee_parts = explode('</pre>', $pee);
        $last_pee = array_pop($pee_parts);
        $pee = '';
        $i = 0;
        foreach ($pee_parts as $pee_part) {
            $start = strpos($pee_part, '<pre');
            // Malformed html?
            if ($start === false) {
                $pee .= $pee_part;
                continue;
            }
            $name = "<pre wp-pre-tag-$i></pre>";
            $pre_tags[$name] = substr($pee_part, $start) . '</pre>';
            $pee .= substr($pee_part, 0, $start) . $name;
            $i++;
        }
        $pee .= $last_pee;
    }
    // Change multiple <br>s into two line breaks, which will turn into paragraphs.
    $pee = preg_replace('|<br\s*/?>\s*<br\s*/?>|', "\n\n", $pee);
    $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';
    // Add a double line break above block-level opening tags.
    $pee = preg_replace('!(<' . $allblocks . '[\s/>])!', "\n\n$1", $pee);
    // Add a double line break below block-level closing tags.
    $pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
    // Standardize newline characters to "\n".
    $pee = str_replace(array("\r\n", "\r"), "\n", $pee);
    // Find newlines in all elements and add placeholders.
    $pee = replace_in_html_tags($pee, array("\n" => ' <!-- wpnl --> '));
    // Collapse line breaks before and after <option> elements so they don't get autop'd.
    if (strpos($pee, '<option') !== false) {
        $pee = preg_replace('|\s*<option|', '<option', $pee);
        $pee = preg_replace('|</option>\s*|', '</option>', $pee);
    }
    /*
     * Collapse line breaks inside <object> elements, before <param> and <embed> elements
     * so they don't get autop'd.
     */
    if (strpos($pee, '</object>') !== false) {
        $pee = preg_replace('|(<object[^>]*>)\s*|', '$1', $pee);
        $pee = preg_replace('|\s*</object>|', '</object>', $pee);
        $pee = preg_replace('%\s*(</?(?:param|embed)[^>]*>)\s*%', '$1', $pee);
    }
    /*
     * Collapse line breaks inside <audio> and <video> elements,
     * before and after <source> and <track> elements.
     */
    if (strpos($pee, '<source') !== false || strpos($pee, '<track') !== false) {
        $pee = preg_replace('%([<\[](?:audio|video)[^>\]]*[>\]])\s*%', '$1', $pee);
        $pee = preg_replace('%\s*([<\[]/(?:audio|video)[>\]])%', '$1', $pee);
        $pee = preg_replace('%\s*(<(?:source|track)[^>]*>)\s*%', '$1', $pee);
    }
    // Collapse line breaks before and after <figcaption> elements.
    if (strpos($pee, '<figcaption') !== false) {
        $pee = preg_replace('|\s*(<figcaption[^>]*>)|', '$1', $pee);
        $pee = preg_replace('|</figcaption>\s*|', '</figcaption>', $pee);
    }
    // Remove more than two contiguous line breaks.
    $pee = preg_replace("/\n\n+/", "\n\n", $pee);
    // Split up the contents into an array of strings, separated by double line breaks.
    $pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
    // Reset $pee prior to rebuilding.
    $pee = '';
    // Rebuild the content as a string, wrapping every bit with a <p>.
    foreach ($pees as $tinkle) {
        $pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
    }
    // Under certain strange conditions it could create a P of entirely whitespace.
    $pee = preg_replace('|<p>\s*</p>|', '', $pee);
    // Add a closing <p> inside <div>, <address>, or <form> tag if missing.
    $pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', '<p>$1</p></$2>', $pee);
    // If an opening or closing block element tag is wrapped in a <p>, unwrap it.
    $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', '$1', $pee);
    // In some cases <li> may get wrapped in <p>, fix them.
    $pee = preg_replace('|<p>(<li.+?)</p>|', '$1', $pee);
    // If a <blockquote> is wrapped with a <p>, move it inside the <blockquote>.
    $pee = preg_replace('|<p><blockquote([^>]*)>|i', '<blockquote$1><p>', $pee);
    $pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
    // If an opening or closing block element tag is preceded by an opening <p> tag, remove it.
    $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', '$1', $pee);
    // If an opening or closing block element tag is followed by a closing <p> tag, remove it.
    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', '$1', $pee);
    // Optionally insert line breaks.
    if ($br) {
        // Replace newlines that shouldn't be touched with a placeholder.
        $pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', '_autop_newline_preservation_helper', $pee);
        // Normalize <br>
        $pee = str_replace(array('<br>', '<br/>'), '<br />', $pee);
        // Replace any new line characters that aren't preceded by a <br /> with a <br />.
        $pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee);
        // Replace newline placeholders with newlines.
        $pee = str_replace('<PreserveNewline />', "\n", $pee);
    }
    // If a <br /> tag is after an opening or closing block tag, remove it.
    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', '$1', $pee);
    // If a <br /> tag is before a subset of opening or closing block tags, remove it.
    $pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
    $pee = preg_replace("|\n</p>$|", '</p>', $pee);
    // Replace placeholder <pre> tags with their original content.
    if (!empty($pre_tags)) {
        $pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);
    }
    // Restore newlines in all elements.
    if (false !== strpos($pee, '<!-- wpnl -->')) {
        $pee = str_replace(array(' <!-- wpnl --> ', '<!-- wpnl -->'), "\n", $pee);
    }
    return $pee;
}

function _autop_newline_preservation_helper($matches)
{
    return str_replace("\n", '<PreserveNewline />', $matches[0]);
}

function replace_in_html_tags($haystack, $replace_pairs)
{
    // Find all elements.
    $textarr = html_split($haystack);
    $changed = false;
    // Optimize when searching for one item.
    if (1 === count($replace_pairs)) {
        // Extract $needle and $replace.
        foreach ($replace_pairs as $needle => $replace) {
        }
        // Loop through delimiters (elements) only.
        for ($i = 1, $c = count($textarr); $i < $c; $i += 2) {
            if (false !== strpos($textarr[$i], $needle)) {
                $textarr[$i] = str_replace($needle, $replace, $textarr[$i]);
                $changed = true;
            }
        }
    } else {
        // Extract all $needles.
        $needles = array_keys($replace_pairs);
        // Loop through delimiters (elements) only.
        for ($i = 1, $c = count($textarr); $i < $c; $i += 2) {
            foreach ($needles as $needle) {
                if (false !== strpos($textarr[$i], $needle)) {
                    $textarr[$i] = strtr($textarr[$i], $replace_pairs);
                    $changed = true;
                    // After one strtr() break out of the foreach loop and look at next element.
                    break;
                }
            }
        }
    }
    if ($changed) {
        $haystack = implode($textarr);
    }
    return $haystack;
}

class Shortcode
{
    /**
     * 注册短代码
     */
    public function shortcode_linkitem($atts, $content = '')
    {
        $args = shortcode_atts(array(
            'href' => '',
            'title' => '',
            'img' => '',
            'name' => '',
        ), $atts);
        $href = $args['href'] ? 'href="'.$args['href'].'"' : "";
        return '<a '. $href .'title="' . $args['title'] . '" target="_blank"><div class="link-item"><img class="link-avatar" src="' . $args['img'] . '"><span class="link-name">' . $args['name'] . '</span></div></a>';
    }

    public function shortcode_linkbox($atts, $content = '')
    {
        return '<div class="link-box">' . do_shortcode($content) . '</div>';
    }
    //[link-item]

    /**
     * parser
     */
    public static function parse($content, $widget, $lastResult)
    {
        $content = empty($lastResult) ? $content : $lastResult;
        if ($widget instanceof Widget_Archive) {
            add_shortcode('link-item', 'Shortcode::shortcode_linkitem');
            add_shortcode('link-box', 'Shortcode::shortcode_linkbox');
        }
        return do_shortcode($content);
    }
}
