<?php
/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\consts;


interface ZPlayerWidgetConst
{

    /**
     *
     * Type
     */

    public const Type_Video = 'video';
    public const Type_Audio = 'audio';


    /**
     *
     * Preload
     */

    public const Preload_None = 'none';
    public const Preload_Auto = 'auto';
    public const Preload_Metadata = 'metadata';


    /**
     *
     * Mime types
     */

    public const aMimeType = [
        '3g2' => 'video/3gpp2',
        '3gp' => 'video/3gpp',
        'adp' => 'audio/adpcm',
        'aif' => 'audio/x-aiff',
        'aifc' => 'audio/x-aiff',
        'aiff' => 'audio/x-aiff',
        'asf' => 'video/x-ms-asf',
        'asx' => 'video/x-ms-asf',
        'au' => 'audio/basic',
        'avi' => 'video/x-msvideo',
        'caf' => 'audio/x-caf',
        'dra' => 'audio/vnd.dra',
        'dts' => 'audio/vnd.dts',
        'dtshd' => 'audio/vnd.dts.hd',
        'dvb' => 'video/vnd.dvb.file',
        'ecelp4800' => 'audio/vnd.nuera.ecelp4800',
        'ecelp7470' => 'audio/vnd.nuera.ecelp7470',
        'ecelp9600' => 'audio/vnd.nuera.ecelp9600',
        'f4v' => 'video/x-f4v',
        'flac' => 'audio/x-flac',
        'fli' => 'video/x-fli',
        'flv' => 'video/x-flv',
        'fvt' => 'video/vnd.fvt',
        'h261' => 'video/h261',
        'h263' => 'video/h263',
        'h264' => 'video/h264',
        'jpgm' => 'video/jpm',
        'jpgv' => 'video/jpeg',
        'jpm' => 'video/jpm',
        'kar' => 'audio/midi',
        'lvp' => 'audio/vnd.lucent.voice',
        'm1v' => 'video/mpeg',
        'm2a' => 'audio/mpeg',
        'm2v' => 'video/mpeg',
        'm3a' => 'audio/mpeg',
        'm3u' => 'audio/x-mpegurl',
        'm4a' => 'audio/mp4',
        'm4u' => 'video/vnd.mpegurl',
        'm4v' => 'video/x-m4v',
        'mid' => 'audio/midi',
        'midi' => 'audio/midi',
        'mj2' => 'video/mj2',
        'mjp2' => 'video/mj2',
        'mk3d' => 'video/x-matroska',
        'mka' => 'audio/x-matroska',
        'mks' => 'video/x-matroska',
        'mkv' => 'video/x-matroska',
        'mng' => 'video/x-mng',
        'mov' => 'video/quicktime',
        'movie' => 'video/x-sgi-movie',
        'mp2' => 'audio/mpeg',
        'mp2a' => 'audio/mpeg',
        'mp3' => 'audio/mpeg',
        'mp4' => 'video/mp4',
        'mp4a' => 'audio/mp4',
        'mp4s' => 'application/mp4',
        'mp4v' => 'video/mp4',
        'mpe' => 'video/mpeg',
        'mpeg' => 'video/mpeg',
        'mpg' => 'video/mpeg',
        'mpg4' => 'video/mp4',
        'mpga' => 'audio/mpeg',
        'mxu' => 'video/vnd.mpegurl',
        'oga' => 'audio/ogg',
        'ogg' => 'audio/ogg',
        'ogv' => 'video/ogg',
        'pya' => 'audio/vnd.ms-playready.media.pya',
        'pyv' => 'video/vnd.ms-playready.media.pyv',
        'qt' => 'video/quicktime',
        'ra' => 'audio/x-pn-realaudio',
        'ram' => 'audio/x-pn-realaudio',
        'rip' => 'audio/vnd.rip',
        'rmi' => 'audio/midi',
        'rmp' => 'audio/x-pn-realaudio-plugin',
        's3m' => 'audio/s3m',
        'sil' => 'audio/silk',
        'smv' => 'video/x-smv',
        'snd' => 'audio/basic',
        'spx' => 'audio/ogg',
        'uva' => 'audio/vnd.dece.audio',
        'uvh' => 'video/vnd.dece.hd',
        'uvm' => 'video/vnd.dece.mobile',
        'uvp' => 'video/vnd.dece.pd',
        'uvs' => 'video/vnd.dece.sd',
        'uvu' => 'video/vnd.uvvu.mp4',
        'uvv' => 'video/vnd.dece.video',
        'uvva' => 'audio/vnd.dece.audio',
        'uvvh' => 'video/vnd.dece.hd',
        'uvvm' => 'video/vnd.dece.mobile',
        'uvvp' => 'video/vnd.dece.pd',
        'uvvs' => 'video/vnd.dece.sd',
        'uvvu' => 'video/vnd.uvvu.mp4',
        'uvvv' => 'video/vnd.dece.video',
        'viv' => 'video/vnd.vivo',
        'vob' => 'video/x-ms-vob',
        'wav' => 'audio/x-wav',
        'wax' => 'audio/x-ms-wax',
        'weba' => 'audio/webm',
        'webm' => 'video/webm',
        'webp' => 'image/webp',
        'wm' => 'video/x-ms-wm',
        'wma' => 'audio/x-ms-wma',
        'wmv' => 'video/x-ms-wmv',
        'wmx' => 'video/x-ms-wmx',
        'wvx' => 'video/x-ms-wvx',
        'xm' => 'audio/xm',
    ];

}
