<?php

return [
    'encoding' => 'UTF-8',
    'finalize' => true,
    'ignoreNonStrings' => false,
    'cachePath' => storage_path('app/purifier'),
    'cacheFileMode' => 0755,
    'settings' => [
        /**
         * Profile for Quill rich-text editor output.
         * Allows common formatting tags produced by Quill while blocking
         * any executable content (script, iframe, on* attributes, etc.).
         */
        'quill' => [
            'HTML.Doctype' => 'XHTML 1.0 Transitional',
            'HTML.Allowed' => 'h1,h2,h3,h4,h5,h6,'.
                'p[style],br,hr,'.
                'strong,b,em,i,u,s,del,sub,sup,'.
                'ul,ol,li,'.
                'blockquote,'.
                'pre,code,'.
                'a[href|title|target|rel],'.
                'img[src|alt|width|height|class],'.
                'span[style|class],div[style|class],'.
                'table,thead,tbody,tr,th[scope],td',
            'HTML.SafeIframe' => false,
            'HTML.DefinitionID' => 'quill-editor',
            'HTML.DefinitionRev' => 1,
            'CSS.AllowedProperties' => 'color,background-color,text-align,font-size,font-weight,'.
                'font-style,text-decoration,padding-left,margin-left,'.
                'white-space',
            'Attr.AllowedFrameTargets' => ['_blank'],
            'Attr.AllowedRel' => 'noopener noreferrer',
            'AutoFormat.RemoveEmpty' => true,
            'AutoFormat.Linkify' => false,
            'Output.TidyFormat' => false,
        ],
    ],
];
