<?php
/**
 *
 * Copyright 2007 Michael Cochrane <code@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Michael Cochrane <code@gardyneholt.co.nz>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 */

class JOJO_Plugin_jojo_googlevideo extends JOJO_Plugin
{
    function googlevideo($content)
    {
        global $smarty;

        /* Find all [[goooglevideo:url]] tags */
        preg_match_all('/\[\[googlevideo:([^\]]*)\]\]/', $content, $matches);
        foreach($matches[1] as $id => $url) {
            /* Get the video id */
            preg_match_all('/docid=([0-9-]*)/i', $url, $urlmatches);
            $smarty->assign('videoid', $urlmatches[1][0]);

            /* Get the embed html */
            $html = $smarty->fetch('jojo_googlevideoembed.tpl');
            $content = str_replace($matches[0][$id], $html, $content);
        }
        return $content;
    }
}