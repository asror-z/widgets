<?php

/**
 *
 * Class ZAmchartWidget
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\places\test;


use yii\web\JsExpression;
use zetsoft\system\kernels\ZWidget;

class ZAmchartWidget extends ZWidget
{


  /**
   * Configuration
   */
  public $config = [];
  public $_config = [
      'colorRandom' => false,
      'dots' => true,
      'dotsBlink' => true,
      'colorForEmpty' => true,
      'value' => '',
      'table' => [
          'UZ' => 500,
          'AD' => 500,
          'AE' => 500,
          'AF' => 500,
          'AG' => 500,
          'AI' => 500,
          'AL' => 500,
          'AM' => 500,
          'AO' => 500,
          'AQ' => 500,
          'AR' => 500,
          'AS' => 500,
          'AT' => 500,
          'AU' => 500,
          'AW' => 500,
          'AX' => 500,
          'AZ' => 500,
          'BA' => 500,
          'BB' => 500,
          'BD' => 500,
          'BE' => 500,
          'BF' => 500,
          'BG' => 500,
          'BH' => 500,
          'BI' => 500,
          'BJ' => 500,
          'BL' => 500,
          'BM' => 500,
          'BN' => 500,
          'BO' => 500,
          'BQ' => 500,
          'BR' => 500,
          'BS' => 500,
          'BT' => 500,
          'BV' => 500,
          'BW' => 500,
          'BY' => 500,
          'BZ' => 500,
          'CA' => 500,
          'CC' => 500,
          'CD' => 500,
          'CF' => 500,
          'CG' => 500,
          'CH' => 500,
          'CI' => 500,
          'CK' => 500,
          'CL' => 500,
          'CM' => 500,
          'CN' => 500,
          'CO' => 500,
          'CR' => 500,
          'CU' => 500,
          'CV' => 500,
          'CW' => 500,
          'CX' => 500,
          'CY' => 500,
          'CZ' => 500,
          'DE' => 500,
          'DJ' => 500,
          'DK' => 500,
          'DM' => 500,
          'DO' => 500,
          'DZ' => 500,
          'EC' => 500,
          'EE' => 500,
          'EG' => 500,
          'EH' => 500,
          'ER' => 500,
          'ES' => 500,
          'ET' => 500,
          'FI' => 500,
          'FJ' => 500,
          'FK' => 500,
          'FM' => 500,
          'FO' => 500,
          'FR' => 500,
          'GA' => 500,
          'GB' => 500,
          'GB-CHA' => 500,
          'GD' => 500,
          'GE' => 500,
          'GF' => 500,
          'GG' => 500,
          'GH' => 500,
          'GI' => 500,
          'GL' => 500,
          'GM' => 500,
          'GN' => 500,
          'GP' => 500,
          'GQ' => 500,
          'GR' => 500,
          'GS' => 500,
          'GT' => 500,
          'GU' => 500,
          'GW' => 500,
          'GY' => 500,
          'HK' => 500,
          'HM' => 500,
          'HN' => 500,
          'HR' => 500,
          'HT' => 500,
          'HU' => 500,
          'ID' => 500,
          'IE' => 500,
          'IL' => 500,
          'IM' => 500,
          'IN' => 500,
          'IO' => 500,
          'IQ' => 500,
          'IR' => 500,
          'IS' => 500,
          'IT' => 500,
          'JE' => 500,
          'JM' => 500,
          'JO' => 500,
          'JP' => 500,
          'KE' => 500,
          'KG' => 500,
          'KH' => 500,
          'KI' => 500,
          'KM' => 500,
          'KN' => 500,
          'KP' => 500,
          'KR' => 500,
          'KT' => 500,
          'KW' => 500,
          'KY' => 500,
          'KZ' => 500,
          'LA' => 500,
          'LB' => 500,
          'LC' => 500,
          'LI' => 500,
          'LK' => 500,
          'LR' => 500,
          'LS' => 500,
          'LT' => 500,
          'LU' => 500,
          'LV' => 500,
          'LY' => 500,
          'MA' => 500,
          'MC' => 500,
          'MD' => 500,
          'ME' => 500,
          'MF' => 500,
          'MG' => 500,
          'MH' => 500,
          'MK' => 500,
          'ML' => 500,
          'MM' => 500,
          'MN' => 500,
          'MO' => 500,
          'MP' => 500,
          'MQ' => 500,
          'MR' => 500,
          'MS' => 500,
          'MT' => 500,
          'MU' => 500,
          'MV' => 500,
          'MW' => 500,
          'MX' => 500,
          'MY' => 500,
          'MZ' => 500,
          'NA' => 500,
          'NC' => 500,
          'NE' => 500,
          'NF' => 500,
          'NG' => 500,
          'NI' => 500,
          'NL' => 500,
          'NO' => 500,
          'NP' => 500,
          'NR' => 500,
          'NU' => 500,
          'NZ' => 500,
          'OM' => 500,
          'PA' => 500,
          'PE' => 500,
          'PF' => 500,
          'PG' => 500,
          'PH' => 500,
          'PK' => 500,
          'PL' => 500,
          'PM' => 500,
          'PN' => 500,
          'PR' => 500,
          'PS' => 500,
          'PT' => 500,
          'PW' => 500,
          'PY' => 500,
          'QA' => 500,
          'RE' => 500,
          'RO' => 500,
          'RS' => 500,
          'RU' => 101,
          'RW' => 500,
          'SA' => 500,
          'SB' => 500,
          'SC' => 500,
          'SD' => 500,
          'SE' => 500,
          'SG' => 500,
          'SH' => 500,
          'SI' => 500,
          'SJ' => 500,
          'SK' => 500,
          'SL' => 500,
          'SM' => 500,
          'SN' => 500,
          'SO' => 500,
          'SR' => 500,
          'SS' => 500,
          'ST' => 500,
          'SV' => 500,
          'SX' => 500,
          'SY' => 500,
          'SZ' => 500,
          'TC' => 500,
          'TD' => 500,
          'TF' => 500,
          'TG' => 500,
          'TH' => 500,
          'TJ' => 500,
          'TK' => 500,
          'TL' => 500,
          'TM' => 500,
          'TN' => 500,
          'TO' => 500,
          'TR' => 500,
          'TT' => 500,
          'TV' => 500,
          'TW' => 500,
          'TZ' => 500,
          'UA' => 500,
          'UG' => 500,
          'UM' => 500,
          'US' => 500,
          'UY' => 500,
          'VA' => 500,
          'VC' => 500,
          'VE' => 500,
          'VG' => 500,
          'VI' => 500,
          'VN' => 500,
          'VU' => 500,
          'WF' => 500,
          'WS' => 500,
          'YE' => 500,
          'YT' => 500,
          'ZA' => 500,
          'ZM' => 500,
          'ZW' => 500,
          'XK' => 500,
      ],
      'color' => [
          'UZ' => self::color['dgreen'],
          'AD' => self::color['orange'],
          'AE' => self::color['greenYellow'],
          'AF' => self::color['darkf'],
          'AG' => self::color['gray'],
          'AI' => self::color['gray'],
          'AL' => self::color['goldenRod'],
          'AM' => self::color['gray'],
          'AO' => self::color['tpink'],
          'AQ' => self::color['gray'],
          'AR' => self::color['sgreen'],
          'AS' => self::color['cgreen'],
          'AT' => self::color['sbrown'],
          'AU' => self::color['khaki'],
          'AW' => self::color['gray'],
          'AX' => self::color['orange'],
          'AZ' => self::color['uzpink'],
          'BA' => self::color['uzpink'],
          'BB' => self::color['cgreen'],
          'BD' => self::color['greenYellow'],
          'BE' => self::color['syellow'],
          'BF' => self::color['khaki'],
          'BG' => self::color['khaki'],
          'BH' => self::color['gray'],
          'BI' => self::color['brown'],
          'BJ' => self::color['dred'],
          'BL' => self::color['brown'],
          'BM' => self::color['cgreen'],
          'BN' => self::color['green'],
          'BO' => self::color['gray'],
          'BQ' => self::color['khaki'],
          'BR' => self::color['fred'],
          'BS' => self::color['cgreen'],
          'BT' => self::color['khaki'],
          'BV' => self::color['green'],
          'BW' => self::color['khaki'],
          'BY' => self::color['wblue'],
          'BZ' => self::color['sgreen'],
          'CA' => self::color['sgreen'],
          'CC' => self::color['apink'],
          'CD' => self::color['wbrown'],
          'CF' => self::color['epink'],
          'CG' => self::color['uzpink'],
          'CH' => self::color['sgreen'],
          'CI' => self::color['apink'],
          'CK' => self::color['gray'],
          'CL' => self::color['goldenRod'],
          'CM' => self::color['gray'],
          'CN' => self::color['goldenRod'],
          'CO' => self::color['cgreen'],
          'CR' => self::color['apink'],
          'CU' => self::color['syellow'],
          'CV' => self::color['brown'],
          'CW' => self::color['gray'],
          'CX' => self::color['orange'],
          'CY' => self::color['gray'],
          'CZ' => self::color['syellow'],
          'DE' => self::color['wgrey'],
          'DJ' => self::color['uzpink'],
          'DK' => self::color['gray'],
          'DM' => self::color['orange'],
          'DO' => self::color['lightGreen'],
          'DZ' => self::color['goldenRod'],
          'EC' => self::color['xgreen'],
          'EE' => self::color['apink'],
          'EG' => self::color['syellow'],
          'EH' => self::color['cgreen'],
          'ER' => self::color['greenYellow'],
          'ES' => self::color['brown'],
          'ET' => self::color['iBlue'],
          'FI' => self::color['wgreen'],
          'FJ' => self::color['orange'],
          'FK' => self::color['green'],
          'FM' => self::color['xgreen'],
          'FO' => self::color['orange'],
          'FR' => self::color['darkf'],
          'GA' => self::color['kgreen'],
          'GB' => self::color['uzpink'],
          'GB-CHA' => self::color['brown'],
          'GD' => self::color['green'],
          'GE' => self::color['lightGreen'],
          'GF' => self::color['xgreen'],
          'GG' => self::color['green'],
          'GH' => self::color['xgreen'],
          'GI' => self::color['xgreen'],
          'GL' => self::color['vpink'],
          'GM' => self::color['gray'],
          'GN' => self::color['sbrown'],
          'GP' => self::color['orange'],
          'GQ' => self::color['brown'],
          'GR' => self::color['sbrown'],
          'GS' => self::color['green'],
          'GT' => self::color['dred'],
          'GU' => self::color['green'],
          'GW' => self::color['sgreen'],
          'GY' => self::color['syellow'],
          'HK' => self::color['green'],
          'HM' => self::color['green'],
          'HN' => self::color['ugreen'],
          'HR' => self::color['syellow'],
          'HT' => self::color['orange'],
          'HU' => self::color['brown'],
          'ID' => self::color['dyellow'],
          'IE' => self::color['ggreen'],
          'IL' => self::color['red'],
          'IM' => self::color['apink'],
          'IN' => self::color['epink'],
          'IO' => self::color['brown'],
          'IQ' => self::color['bgreen'],
          'IR' => self::color['tyellow'],
          'IS' => self::color['obrown'],
          'IT' => self::color['khaki'],
          'JE' => self::color['green'],
          'JM' => self::color['apink'],
          'JO' => self::color['gray'],
          'JP' => self::color['khaki'],
          'KE' => self::color['goldenRod'],
          'KG' => self::color['dred'],
          'KH' => self::color['brown'],
          'KI' => self::color['pink'],
          'KM' => self::color['xgreen'],
          'KN' => self::color['xgreen'],
          'KP' => self::color['xgreen'],
          'KR' => self::color['greenYellow'],
          'KT' => self::color['green'],
          'KW' => self::color['gray'],
          'KY' => self::color['gray'],
          'KZ' => self::color['greenYellow'],
          'LA' => self::color['xgreen'],
          'LB' => self::color['lightGreen'],
          'LC' => self::color['xgreen'],
          'LI' => self::color['pink'],
          'LK' => self::color['greenYellow'],
          'LR' => self::color['uzpink'],
          'LS' => self::color['greenYellow'],
          'LT' => self::color['brown'],
          'LU' => self::color['brown'],
          'LV' => self::color['syellow'],
          'LY' => self::color['epink'],
          'MA' => self::color['apink'],
          'MC' => self::color['brown'],
          'MD' => self::color['sgreen'],
          'ME' => self::color['syellow'],
          'MF' => self::color['grey'],
          'MG' => self::color['brown'],
          'MH' => self::color['green'],
          'MK' => self::color['pink'],
          'ML' => self::color['spink'],
          'MM' => self::color['apink'],
          'MN' => self::color['cgreen'],
          'MO' => self::color['green'],
          'MP' => self::color['green'],
          'MQ' => self::color['grey'],
          'MR' => self::color['uzpink'],
          'MS' => self::color['green'],
          'MT' => self::color['cgreen'],
          'MU' => self::color['xgreen'],
          'MV' => self::color['grey'],
          'MW' => self::color['dred'],
          'MX' => self::color['dyellow'],
          'MY' => self::color['lightSkyBlue'],
          'MZ' => self::color['eyellow'],
          'NA' => self::color['xgreen'],
          'NC' => self::color['xgreen'],
          'NE' => self::color['iBlue'],
          'NF' => self::color['pink'],
          'NG' => self::color['iBlue'],
          'NI' => self::color['brown'],
          'NL' => self::color['brown'],
          'NO' => self::color['dbrown'],
          'NP' => self::color['brown'],
          'NR' => self::color['brown'],
          'NU' => self::color['gray'],
          'NZ' => self::color['cgreen'],
          'OM' => self::color['rpink'],
          'PA' => self::color['gray'],
          'PE' => self::color['tred'],
          'PF' => self::color['green'],
          'PG' => self::color['greenYellow'],
          'PH' => self::color['syellow'],
          'PK' => self::color['hred'],
          'PL' => self::color['qgreen'],
          'PM' => self::color['sgreen'],
          'PN' => self::color['gray'],
          'PR' => self::color['syellow'],
          'PS' => self::color['pink'],
          'PT' => self::color['gray'],
          'PW' => self::color['xgreen'],
          'PY' => self::color['brown'],
          'QA' => self::color['gray'],
          'RE' => self::color['gray'],
          'RO' => self::color['uzpink'],
          'RS' => self::color['lightGreen'],
          'RU' => self::color['dyellow'],
          'RW' => self::color['gray'],
          'SA' => self::color['oyellow'],
          'SB' => self::color['gray'],
          'SC' => self::color['gray'],
          'SD' => self::color['reds'],
          'SE' => self::color['ogray'],
          'SG' => self::color['green'],
          'SH' => self::color['green'],
          'SI' => self::color['sgreen'],
          'SJ' => self::color['sgreen'],
          'SK' => self::color['xgreen'],
          'SL' => self::color['gray'],
          'SM' => self::color['syellow'],
          'SN' => self::color['greenYellow'],
          'SO' => self::color['gray'],
          'SR' => self::color['brown'],
          'SS' => self::color['sgreen'],
          'ST' => self::color['xgreen'],
          'SV' => self::color['xgreen'],
          'SX' => self::color['sgreen'],
          'SY' => self::color['lightGreen'],
          'SZ' => self::color['syellow'],
          'TC' => self::color['gray'],
          'TD' => self::color['tgreen'],
          'TF' => self::color['pink'],
          'TG' => self::color['gray'],
          'TH' => self::color['fyelloww'],
          'TJ' => self::color['gray'],
          'TK' => self::color['green'],
          'TL' => self::color['gray'],
          'TM' => self::color['syellow'],
          'TN' => self::color['gray'],
          'TO' => self::color['green'],
          'TR' => self::color['fgreen'],
          'TT' => self::color['pink'],
          'TV' => self::color['brown'],
          'TW' => self::color['brown'],
          'TZ' => self::color['reds'],
          'UA' => self::color['darkf'],
          'UG' => self::color['darkf'],
          'UK' => self::color['agreen'],
          'UM' => self::color['green'],
          'US' => self::color['cPINK'],
          'UY' => self::color['uzpink'],
          'VA' => self::color['gray'],
          'VC' => self::color['brown'],
          'VE' => self::color['wdark'],
          'VG' => self::color['pink'],
          'VI' => self::color['brown'],
          'VN' => self::color['gray'],
          'VU' => self::color['green'],
          'WF' => self::color['gray'],
          'WS' => self::color['cgreen'],
          'YE' => self::color['dred'],
          'YT' => self::color['apink'],
          'ZA' => self::color['dgreen'],
          'ZM' => self::color['egreen'],
          'ZW' => self::color['gray'],
          'XK' => self::color['gray'],
      ],
      'name' => [
      'aa' => 'aa',
      'bb' => 'bb',
      ],


  ];

  /**
   *
   * Plugin Events
   * https://select2.org/programmatic-control/events
   */
  public $event = [];
  public $_event = [
      'hit' => <<<JS
             Swal.fire({
                icon: '',  
                title: name,
                html: table,  
            });
JS

  ];


  /**
   *
   * Constants
   */


  public const color = [
      'apink' => '#f5d4a2',
      'dred' => '#E76A64',
      'wblue' => '#ADECE3',
      'ugreen' => '#E8CA8E',
      'wdark' => '#719695',
      'tred' => '#CDAD74',
      'tpink' => '#068F71',
      'rpink' => '#C09CC9',
      'tyellow' => '#DDDF95',
      'hred' => '#ED5E17',
      'bgreen' => '#BB8518',
      'spink' => '#F1B3F9',
      'kgreen' => '#DBF68D',
      'eyellow' => '#FFCD60',
      'egreen' => '#D8F2A4',
      'wbrown' => '#F49494',
      'tgreen' => '#DAF7A6',
      'reds' => '#F55252',
      'ggreen' => '#c9e4a2',
      'obrown' => '#d9d981',
      'wgreen' => '#c5ee89',
      'iBlue' => '#6ec8ae',
      'red' => '#ff0000',
      'grey' => '#b3b3b3',
      'pink' => '#e60026',
      'vpink' => '#d6bddf',
      'cgreen' => '#d595eb',
      'cPINK' => '#d595eb',
      'sgreen' => '#caea7e',
      'epink' => '#fec6c6',
      'dbrown' => '#fca10d',
    //  'transparent' => 'transparent',
    //   'deep-purple' => '#990099',
      'indigo' => '#7700cc',
    //    'light-grey' => 'light-grey',
      'lightGreen' => '#90EE90',
      'lightSkyBlue' => '#87CEFA',
      'greenYellow' => '#caea7e',
      'green' => '#00cc00',
      'brown' => '#F38C10',
    //  'green' => ' #4dff4d',
      'aliceBlue' => '#F0F8FF',
    //   'light-green' => 'light-green',
      'goldenRod' => '#fefeb3',
      'gray' => '#d9d9d9',
      'qgreen' => '#c4ef97',
      'khaki' => '#f6f86e',
      'fred' => '#efb2b2',
    //     'brown' => ' #da7171',
      'orange' => '#ffa500',
      'deep-orange' => '#ffa500',
    //     'brown' => '#d04949',
    //     'grey' => '#cccccc',
    //     'grey-grey' => 'grey-grey',
    //     'greenYellow' => '#cee11f',
      'black' => '#595959',
    //   'mdb-color' => 'mdb-color',
    //      'grey' => '	 #4d4d4d',
    //     'khaki' => '#F0E68C',
      'syellow' => '#ffff74',
      'fgreen' => '#619164',
      'dgreen' => '#62a567',
      'agreen' => '#89ef91',
      'ogray' => '#d6dfe7',
      'oyellow' => '#c4c0c5',
      'dyellow' => '#e0a9a2',
      'sbrown' => '#976c4e',
      'uzpink' => '#ff9f64',
      'darkf' => '#c098cc',
      'wgrey' => '#c6c1c1',
      'xgreen' => '#a9a118',
      'fyelloww' => '#f1f172',
    /*     'rgba-red-light' => 'rgba-red-light',
         'rgba-pink-light' => 'rgba-pink-light',
         'rgba-purple-light' => 'rgba-purple-light',
         'rgba-indigo-light' => 'rgba-indigo-light',
         'rgba-green-light' => 'rgba-green-light',
         'rgba-brown-light' => 'rgba-brown-light',
         'rgba-green-light' => 'rgba-green-light',
         'rgba-grey-slight' => 'rgba-grey-slight',
         'rgba-stylish-slight' => 'rgba-stylish-slight',
         'rgba-black-slight' => 'rgba-black-slight',
         'rgba-grey-grey-slight' => 'rgba-grey-grey-slight',
         'rgba-grey-slight' => 'rgba-grey-slight',
         'rgba-brown-slight' => 'rgba-brown-slight',
         'rgba-orange-slight' => 'rgba-orange-slight',
         'rgba-green-slight' => 'rgba-green-slight',
         'rgba-gray-slight' => 'rgba-gray-slight',
         'rgba-green-slight' => 'rgba-green-slight',
         'rgba-brown-slight' => 'rgba-brown-slight',
         'rgba-green-slight' => 'rgba-green-slight',
         'rgba-indigo-slight' => 'rgba-indigo-slight',
         'rgba-purple-slight' => 'rgba-purple-slight',
         'rgba-pink-slight' => 'rgba-pink-slight',
         'rgba-red-slight' => 'rgba-red-slight',
         'rgba-grey-slight' => ' rgba-grey-slight',
         'rgba-grey-strong' => 'rgba-grey-strong',
         'rgba-stylish-strong' => 'rgba-stylish-strong',
         'rgba-black-strong' => 'rgba-black-strong',
         'rgba-grey-grey-strong' => 'rgba-grey-grey-strong',
         'rgba-grey-strong' => 'rgba-grey-strong',
         'rgba-brown-strong' => 'rgba-brown-strong',
         'rgba-orange-strong' => 'rgba-orange-strong',
         'rgba-green-strong' => 'rgba-green-strong',
         'rgba-gray-strong' => 'rgba-gray-strong',
         'rgba-green-strong' => 'rgba-green-strong',
         'rgba-brown-strong' => 'rgba-brown-strong',
         'rgba-green-strong' => 'rgba-green-strong',
         'rgba-indigo-strong' => 'rgba-indigo-strong',
         'rgba-purple-strong' => 'rgba-purple-strong',
         'rgba-pink-strong' => 'rgba-pink-strong',
         'rgba-red-strong' => 'rgba-red-strong',
         'rgba-grey-strong' => 'rgba-grey-strong',
         'rgba-grey-light' => 'rgba-grey-light',
         'rgba-stylish-light' => 'rgba-stylish-light',
         'rgba-black-light' => 'rgba-black-light',
         'rgba-grey-grey-light' => 'rgba-grey-grey-light',
         'rgba-grey-light' => 'rgba-grey-light',
         'rgba-gray-light' => 'rgba-gray-light',
         'rgba-green-light' => 'rgba-green-light',
         'rgba-orange-light' => 'rgba-brown-light',
         'sgreen' => '#5eba29',
         'amber-gradient' => 'amber-gradient',
         'purple-gradient' => 'purple-gradient',
         'peach-gradient' => 'peach-gradientt',
         'grey-gradient' => 'grey-gradient',
         'warm-flame-gradient' => 'warm-flame-gradient',
         'night-fade-gradient' => 'night-fade-gradient',
         'spring-warmth-gradient' => 'spring-warmth-gradient',
         'near-moon-gradient' => 'near-moon-gradient',
         'rare-wind-gradient' => 'rare-wind-gradient',
         'morpheus-den-gradient' => 'morpheus-den-gradient',
         'cloudy-knoxville-gradient' => 'cloudy-knoxville-gradient',
         'ripe-malinka-gradient' => 'ripe-malinka-gradient',
         'deep-grey-gradient' => 'deep-grey-gradient',
         'mean-fruit-gradient' => 'mean-fruit-gradient',
         'amy-crisp-gradient' => 'amy-crisp-gradient',
         'heavy-rain-gradient' => 'heavy-rain-gradient',
         'tempting-azure-gradient' => 'tempting-azure-gradient',
         'dusty-grass-gradient' => 'dusty-grass-gradient',
         'frozen-dreams-gradient' => 'frozen-dreams-gradient',
         'winter-neva-gradient' => 'winter-neva-gradient',
         'lady-lips-gradient' => 'lady-lips-gradient',
         'sunny-morning-gradient' => 'sunny-morning-gradient',
         'rainy-ashville-gradient' => 'rainy-ashville-gradient',
         'young-passion-gradient' => 'young-passion-gradient',
         'juicy-peach-gradient' => 'juicy-peach-gradient',*/
  ];


  public function asset()
  {

    $this->fileCss('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.0/dist/sweetalert2.css');

    $this->fileJs('/render/places/ZAmchartWidget/assets/Maps/Amcharts/core.js');
    $this->fileJs('/render/places/ZAmchartWidget/assets/Maps/Amcharts/maps.js');
    $this->fileJs('/render/places/ZAmchartWidget/assets/Maps/Amcharts/worldLow.js');
    $this->fileJs('/render/places/ZAmchartWidget/assets/Maps/Amcharts/animated.js');
    $this->fileJs('https://www.amcharts.com/lib/4/themes/frozen.js');


    $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.0/dist/sweetalert2.all.js');
  }


  public function codes()
  {


    $this->layout = [
        'map' => <<<JS
                  $(function ($) {

                  
        am4core.ready(function() {

// theme begin
            am4core.useTheme(am4themes_animated);
// theme end

// Create map instance
            var chart = am4core.create("chartdiv", am4maps.MapChart);

// Set map definition
            chart.geodata = am4geodata_worldLow;

// Set projection
            chart.projection = new am4maps.projections.Miller();
            
            

            

// Create map polygon series
             var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
    //polygonSeries.exclude = ["AQ"];
    polygonSeries.useGeodata = true;
    polygonSeries.nonScalingStroke = true;
    polygonSeries.strokeWidth = 0.5;
    polygonSeries.calculateVisualCenter = true;
    polygonSeries.appeared = false;
    polygonSeries.applyOnClones = false;
    polygonSeries.autoDispose = false;
    polygonSeries.calculatePercent = false;
    //polygonSeries.calculateVisualCenter = false;
    polygonSeries.clickable = true;
    polygonSeries.contextMenuDisabled = false;
    polygonSeries.disabled = false;
    polygonSeries.draggable = false;
    polygonSeries.exportable = false;
    polygonSeries.fixedWidthGrid = false;
    polygonSeries.hasFocused = false;
    polygonSeries.hidden = false;
    polygonSeries.hoverOnFocus = true;
    polygonSeries.hoverable = false;
    polygonSeries.ignoreBounds = false;
    polygonSeries.ignoreMinMax = false;
    polygonSeries.inert = false;
    polygonSeries.inited = true;
    polygonSeries.interactionsEnabled = true;
    polygonSeries.isActive = true;
    polygonSeries.isDown = true;
    polygonSeries.isDragged = true;
    polygonSeries.isFocused = true;
    polygonSeries.isHover = true;
    polygonSeries.isResized = true;
    polygonSeries.isShowing = false;
    polygonSeries.layoutInvalid = false;
    polygonSeries.measureFailed = false;
    polygonSeries.pixelPerfect = true;
    polygonSeries.resizable = true;
    polygonSeries.rtl = false;
    polygonSeries.sequencedInterpolation = true;
    polygonSeries.setStateOnChildren = true;
    polygonSeries.shouldClone = false;
    polygonSeries.showOnInit = true;
    polygonSeries.showSystemTooltip = true;
    polygonSeries.simplifiedProcessing = false;
    polygonSeries.skipRangeEvent = true;
    polygonSeries.tapToActivate = false;
    polygonSeries.togglable = false;
    polygonSeries.trackable = false;
    polygonSeries.visible = true;
    polygonSeries.wheelable = false;


            

// Make map load polygon (like country nameOn) data from GeoJSON

            polygonSeries.useGeodata = true;
            polygonSeries.mapPolygons.template.nonScalingStroke = true;
            polygonSeries.mapPolygons.template.strokeOpacity = 0.5;
   
            
            // todo  sadfasdf
             polygonSeries.data = {data};
       
              console.log('poligon');
            console.log({data});
       
       //circles 
            
        
        
        
        
// Configure series


            var polygonTemplate = polygonSeries.mapPolygons.template;
            //polygonTemplate.tooltipText = "{name}";
            polygonTemplate.tooltipText = `{name} : \r\n {value}`;
            var names = '{name}';
            
            console.log('nameOn polygon');
            console.log(nameOn);
            
           polygonTemplate.propertyFields.fill = "fill";
            
            var name;                                                         
            polygonTemplate.events.on("hit", function(ev){
                
                var idCountry = ev.target.dataItem.dataContext.id;
                
                name = ev.target.dataItem.dataContext.name;
                var value = ev.target.dataItem.dataContext.value;
                console.log(value);
                var table = ev.target.dataItem.dataContext.table;
                console.log(name);
                if (typeof value !== 'undefined'){
                {hit}
                }
            
            });
            
            
               {dots}
            
            
// Create hover state and set alternative fill color


            

            let linkContainer = chart.createChild(am4core.Container);
            linkContainer.isMeasured = false;
            linkContainer.layout = "horizontal";
            linkContainer.x = am4core.percent(50);
            linkContainer.y = am4core.percent(90);
            linkContainer.horizontalCenter = "middle";

            let equirectangular= linkContainer.createChild(am4core.TextLink);
            equirectangular.margin(10,10,10,10);
            equirectangular.text = "Equirectangular";
            equirectangular.events.on("hit", function(){
                chart.projection = new am4maps.projections.Projection();
            });

            let mercator = linkContainer.createChild(am4core.TextLink);
            mercator.text = "Mercator";
            mercator.margin(10,10,10,10);
            mercator.events.on("hit", function(){
                chart.projection = new am4maps.projections.Mercator();
            });

            let miller = linkContainer.createChild(am4core.TextLink);
            miller.margin(10,10,10,10);
            miller.text = "Miller";
            miller.events.on("hit", function(){
                chart.projection = new am4maps.projections.Miller();
            });

            let eckert = linkContainer.createChild(am4core.TextLink);
            eckert.margin(10,10,10,10);
            eckert.text = "Eckert 6";
            eckert.events.on("hit", function(){
                chart.projection = new am4maps.projections.Eckert6();
            });

            let orthographic = linkContainer.createChild(am4core.TextLink);
            orthographic.margin(10,10,10,10);
            orthographic.text = "Orthographic";
            orthographic.events.on("hit", function(){
                chart.projection = new am4maps.projections.Orthographic();
                chart.panBehavior = "rotateLongLat";
                
            });
            
            
           
             

        
        

       
        });
    });


JS,
        'dots' => <<<JS
           var imageSeries = chart.series.push(new am4maps.MapImageSeries());
             imageSeries.useGeodata = true;
           
            imageSeries.data = {data};
            console.log('images');
            console.log({data});
            //imageSeries.mapImages.template.tooltipText = "{id}";
            imageSeries.dataFields.value = "value";
            
            
            var imageTemplate = imageSeries.mapImages.template;
            imageSeries.mapImages.template.tooltipText = "{name}";
            imageTemplate.nonScaling = true;
        var circle = imageSeries.mapImages.template.createChild(am4core.Circle);
        circle.properties.fill = am4core.color("#4285f4");
        circle.radius = 4;
        circle.fillOpacity = 1;

        /*imageSeries.heatRules.push({
                    "target": circle,
                    "property": "fillOpacity",
                    "min" : 0,
                    "max" : 1,
                });*/
                
         {dotsBlink}       
        
        
        imageTemplate.adapter.add("latitude", function(latitude, target) {
                    var polygon = polygonSeries.getPolygonById(target.dataItem.dataContext.id);
                    if(polygon){
                        return polygon.visualLatitude;
                    }
                    return latitude;
                });
        
        
        imageTemplate.adapter.add("longitude", function(longitude, target) {
                    var polygon = polygonSeries.getPolygonById(target.dataItem.dataContext.id);
                    if(polygon){
                        return polygon.visualLongitude;
                    }
                    return longitude;
                });


        imageTemplate.events.on("hit", function(ev){
                
                var idCountry = ev.target.dataItem.dataContext.id;
                
                var name = ev.target.dataItem.dataContext.name;
                console.log(name);
                var value = ev.target.dataItem.dataContext.value;
                //console.log(value);
                var table = ev.target.dataItem.dataContext.table;
               
                {hit}
            
            });
        
JS,
        'dotsBlink' => <<<JS

                
                
                var circle2 = imageSeries.mapImages.template.createChild(am4core.Circle);
        circle2.radius = 4;
        circle2.properties.fill = am4core.color("#4285f4");
        
               /*imageSeries.heatRules.push({
                    "target": circle2,
                    "property": "fillOpacity",
                    "min" : 0,
                    "max" : 1,
                });*/
        
        //console.log(circle2.fillOpacity);
        
            circle2.events.on("inited", function(event){
              animateBullet(event.target);
            });
        
        function animateBullet(circle) {
            var animation = circle.animate([{ property: "scale", from: 1, to: 6 }, { property: "opacity", from: 1, to: 0 }], 1000, am4core.ease.circleOut);
            animation.events.on("animationended", function(event){
              animateBullet(event.target.object);
            })
        }
JS,
    ];


    //$names = Az::$app->App->eyuf->test->getNames();
    //vdd($this->_config['value']);
    foreach ($this->_config['value'] as $key => $value) {

      if ($this->_config['colorRandom']) {
        $colorKey = array_rand(self::color, 1);
        $color = self::color[$colorKey];
      } else {
        $color = $this->_config['color'][$key];
      }

      $table = $this->_config['table'][$key];
      $name = $this->_config['name'][$key];
      $colorValue = new JsExpression('am4core.color("' . $color . '")');

      if ($this->_config['colorForEmpty']) {
        $colorValue = new JsExpression('am4core.color("' . $color . '")');
      } else {
        if ($value === 0) {

          $colorValue = new JsExpression('am4core.color("#e8e8e8")');
        }
      }


      if ($value === 0)
        continue;

      $this->data[] = [
          'id' => $key,
          'name' => $name,
          'fill' => $colorValue,
          'value' => $value,
          'table' => $table,
      ];
    }


    $this->htm = <<<HTML
        <div id="chartdiv"></div>  ,
 
HTML;


    $data = $this->jscode($this->data);
    //vdd($data);

    $dotsBlink = strtr($this->layout['dotsBlink'], []);

    $dots = strtr($this->layout['dots'], [
        '{data}' => $data,
        '{dotsBlink}' => $this->_config['dotsBlink'] ? $dotsBlink : null,
        '{hit}' => $this->eventCode('hit'),

    ]);

    $this->js = strtr($this->layout['map'], [
        '{data}' => $data,
        '{hit}' => $this->eventCode('hit'),
        '{dots}' => $this->jscode($this->_config['dots'] ? $dots : null)
    ]);


    $this->css = <<<CSS
     #chartdiv {
            width: 100%;
            height: 800px;
        }
        
        .swal2-select{
        display: none!important;
        }
        
      .program_statistic table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
          min-width:500px;
        }
      .program_statistic th{
               background-color: #125188;
               color: #ffffff;
               padding: 6px;
           }
      .program_statistic td, .program_statistic th {
          border: 1px solid #dddddd;
          padding: 13px;
        }

        
        
        
        

CSS;
  }
}
