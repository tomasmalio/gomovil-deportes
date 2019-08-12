<?php
	/**
	 * Google-News feed parser and JSON provider Class
	 * Github <https://github.com/tomasmalio>
	 * 
	 * @author Tomas Malio <tomasmalio@gmail.com>
	 */
	class ModelNewsGoogle {
		// Google news url RSS
		public $url = 'https://news.google.com/rss/news?q=';
		// Keyword to get info
		public $searchQuery = 'Good News';
		// Number of news to get
		public $numberOfNews;
		// Country code
		public $countryCode = 'AR';
		// Language
		public $language = 'es';
		// News always with image
		public $newsWithImages = false;

		public function model ($params = []) {
			self::setSearchQuery($params['search']);
			self::setNumberOfNews($params['numberOfNews']);
			self::setNewsWithImages($params['newsWithImages']);
			self::setCountryCode(self::countryCode($params['country']));
			self::setLanguage($params['language']);

			return json_decode(self::getNews(), true);
		}

		public function setSearchQuery ($searchQuery) {
			if (!empty($searchQuery)) {
				$this->searchQuery = $searchQuery;
			}		
		}

		public function setNumberOfNews ($numberOfNews) {
			if (!empty($numberOfNews)) {
				$this->numberOfNews = (int) $numberOfNews;
			}
		}
		public function setNewsWithImages ($newsWithImages) {
			if ($newsWithImages) {
				$this->newsWithImages = $newsWithImages;
			}
		}

		public function setCountryCode ($countryCode) {
			if (!empty($countryCode)) {
				$this->countryCode = $countryCode;
			}		
		}

		public function setLanguage ($language) {
			if (!empty($language)) {
				$this->language = $language;
			}		
		}

		public function getNews () {
			return $this->processNews();
		}

		private function processNews() {
			$rss = simplexml_load_file($this->url . $this->searchQuery.'&hl='.$this->language.'&gl='.$this->countryCode.'&ceid='.$this->countryCode.':'.$this->language);
			$namespaces = $rss->getNamespaces(true);
			
			$news = [];
			$i = 0;
			$withImages = 0;
			foreach ($rss->channel->item as $item) {
				$media_content = $item->children($namespaces['media']);

				foreach($media_content as $j){
					$image = (string)$j->attributes()->url;
				}

				// Formating the news content
				$description = (explode('<p>', $item->description))[1];
				$source =  explode('<p>', str_replace('<font color="#6f6f6f">', '</font>', (explode('<font color="#6f6f6f">', $item->description))[1]));
				$source = $source[0];
				$title = (string)$item->title;
				$pos = strpos($item->title, $source);
				if ($pos !== false) {
					$title = (string)$item->title;
				} else {
					// $array = explode(' - '.$source, $title);
					echo $source;
					echo strlen($source);
					$title = substr_replace($title, '', -3);
					$replace = [' - ', ' | ', (string)$source, $$source];
					$replacement = ['', '', '', ''];
					$title = str_replace($replace, $replacement, $title);
					// $title = str_replace(array(' - ', ' | '), array('', ''), $title);
					echo $title;
					exit;
				}

				/**
				 * Generate the array with the info
				 * 
				 * It's important that if newsWithImages it's set in true and the news received
				 * doesn't have image, the array is not going to be added.
				 **/
				if ((isset($this->newsWithImages) && $this->newsWithImages && $image) || !isset($this->newsWithImages)) {
					$news[$i]['id'] = (string)$item->guid;
					$news[$i]['title'] = $title;
					$news[$i]['description'] = $description;
					$news[$i]['image'] = $image;
					$news[$i]['source'] = $source;
					$news[$i]['link'] = (string)$item->link;
					$news[$i]['datetime'] = date('Y-m-d H:i:s', strtotime($item->pubDate));
					$i++;
				}
				
				if ($i == $this->numberOfNews){
					break;
				}
				unset($image);
			}
			return json_encode($news);
		}

		private function countryCode ($country) {
			$countryList = [
				'AF' => 'Afghanistan',
				'AX' => 'Aland Islands',
				'AL' => 'Albania',
				'DZ' => 'Algeria',
				'AS' => 'American Samoa',
				'AD' => 'Andorra',
				'AO' => 'Angola',
				'AI' => 'Anguilla',
				'AQ' => 'Antarctica',
				'AG' => 'Antigua and Barbuda',
				'AR' => 'Argentina',
				'AM' => 'Armenia',
				'AW' => 'Aruba',
				'AU' => 'Australia',
				'AT' => 'Austria',
				'AZ' => 'Azerbaijan',
				'BS' => 'Bahamas the',
				'BH' => 'Bahrain',
				'BD' => 'Bangladesh',
				'BB' => 'Barbados',
				'BY' => 'Belarus',
				'BE' => 'Belgium',
				'BZ' => 'Belize',
				'BJ' => 'Benin',
				'BM' => 'Bermuda',
				'BT' => 'Bhutan',
				'BO' => 'Bolivia',
				'BA' => 'Bosnia and Herzegovina',
				'BW' => 'Botswana',
				'BV' => 'Bouvet Island (Bouvetoya)',
				'BR' => 'Brazil',
				'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
				'VG' => 'British Virgin Islands',
				'BN' => 'Brunei Darussalam',
				'BG' => 'Bulgaria',
				'BF' => 'Burkina Faso',
				'BI' => 'Burundi',
				'KH' => 'Cambodia',
				'CM' => 'Cameroon',
				'CA' => 'Canada',
				'CV' => 'Cape Verde',
				'KY' => 'Cayman Islands',
				'CF' => 'Central African Republic',
				'TD' => 'Chad',
				'CL' => 'Chile',
				'CN' => 'China',
				'CX' => 'Christmas Island',
				'CC' => 'Cocos (Keeling) Islands',
				'CO' => 'Colombia',
				'KM' => 'Comoros the',
				'CD' => 'Congo',
				'CG' => 'Congo the',
				'CK' => 'Cook Islands',
				'CR' => 'Costa Rica',
				'CI' => 'Cote d\'Ivoire',
				'HR' => 'Croatia',
				'CU' => 'Cuba',
				'CY' => 'Cyprus',
				'CZ' => 'Czech Republic',
				'DK' => 'Denmark',
				'DJ' => 'Djibouti',
				'DM' => 'Dominica',
				'DO' => 'Dominican Republic',
				'EC' => 'Ecuador',
				'EG' => 'Egypt',
				'SV' => 'El Salvador',
				'GQ' => 'Equatorial Guinea',
				'ER' => 'Eritrea',
				'EE' => 'Estonia',
				'ET' => 'Ethiopia',
				'FO' => 'Faroe Islands',
				'FK' => 'Falkland Islands (Malvinas)',
				'FJ' => 'Fiji the Fiji Islands',
				'FI' => 'Finland',
				'FR' => 'France, French Republic',
				'GF' => 'French Guiana',
				'PF' => 'French Polynesia',
				'TF' => 'French Southern Territories',
				'GA' => 'Gabon',
				'GM' => 'Gambia the',
				'GE' => 'Georgia',
				'DE' => 'Germany',
				'GH' => 'Ghana',
				'GI' => 'Gibraltar',
				'GR' => 'Greece',
				'GL' => 'Greenland',
				'GD' => 'Grenada',
				'GP' => 'Guadeloupe',
				'GU' => 'Guam',
				'GT' => 'Guatemala',
				'GG' => 'Guernsey',
				'GN' => 'Guinea',
				'GW' => 'Guinea-Bissau',
				'GY' => 'Guyana',
				'HT' => 'Haiti',
				'HM' => 'Heard Island and McDonald Islands',
				'VA' => 'Holy See (Vatican City State)',
				'HN' => 'Honduras',
				'HK' => 'Hong Kong',
				'HU' => 'Hungary',
				'IS' => 'Iceland',
				'IN' => 'India',
				'ID' => 'Indonesia',
				'IR' => 'Iran',
				'IQ' => 'Iraq',
				'IE' => 'Ireland',
				'IM' => 'Isle of Man',
				'IL' => 'Israel',
				'IT' => 'Italy',
				'JM' => 'Jamaica',
				'JP' => 'Japan',
				'JE' => 'Jersey',
				'JO' => 'Jordan',
				'KZ' => 'Kazakhstan',
				'KE' => 'Kenya',
				'KI' => 'Kiribati',
				'KP' => 'Korea',
				'KR' => 'Korea',
				'KW' => 'Kuwait',
				'KG' => 'Kyrgyz Republic',
				'LA' => 'Lao',
				'LV' => 'Latvia',
				'LB' => 'Lebanon',
				'LS' => 'Lesotho',
				'LR' => 'Liberia',
				'LY' => 'Libyan Arab Jamahiriya',
				'LI' => 'Liechtenstein',
				'LT' => 'Lithuania',
				'LU' => 'Luxembourg',
				'MO' => 'Macao',
				'MK' => 'Macedonia',
				'MG' => 'Madagascar',
				'MW' => 'Malawi',
				'MY' => 'Malaysia',
				'MV' => 'Maldives',
				'ML' => 'Mali',
				'MT' => 'Malta',
				'MH' => 'Marshall Islands',
				'MQ' => 'Martinique',
				'MR' => 'Mauritania',
				'MU' => 'Mauritius',
				'YT' => 'Mayotte',
				'MX' => 'Mexico',
				'FM' => 'Micronesia',
				'MD' => 'Moldova',
				'MC' => 'Monaco',
				'MN' => 'Mongolia',
				'ME' => 'Montenegro',
				'MS' => 'Montserrat',
				'MA' => 'Morocco',
				'MZ' => 'Mozambique',
				'MM' => 'Myanmar',
				'NA' => 'Namibia',
				'NR' => 'Nauru',
				'NP' => 'Nepal',
				'AN' => 'Netherlands Antilles',
				'NL' => 'Netherlands the',
				'NC' => 'New Caledonia',
				'NZ' => 'New Zealand',
				'NI' => 'Nicaragua',
				'NE' => 'Niger',
				'NG' => 'Nigeria',
				'NU' => 'Niue',
				'NF' => 'Norfolk Island',
				'MP' => 'Northern Mariana Islands',
				'NO' => 'Norway',
				'OM' => 'Oman',
				'PK' => 'Pakistan',
				'PW' => 'Palau',
				'PS' => 'Palestinian Territory',
				'PA' => 'Panama',
				'PG' => 'Papua New Guinea',
				'PY' => 'Paraguay',
				'PE' => 'Peru',
				'PH' => 'Philippines',
				'PN' => 'Pitcairn Islands',
				'PL' => 'Poland',
				'PT' => 'Portugal, Portuguese Republic',
				'PR' => 'Puerto Rico',
				'QA' => 'Qatar',
				'RE' => 'Reunion',
				'RO' => 'Romania',
				'RU' => 'Russian Federation',
				'RW' => 'Rwanda',
				'BL' => 'Saint Barthelemy',
				'SH' => 'Saint Helena',
				'KN' => 'Saint Kitts and Nevis',
				'LC' => 'Saint Lucia',
				'MF' => 'Saint Martin',
				'PM' => 'Saint Pierre and Miquelon',
				'VC' => 'Saint Vincent and the Grenadines',
				'WS' => 'Samoa',
				'SM' => 'San Marino',
				'ST' => 'Sao Tome and Principe',
				'SA' => 'Saudi Arabia',
				'SN' => 'Senegal',
				'RS' => 'Serbia',
				'SC' => 'Seychelles',
				'SL' => 'Sierra Leone',
				'SG' => 'Singapore',
				'SK' => 'Slovakia (Slovak Republic)',
				'SI' => 'Slovenia',
				'SB' => 'Solomon Islands',
				'SO' => 'Somalia, Somali Republic',
				'ZA' => 'South Africa',
				'GS' => 'South Georgia and the South Sandwich Islands',
				'ES' => 'Spain',
				'LK' => 'Sri Lanka',
				'SD' => 'Sudan',
				'SR' => 'Suriname',
				'SJ' => 'Svalbard & Jan Mayen Islands',
				'SZ' => 'Swaziland',
				'SE' => 'Sweden',
				'CH' => 'Switzerland, Swiss Confederation',
				'SY' => 'Syrian Arab Republic',
				'TW' => 'Taiwan',
				'TJ' => 'Tajikistan',
				'TZ' => 'Tanzania',
				'TH' => 'Thailand',
				'TL' => 'Timor-Leste',
				'TG' => 'Togo',
				'TK' => 'Tokelau',
				'TO' => 'Tonga',
				'TT' => 'Trinidad and Tobago',
				'TN' => 'Tunisia',
				'TR' => 'Turkey',
				'TM' => 'Turkmenistan',
				'TC' => 'Turks and Caicos Islands',
				'TV' => 'Tuvalu',
				'UG' => 'Uganda',
				'UA' => 'Ukraine',
				'AE' => 'United Arab Emirates',
				'GB' => 'United Kingdom',
				'US' => 'United States of America',
				'UM' => 'United States Minor Outlying Islands',
				'VI' => 'United States Virgin Islands',
				'UY' => 'Uruguay, Eastern Republic of',
				'UZ' => 'Uzbekistan',
				'VU' => 'Vanuatu',
				'VE' => 'Venezuela',
				'VN' => 'Vietnam',
				'WF' => 'Wallis and Futuna',
				'EH' => 'Western Sahara',
				'YE' => 'Yemen',
				'ZM' => 'Zambia',
				'ZW' => 'Zimbabwe'
			];

			foreach ($countryList as $key => $value) {
				if ($value === $country) {
					return $key;
				}
			}
		}
	}
?>