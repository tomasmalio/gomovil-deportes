-- DATABASE GOSPORTS
USE gosports_dev;

-- 
-- Table `country`
-- 
CREATE TABLE IF NOT EXISTS `country` (
	`id` int(11) not null auto_increment,
	`code` varchar(2) not null,
	`name` varchar(100) not null,
	PRIMARY KEY (id)
);

INSERT INTO `country` (`code`,`name`) VALUES ('AF', 'Afghanistan');
INSERT INTO `country` (`code`,`name`) VALUES ('AL', 'Albania');
INSERT INTO `country` (`code`,`name`) VALUES ('DZ', 'Algeria');
INSERT INTO `country` (`code`,`name`) VALUES ('DS', 'American Samoa');
INSERT INTO `country` (`code`,`name`) VALUES ('AD', 'Andorra');
INSERT INTO `country` (`code`,`name`) VALUES ('AO', 'Angola');
INSERT INTO `country` (`code`,`name`) VALUES ('AI', 'Anguilla');
INSERT INTO `country` (`code`,`name`) VALUES ('AQ', 'Antarctica');
INSERT INTO `country` (`code`,`name`) VALUES ('AG', 'Antigua and Barbuda');
INSERT INTO `country` (`code`,`name`) VALUES ('AR', 'Argentina');
INSERT INTO `country` (`code`,`name`) VALUES ('AM', 'Armenia');
INSERT INTO `country` (`code`,`name`) VALUES ('AW', 'Aruba');
INSERT INTO `country` (`code`,`name`) VALUES ('AU', 'Australia');
INSERT INTO `country` (`code`,`name`) VALUES ('AT', 'Austria');
INSERT INTO `country` (`code`,`name`) VALUES ('AZ', 'Azerbaijan');
INSERT INTO `country` (`code`,`name`) VALUES ('BS', 'Bahamas');
INSERT INTO `country` (`code`,`name`) VALUES ('BH', 'Bahrain');
INSERT INTO `country` (`code`,`name`) VALUES ('BD', 'Bangladesh');
INSERT INTO `country` (`code`,`name`) VALUES ('BB', 'Barbados');
INSERT INTO `country` (`code`,`name`) VALUES ('BY', 'Belarus');
INSERT INTO `country` (`code`,`name`) VALUES ('BE', 'Belgium');
INSERT INTO `country` (`code`,`name`) VALUES ('BZ', 'Belize');
INSERT INTO `country` (`code`,`name`) VALUES ('BJ', 'Benin');
INSERT INTO `country` (`code`,`name`) VALUES ('BM', 'Bermuda');
INSERT INTO `country` (`code`,`name`) VALUES ('BT', 'Bhutan');
INSERT INTO `country` (`code`,`name`) VALUES ('BO', 'Bolivia');
INSERT INTO `country` (`code`,`name`) VALUES ('BA', 'Bosnia and Herzegovina');
INSERT INTO `country` (`code`,`name`) VALUES ('BW', 'Botswana');
INSERT INTO `country` (`code`,`name`) VALUES ('BV', 'Bouvet Island');
INSERT INTO `country` (`code`,`name`) VALUES ('BR', 'Brazil');
INSERT INTO `country` (`code`,`name`) VALUES ('IO', 'British Indian Ocean Territory');
INSERT INTO `country` (`code`,`name`) VALUES ('BN', 'Brunei Darussalam');
INSERT INTO `country` (`code`,`name`) VALUES ('BG', 'Bulgaria');
INSERT INTO `country` (`code`,`name`) VALUES ('BF', 'Burkina Faso');
INSERT INTO `country` (`code`,`name`) VALUES ('BI', 'Burundi');
INSERT INTO `country` (`code`,`name`) VALUES ('KH', 'Cambodia');
INSERT INTO `country` (`code`,`name`) VALUES ('CM', 'Cameroon');
INSERT INTO `country` (`code`,`name`) VALUES ('CA', 'Canada');
INSERT INTO `country` (`code`,`name`) VALUES ('CV', 'Cape Verde');
INSERT INTO `country` (`code`,`name`) VALUES ('KY', 'Cayman Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('CF', 'Central African Republic');
INSERT INTO `country` (`code`,`name`) VALUES ('TD', 'Chad');
INSERT INTO `country` (`code`,`name`) VALUES ('CL', 'Chile');
INSERT INTO `country` (`code`,`name`) VALUES ('CN', 'China');
INSERT INTO `country` (`code`,`name`) VALUES ('CX', 'Christmas Island');
INSERT INTO `country` (`code`,`name`) VALUES ('CC', 'Cocos (Keeling) Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('CO', 'Colombia');
INSERT INTO `country` (`code`,`name`) VALUES ('KM', 'Comoros');
INSERT INTO `country` (`code`,`name`) VALUES ('CG', 'Congo');
INSERT INTO `country` (`code`,`name`) VALUES ('CK', 'Cook Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('CR', 'Costa Rica');
INSERT INTO `country` (`code`,`name`) VALUES ('HR', 'Croatia (Hrvatska)');
INSERT INTO `country` (`code`,`name`) VALUES ('CU', 'Cuba');
INSERT INTO `country` (`code`,`name`) VALUES ('CY', 'Cyprus');
INSERT INTO `country` (`code`,`name`) VALUES ('CZ', 'Czech Republic');
INSERT INTO `country` (`code`,`name`) VALUES ('DK', 'Denmark');
INSERT INTO `country` (`code`,`name`) VALUES ('DJ', 'Djibouti');
INSERT INTO `country` (`code`,`name`) VALUES ('DM', 'Dominica');
INSERT INTO `country` (`code`,`name`) VALUES ('DO', 'Dominican Republic');
INSERT INTO `country` (`code`,`name`) VALUES ('TP', 'East Timor');
INSERT INTO `country` (`code`,`name`) VALUES ('EC', 'Ecuador');
INSERT INTO `country` (`code`,`name`) VALUES ('EG', 'Egypt');
INSERT INTO `country` (`code`,`name`) VALUES ('SV', 'El Salvador');
INSERT INTO `country` (`code`,`name`) VALUES ('GQ', 'Equatorial Guinea');
INSERT INTO `country` (`code`,`name`) VALUES ('ER', 'Eritrea');
INSERT INTO `country` (`code`,`name`) VALUES ('EE', 'Estonia');
INSERT INTO `country` (`code`,`name`) VALUES ('ET', 'Ethiopia');
INSERT INTO `country` (`code`,`name`) VALUES ('FK', 'Falkland Islands (Malvinas)');
INSERT INTO `country` (`code`,`name`) VALUES ('FO', 'Faroe Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('FJ', 'Fiji');
INSERT INTO `country` (`code`,`name`) VALUES ('FI', 'Finland');
INSERT INTO `country` (`code`,`name`) VALUES ('FR', 'France');
INSERT INTO `country` (`code`,`name`) VALUES ('FX', 'France, Metropolitan');
INSERT INTO `country` (`code`,`name`) VALUES ('GF', 'French Guiana');
INSERT INTO `country` (`code`,`name`) VALUES ('PF', 'French Polynesia');
INSERT INTO `country` (`code`,`name`) VALUES ('TF', 'French Southern Territories');
INSERT INTO `country` (`code`,`name`) VALUES ('GA', 'Gabon');
INSERT INTO `country` (`code`,`name`) VALUES ('GM', 'Gambia');
INSERT INTO `country` (`code`,`name`) VALUES ('GE', 'Georgia');
INSERT INTO `country` (`code`,`name`) VALUES ('DE', 'Germany');
INSERT INTO `country` (`code`,`name`) VALUES ('GH', 'Ghana');
INSERT INTO `country` (`code`,`name`) VALUES ('GI', 'Gibraltar');
INSERT INTO `country` (`code`,`name`) VALUES ('GK', 'Guernsey');
INSERT INTO `country` (`code`,`name`) VALUES ('GR', 'Greece');
INSERT INTO `country` (`code`,`name`) VALUES ('GL', 'Greenland');
INSERT INTO `country` (`code`,`name`) VALUES ('GD', 'Grenada');
INSERT INTO `country` (`code`,`name`) VALUES ('GP', 'Guadeloupe');
INSERT INTO `country` (`code`,`name`) VALUES ('GU', 'Guam');
INSERT INTO `country` (`code`,`name`) VALUES ('GT', 'Guatemala');
INSERT INTO `country` (`code`,`name`) VALUES ('GN', 'Guinea');
INSERT INTO `country` (`code`,`name`) VALUES ('GW', 'Guinea-Bissau');
INSERT INTO `country` (`code`,`name`) VALUES ('GY', 'Guyana');
INSERT INTO `country` (`code`,`name`) VALUES ('HT', 'Haiti');
INSERT INTO `country` (`code`,`name`) VALUES ('HM', 'Heard and Mc Donald Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('HN', 'Honduras');
INSERT INTO `country` (`code`,`name`) VALUES ('HK', 'Hong Kong');
INSERT INTO `country` (`code`,`name`) VALUES ('HU', 'Hungary');
INSERT INTO `country` (`code`,`name`) VALUES ('IS', 'Iceland');
INSERT INTO `country` (`code`,`name`) VALUES ('IN', 'India');
INSERT INTO `country` (`code`,`name`) VALUES ('IM', 'Isle of Man');
INSERT INTO `country` (`code`,`name`) VALUES ('ID', 'Indonesia');
INSERT INTO `country` (`code`,`name`) VALUES ('IR', 'Iran (Islamic Republic of)');
INSERT INTO `country` (`code`,`name`) VALUES ('IQ', 'Iraq');
INSERT INTO `country` (`code`,`name`) VALUES ('IE', 'Ireland');
INSERT INTO `country` (`code`,`name`) VALUES ('IL', 'Israel');
INSERT INTO `country` (`code`,`name`) VALUES ('IT', 'Italy');
INSERT INTO `country` (`code`,`name`) VALUES ('CI', 'Ivory Coast');
INSERT INTO `country` (`code`,`name`) VALUES ('JE', 'Jersey');
INSERT INTO `country` (`code`,`name`) VALUES ('JM', 'Jamaica');
INSERT INTO `country` (`code`,`name`) VALUES ('JP', 'Japan');
INSERT INTO `country` (`code`,`name`) VALUES ('JO', 'Jordan');
INSERT INTO `country` (`code`,`name`) VALUES ('KZ', 'Kazakhstan');
INSERT INTO `country` (`code`,`name`) VALUES ('KE', 'Kenya');
INSERT INTO `country` (`code`,`name`) VALUES ('KI', 'Kiribati');
INSERT INTO `country` (`code`,`name`) VALUES ('KP', 'Korea, Democratic People''s Republic of');
INSERT INTO `country` (`code`,`name`) VALUES ('KR', 'Korea, Republic of');
INSERT INTO `country` (`code`,`name`) VALUES ('XK', 'Kosovo');
INSERT INTO `country` (`code`,`name`) VALUES ('KW', 'Kuwait');
INSERT INTO `country` (`code`,`name`) VALUES ('KG', 'Kyrgyzstan');
INSERT INTO `country` (`code`,`name`) VALUES ('LA', 'Lao People''s Democratic Republic');
INSERT INTO `country` (`code`,`name`) VALUES ('LV', 'Latvia');
INSERT INTO `country` (`code`,`name`) VALUES ('LB', 'Lebanon');
INSERT INTO `country` (`code`,`name`) VALUES ('LS', 'Lesotho');
INSERT INTO `country` (`code`,`name`) VALUES ('LR', 'Liberia');
INSERT INTO `country` (`code`,`name`) VALUES ('LY', 'Libyan Arab Jamahiriya');
INSERT INTO `country` (`code`,`name`) VALUES ('LI', 'Liechtenstein');
INSERT INTO `country` (`code`,`name`) VALUES ('LT', 'Lithuania');
INSERT INTO `country` (`code`,`name`) VALUES ('LU', 'Luxembourg');
INSERT INTO `country` (`code`,`name`) VALUES ('MO', 'Macau');
INSERT INTO `country` (`code`,`name`) VALUES ('MK', 'Macedonia');
INSERT INTO `country` (`code`,`name`) VALUES ('MG', 'Madagascar');
INSERT INTO `country` (`code`,`name`) VALUES ('MW', 'Malawi');
INSERT INTO `country` (`code`,`name`) VALUES ('MY', 'Malaysia');
INSERT INTO `country` (`code`,`name`) VALUES ('MV', 'Maldives');
INSERT INTO `country` (`code`,`name`) VALUES ('ML', 'Mali');
INSERT INTO `country` (`code`,`name`) VALUES ('MT', 'Malta');
INSERT INTO `country` (`code`,`name`) VALUES ('MH', 'Marshall Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('MQ', 'Martinique');
INSERT INTO `country` (`code`,`name`) VALUES ('MR', 'Mauritania');
INSERT INTO `country` (`code`,`name`) VALUES ('MU', 'Mauritius');
INSERT INTO `country` (`code`,`name`) VALUES ('TY', 'Mayotte');
INSERT INTO `country` (`code`,`name`) VALUES ('MX', 'Mexico');
INSERT INTO `country` (`code`,`name`) VALUES ('FM', 'Micronesia, Federated States of');
INSERT INTO `country` (`code`,`name`) VALUES ('MD', 'Moldova, Republic of');
INSERT INTO `country` (`code`,`name`) VALUES ('MC', 'Monaco');
INSERT INTO `country` (`code`,`name`) VALUES ('MN', 'Mongolia');
INSERT INTO `country` (`code`,`name`) VALUES ('ME', 'Montenegro');
INSERT INTO `country` (`code`,`name`) VALUES ('MS', 'Montserrat');
INSERT INTO `country` (`code`,`name`) VALUES ('MA', 'Morocco');
INSERT INTO `country` (`code`,`name`) VALUES ('MZ', 'Mozambique');
INSERT INTO `country` (`code`,`name`) VALUES ('MM', 'Myanmar');
INSERT INTO `country` (`code`,`name`) VALUES ('NA', 'Namibia');
INSERT INTO `country` (`code`,`name`) VALUES ('NR', 'Nauru');
INSERT INTO `country` (`code`,`name`) VALUES ('NP', 'Nepal');
INSERT INTO `country` (`code`,`name`) VALUES ('NL', 'Netherlands');
INSERT INTO `country` (`code`,`name`) VALUES ('AN', 'Netherlands Antilles');
INSERT INTO `country` (`code`,`name`) VALUES ('NC', 'New Caledonia');
INSERT INTO `country` (`code`,`name`) VALUES ('NZ', 'New Zealand');
INSERT INTO `country` (`code`,`name`) VALUES ('NI', 'Nicaragua');
INSERT INTO `country` (`code`,`name`) VALUES ('NE', 'Niger');
INSERT INTO `country` (`code`,`name`) VALUES ('NG', 'Nigeria');
INSERT INTO `country` (`code`,`name`) VALUES ('NU', 'Niue');
INSERT INTO `country` (`code`,`name`) VALUES ('NF', 'Norfolk Island');
INSERT INTO `country` (`code`,`name`) VALUES ('MP', 'Northern Mariana Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('NO', 'Norway');
INSERT INTO `country` (`code`,`name`) VALUES ('OM', 'Oman');
INSERT INTO `country` (`code`,`name`) VALUES ('PK', 'Pakistan');
INSERT INTO `country` (`code`,`name`) VALUES ('PW', 'Palau');
INSERT INTO `country` (`code`,`name`) VALUES ('PS', 'Palestine');
INSERT INTO `country` (`code`,`name`) VALUES ('PA', 'Panama');
INSERT INTO `country` (`code`,`name`) VALUES ('PG', 'Papua New Guinea');
INSERT INTO `country` (`code`,`name`) VALUES ('PY', 'Paraguay');
INSERT INTO `country` (`code`,`name`) VALUES ('PE', 'Peru');
INSERT INTO `country` (`code`,`name`) VALUES ('PH', 'Philippines');
INSERT INTO `country` (`code`,`name`) VALUES ('PN', 'Pitcairn');
INSERT INTO `country` (`code`,`name`) VALUES ('PL', 'Poland');
INSERT INTO `country` (`code`,`name`) VALUES ('PT', 'Portugal');
INSERT INTO `country` (`code`,`name`) VALUES ('PR', 'Puerto Rico');
INSERT INTO `country` (`code`,`name`) VALUES ('QA', 'Qatar');
INSERT INTO `country` (`code`,`name`) VALUES ('RE', 'Reunion');
INSERT INTO `country` (`code`,`name`) VALUES ('RO', 'Romania');
INSERT INTO `country` (`code`,`name`) VALUES ('RU', 'Russian Federation');
INSERT INTO `country` (`code`,`name`) VALUES ('RW', 'Rwanda');
INSERT INTO `country` (`code`,`name`) VALUES ('KN', 'Saint Kitts and Nevis');
INSERT INTO `country` (`code`,`name`) VALUES ('LC', 'Saint Lucia');
INSERT INTO `country` (`code`,`name`) VALUES ('VC', 'Saint Vincent and the Grenadines');
INSERT INTO `country` (`code`,`name`) VALUES ('WS', 'Samoa');
INSERT INTO `country` (`code`,`name`) VALUES ('SM', 'San Marino');
INSERT INTO `country` (`code`,`name`) VALUES ('ST', 'Sao Tome and Principe');
INSERT INTO `country` (`code`,`name`) VALUES ('SA', 'Saudi Arabia');
INSERT INTO `country` (`code`,`name`) VALUES ('SN', 'Senegal');
INSERT INTO `country` (`code`,`name`) VALUES ('RS', 'Serbia');
INSERT INTO `country` (`code`,`name`) VALUES ('SC', 'Seychelles');
INSERT INTO `country` (`code`,`name`) VALUES ('SL', 'Sierra Leone');
INSERT INTO `country` (`code`,`name`) VALUES ('SG', 'Singapore');
INSERT INTO `country` (`code`,`name`) VALUES ('SK', 'Slovakia');
INSERT INTO `country` (`code`,`name`) VALUES ('SI', 'Slovenia');
INSERT INTO `country` (`code`,`name`) VALUES ('SB', 'Solomon Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('SO', 'Somalia');
INSERT INTO `country` (`code`,`name`) VALUES ('ZA', 'South Africa');
INSERT INTO `country` (`code`,`name`) VALUES ('GS', 'South Georgia South Sandwich Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('SS', 'South Sudan');
INSERT INTO `country` (`code`,`name`) VALUES ('ES', 'Spain');
INSERT INTO `country` (`code`,`name`) VALUES ('LK', 'Sri Lanka');
INSERT INTO `country` (`code`,`name`) VALUES ('SH', 'St. Helena');
INSERT INTO `country` (`code`,`name`) VALUES ('PM', 'St. Pierre and Miquelon');
INSERT INTO `country` (`code`,`name`) VALUES ('SD', 'Sudan');
INSERT INTO `country` (`code`,`name`) VALUES ('SR', 'Suriname');
INSERT INTO `country` (`code`,`name`) VALUES ('SJ', 'Svalbard and Jan Mayen Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('SZ', 'Swaziland');
INSERT INTO `country` (`code`,`name`) VALUES ('SE', 'Sweden');
INSERT INTO `country` (`code`,`name`) VALUES ('CH', 'Switzerland');
INSERT INTO `country` (`code`,`name`) VALUES ('SY', 'Syrian Arab Republic');
INSERT INTO `country` (`code`,`name`) VALUES ('TW', 'Taiwan');
INSERT INTO `country` (`code`,`name`) VALUES ('TJ', 'Tajikistan');
INSERT INTO `country` (`code`,`name`) VALUES ('TZ', 'Tanzania, United Republic of');
INSERT INTO `country` (`code`,`name`) VALUES ('TH', 'Thailand');
INSERT INTO `country` (`code`,`name`) VALUES ('TG', 'Togo');
INSERT INTO `country` (`code`,`name`) VALUES ('TK', 'Tokelau');
INSERT INTO `country` (`code`,`name`) VALUES ('TO', 'Tonga');
INSERT INTO `country` (`code`,`name`) VALUES ('TT', 'Trinidad and Tobago');
INSERT INTO `country` (`code`,`name`) VALUES ('TN', 'Tunisia');
INSERT INTO `country` (`code`,`name`) VALUES ('TR', 'Turkey');
INSERT INTO `country` (`code`,`name`) VALUES ('TM', 'Turkmenistan');
INSERT INTO `country` (`code`,`name`) VALUES ('TC', 'Turks and Caicos Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('TV', 'Tuvalu');
INSERT INTO `country` (`code`,`name`) VALUES ('UG', 'Uganda');
INSERT INTO `country` (`code`,`name`) VALUES ('UA', 'Ukraine');
INSERT INTO `country` (`code`,`name`) VALUES ('AE', 'United Arab Emirates');
INSERT INTO `country` (`code`,`name`) VALUES ('GB', 'United Kingdom');
INSERT INTO `country` (`code`,`name`) VALUES ('US', 'United States');
INSERT INTO `country` (`code`,`name`) VALUES ('UM', 'United States minor outlying islands');
INSERT INTO `country` (`code`,`name`) VALUES ('UY', 'Uruguay');
INSERT INTO `country` (`code`,`name`) VALUES ('UZ', 'Uzbekistan');
INSERT INTO `country` (`code`,`name`) VALUES ('VU', 'Vanuatu');
INSERT INTO `country` (`code`,`name`) VALUES ('VA', 'Vatican City State');
INSERT INTO `country` (`code`,`name`) VALUES ('VE', 'Venezuela');
INSERT INTO `country` (`code`,`name`) VALUES ('VN', 'Vietnam');
INSERT INTO `country` (`code`,`name`) VALUES ('VG', 'Virgin Islands (British)');
INSERT INTO `country` (`code`,`name`) VALUES ('VI', 'Virgin Islands (U.S.)');
INSERT INTO `country` (`code`,`name`) VALUES ('WF', 'Wallis and Futuna Islands');
INSERT INTO `country` (`code`,`name`) VALUES ('EH', 'Western Sahara');
INSERT INTO `country` (`code`,`name`) VALUES ('YE', 'Yemen');
INSERT INTO `country` (`code`,`name`) VALUES ('ZR', 'Zaire');
INSERT INTO `country` (`code`,`name`) VALUES ('ZM', 'Zambia');
INSERT INTO `country` (`code`,`name`) VALUES ('ZW', 'Zimbabwe');


-- 
-- Table `language`
-- 
CREATE TABLE IF NOT EXISTS `language` (
	`id` int(11) not null auto_increment,
	`value` varchar(5) not null,
	`meaning` varchar(200) not null,
	PRIMARY KEY (id)
);

INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_AE', 'Arabic – United Arab Emirates');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_BH', 'Arabic – Bahrain');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_DZ', 'Arabic – Algeria');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_EG', 'Arabic – Egypt');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_IN', 'Arabic – India');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_IQ', 'Arabic – Iraq');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_JO', 'Arabic – Jordan');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_KW', 'Arabic – Kuwait');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_LB', 'Arabic – Lebanon');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_LY', 'Arabic – Libya');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_MA', 'Arabic – Morocco');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_OM', 'Arabic – Oman');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_QA', 'Arabic – Qatar');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_SA', 'Arabic – Saudi Arabia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_SD', 'Arabic – Sudan');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_SY', 'Arabic – Syria');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_TN', 'Arabic – Tunisia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ar_YE', 'Arabic – Yemen');
INSERT INTO `language` (`value`, `meaning`) VALUES ('be_BY', 'Belarusian – Belarus');
INSERT INTO `language` (`value`, `meaning`) VALUES ('bg_BG', 'Bulgarian – Bulgaria');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ca_ES', 'Catalan – Spain');
INSERT INTO `language` (`value`, `meaning`) VALUES ('cs_CZ', 'Czech – Czech Republic');
INSERT INTO `language` (`value`, `meaning`) VALUES ('da_DK', 'Danish – Denmark');
INSERT INTO `language` (`value`, `meaning`) VALUES ('de_AT', 'German – Austria');
INSERT INTO `language` (`value`, `meaning`) VALUES ('de_BE', 'German – Belgium');
INSERT INTO `language` (`value`, `meaning`) VALUES ('de_CH', 'German – Switzerland');
INSERT INTO `language` (`value`, `meaning`) VALUES ('de_DE', 'German – Germany');
INSERT INTO `language` (`value`, `meaning`) VALUES ('de_LU', 'German – Luxembourg');
INSERT INTO `language` (`value`, `meaning`) VALUES ('el_GR', 'Greek – Greece');
INSERT INTO `language` (`value`, `meaning`) VALUES ('en_AU', 'English – Australia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('en_CA', 'English – Canada');
INSERT INTO `language` (`value`, `meaning`) VALUES ('en_GB', 'English – United Kingdom');
INSERT INTO `language` (`value`, `meaning`) VALUES ('en_IN', 'English – India');
INSERT INTO `language` (`value`, `meaning`) VALUES ('en_NZ', 'English – New Zealand');
INSERT INTO `language` (`value`, `meaning`) VALUES ('en_PH', 'English – Philippines');
INSERT INTO `language` (`value`, `meaning`) VALUES ('en_US', 'English – United States');
INSERT INTO `language` (`value`, `meaning`) VALUES ('en_ZA', 'English – South Africa');
INSERT INTO `language` (`value`, `meaning`) VALUES ('en_ZW', 'English – Zimbabwe');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_AR', 'Spanish – Argentina');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_BO', 'Spanish – Bolivia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_CL', 'Spanish – Chile');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_CO', 'Spanish – Colombia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_CR', 'Spanish – Costa Rica');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_DO', 'Spanish – Dominican Republic');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_EC', 'Spanish – Ecuador');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_ES', 'Spanish – Spain');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_GT', 'Spanish – Guatemala');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_HN', 'Spanish – Honduras');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_MX', 'Spanish – Mexico');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_NI', 'Spanish – Nicaragua');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_PA', 'Spanish – Panama');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_PE', 'Spanish – Peru');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_PR', 'Spanish – Puerto Rico');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_PY', 'Spanish – Paraguay');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_SV', 'Spanish – El Salvador');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_US', 'Spanish – United States');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_UY', 'Spanish – Uruguay');
INSERT INTO `language` (`value`, `meaning`) VALUES ('es_VE', 'Spanish – Venezuela');
INSERT INTO `language` (`value`, `meaning`) VALUES ('et_EE', 'Estonian – Estonia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('eu_ES', 'Basque – Basque');
INSERT INTO `language` (`value`, `meaning`) VALUES ('fi_FI', 'Finnish – Finland');
INSERT INTO `language` (`value`, `meaning`) VALUES ('fo_FO', 'Faroese – Faroe Islands');
INSERT INTO `language` (`value`, `meaning`) VALUES ('fr_BE', 'French – Belgium');
INSERT INTO `language` (`value`, `meaning`) VALUES ('fr_CA', 'French – Canada');
INSERT INTO `language` (`value`, `meaning`) VALUES ('fr_CH', 'French – Switzerland');
INSERT INTO `language` (`value`, `meaning`) VALUES ('fr_FR', 'French – France');
INSERT INTO `language` (`value`, `meaning`) VALUES ('fr_LU', 'French – Luxembourg');
INSERT INTO `language` (`value`, `meaning`) VALUES ('gl_ES', 'Galician – Spain');
INSERT INTO `language` (`value`, `meaning`) VALUES ('gu_IN', 'Gujarati – India');
INSERT INTO `language` (`value`, `meaning`) VALUES ('he_IL', 'Hebrew – Israel');
INSERT INTO `language` (`value`, `meaning`) VALUES ('hi_IN', 'Hindi – India');
INSERT INTO `language` (`value`, `meaning`) VALUES ('hr_HR', 'Croatian – Croatia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('hu_HU', 'Hungarian – Hungary');
INSERT INTO `language` (`value`, `meaning`) VALUES ('id_ID', 'Indonesian – Indonesia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('is_IS', 'Icelandic – Iceland');
INSERT INTO `language` (`value`, `meaning`) VALUES ('it_CH', 'Italian – Switzerland');
INSERT INTO `language` (`value`, `meaning`) VALUES ('it_IT', 'Italian – Italy');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ja_JP', 'Japanese – Japan');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ko_KR', 'Korean – Republic of Korea');
INSERT INTO `language` (`value`, `meaning`) VALUES ('lt_LT', 'Lithuanian – Lithuania');
INSERT INTO `language` (`value`, `meaning`) VALUES ('lv_LV', 'Latvian – Latvia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('mk_MK', 'Macedonian – FYROM');
INSERT INTO `language` (`value`, `meaning`) VALUES ('mn_MN', 'Mongolia – Mongolian');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ms_MY', 'Malay – Malaysia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('nb_NO', 'Norwegian(Bokmål) – Norway');
INSERT INTO `language` (`value`, `meaning`) VALUES ('nl_BE', 'Dutch – Belgium');
INSERT INTO `language` (`value`, `meaning`) VALUES ('nl_NL', 'Dutch – The Netherlands');
INSERT INTO `language` (`value`, `meaning`) VALUES ('no_NO', 'Norwegian – Norway');
INSERT INTO `language` (`value`, `meaning`) VALUES ('pl_PL', 'Polish – Poland');
INSERT INTO `language` (`value`, `meaning`) VALUES ('pt_BR', 'Portugese – Brazil');
INSERT INTO `language` (`value`, `meaning`) VALUES ('pt_PT', 'Portugese – Portugal');
INSERT INTO `language` (`value`, `meaning`) VALUES ('rm_CH', 'Romansh – Switzerland');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ro_RO', 'Romanian – Romania');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ru_RU', 'Russian – Russia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ru_UA', 'Russian – Ukraine');
INSERT INTO `language` (`value`, `meaning`) VALUES ('sk_SK', 'Slovak – Slovakia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('sl_SI', 'Slovenian – Slovenia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('sq_AL', 'Albanian – Albania');
INSERT INTO `language` (`value`, `meaning`) VALUES ('sr_RS', 'Serbian – Yugoslavia');
INSERT INTO `language` (`value`, `meaning`) VALUES ('sv_FI', 'Swedish – Finland');
INSERT INTO `language` (`value`, `meaning`) VALUES ('sv_SE', 'Swedish – Sweden');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ta_IN', 'Tamil – India');
INSERT INTO `language` (`value`, `meaning`) VALUES ('te_IN', 'Telugu – India');
INSERT INTO `language` (`value`, `meaning`) VALUES ('th_TH', 'Thai – Thailand');
INSERT INTO `language` (`value`, `meaning`) VALUES ('tr_TR', 'Turkish – Turkey');
INSERT INTO `language` (`value`, `meaning`) VALUES ('uk_UA', 'Ukrainian – Ukraine');
INSERT INTO `language` (`value`, `meaning`) VALUES ('ur_PK', 'Urdu – Pakistan');
INSERT INTO `language` (`value`, `meaning`) VALUES ('vi_VN', 'Vietnamese – Viet Nam');
INSERT INTO `language` (`value`, `meaning`) VALUES ('zh_CN', 'Chinese – China');
INSERT INTO `language` (`value`, `meaning`) VALUES ('zh_HK', 'Chinese – Hong Kong');
INSERT INTO `language` (`value`, `meaning`) VALUES ('zh_TW', 'Chinese – Taiwan Province of China');
-- 
-- Table `client`
-- 
CREATE TABLE IF NOT EXISTS `client`
(
	`id` int not null auto_increment,
	`name` VARCHAR(100) not null,
	`cname` VARCHAR(50) not null,
	`url` VARCHAR(255) not null,
	`title` VARCHAR(150) not null,
	`description` VARCHAR(255) not null,
	`image` VARCHAR(255) not null,
	`keywords` VARCHAR(255) not null,
	`country_id` int null,
	`language_id` int null,
	`ssl` int not null,
	`logo` VARCHAR(255) null,
	`google_analytics` VARCHAR(100) null,
	`facebook_app_id` VARCHAR(100) null,
	`facebook_secret` VARCHAR(100) null,
	`status` int(1) not null default 0,
	PRIMARY KEY (id),
	FOREIGN KEY client_fk_country(`country_id`) REFERENCES country(`id`),
	FOREIGN KEY client_fk_language(`language_id`) REFERENCES language(`id`)
);

-- 
-- Table `client_profile`
-- 
CREATE TABLE IF NOT EXISTS `client_profile`
(
	`id` int not null auto_increment,
	`client_id` int null,
	`facebook` varchar(150) null,
	`twitter` varchar(150) null,
	`instagram` varchar(150) null,
	`google_plus` varchar(150) null,
	`youtube` varchar(150) null,
	PRIMARY KEY (id),
	FOREIGN KEY client_profile_fk_client(`client_id`) REFERENCES client(`id`)
);

-- 
-- Table `customization`
-- 
CREATE TABLE IF NOT EXISTS `customization`
(
	`id` int not null auto_increment,
	`client_id` int null,
	`color_primary` char(7) null,
	`color_primary_hover` char(7) null,
	`color_primary_active` char(7) null,
	`color_second` char(7) null,
	`color_second_hover` char(7) null,
	`color_second_active` char(7) null,
	`color_third` char(7) null,
	`color_third_hover` char(7) null,
	`color_third_active` char(7) null,
	`color_quarter` char(7) null,
	`color_quarter_hover` char(7) null,
	`color_quarter_active` char(7) null,
	`color_fifth` char(7) null,
	`color_fifth_hover` char(7) null,
	`color_fifth_active` char(7) null,
	`color_sixth` char(7) null,
	`color_sixth_hover` char(7) null,
	`color_sixth_active` char(7) null,
	`color_seventh` char(7) null,
	`color_seventh_hover` char(7) null,
	`color_seventh_active` char(7) null,
	`color_eighth` char(7) null,
	`color_eighth_hover` char(7) null,
	`color_eighth_active` char(7) null,
	`color_nineth` char(7) null,
	`color_nineth_hover` char(7) null,
	`color_nineth_active` char(7) null,
	`color_tenth` char(7) null,
	`color_tenth_hover` char(7) null,
	`color_tenth_active` char(7) null,
	`color_facebook` char(7) null default '#4267b2',
	`color_twitter` char(7) null default '#1DA1F2',
	`color_spotify` char(7) null default '#1ED760',
	`color_googleplus` char(7) null default '#dd4b39',
	`color_youtube` char(7) null default '#ff0000',
	`color_instagram` char(7) null default '#c13584',
	`h1_font_family` varchar(100) not null,
	`h1_font_weight` varchar(100) not null default 'normal',
	`h1_font_size` varchar(100) not null,
	`h1_font_size_responsive` varchar(100) not null,
	`h2_font_family` varchar(100) not null,
	`h2_font_weight` varchar(100) not null default 'normal',
	`h2_font_size` varchar(100) not null,
	`h2_font_size_responsive` varchar(100) not null,
	`h3_font_family` varchar(100) not null,
	`h3_font_weight` varchar(100) not null default 'normal',
	`h3_font_size` varchar(100) not null,
	`h3_font_size_responsive` varchar(100) not null,
	`p_font_family` varchar(100) not null,
	`p_font_weight` varchar(100) not null default 'normal',
	`p_font_size` varchar(100) not null,
	`p_font_size_responsive` varchar(100) not null,
	`button_font_family` varchar(100) not null,
	`button_font_weight` varchar(100) not null default 'normal',
	`button_font_size` varchar(100) not null,
	`button_font_size_responsive` varchar(100) not null,
	`status` int(1) not null,
	PRIMARY KEY (id),
	FOREIGN KEY customization_fk_client(`client_id`) REFERENCES client(`id`)
);

-- 
-- Table `section`
-- 
CREATE TABLE IF NOT EXISTS `section`
(
	`id` int not null auto_increment,
	`name` int null,
	`datetime` datetime not null,
	`status` int(1) not null default 0,
	PRIMARY KEY (id)
);

-- 
-- Table `layout`
-- 
CREATE TABLE IF NOT EXISTS `layout`
(
	`id` int not null auto_increment,
	`name` varchar(100) not null,
	`image` varchar(255) null,
	`status` int(1) not null default 0,
	PRIMARY KEY (id)
);

-- 
-- Table `content`
-- 
CREATE TABLE IF NOT EXISTS `content`
(
	`id` int not null auto_increment,
	`name` varchar(100) not null,
	`data` text null,
	`status` int(1) not null default 0,
	PRIMARY KEY (id)
);

-- 
-- Table `section_client`
-- 
CREATE TABLE IF NOT EXISTS `section_client`
(
	`id` int not null auto_increment,
	`client_id` int not null,
	`section_id` int not null,
	`layout_id` int not null,
	`content_id` int not null,
	`parent_id` int null,
	`view_name` varchar(100) not null,
	`title` varchar(255) not null,
	`description` varchar(255) not null,
	`image` varchar(255) not null,
	`security` int(1) not null default 0,
	`datetime` datetime not null,
	`status` int(1) not null default 0,
	PRIMARY KEY (id),
	FOREIGN KEY section_client_fk_client(`client_id`) REFERENCES client(`id`),
	FOREIGN KEY section_client_fk_layout(`layout_id`) REFERENCES layout(`id`),
	FOREIGN KEY section_client_fk_content(`content_id`) REFERENCES content(`id`),
	FOREIGN KEY section_client_fk_section_client(`parent_id`) REFERENCES section_client(`id`)
);

-- 
-- Table `extension`
-- 
CREATE TABLE IF NOT EXISTS `extension`
(
	`id` int not null auto_increment,
	`name` varchar(100) not null,
	`datetime` datetime not null,
	`directory` varchar(200) not null,
	`status` int(1) not null default 0,
	PRIMARY KEY (id)
);

-- 
-- Table `section_extension`
-- 
CREATE TABLE IF NOT EXISTS `section_extension`
(
	`section_client_id` int not null,
	`extension_id` int not null,
	`position` int not null,
	`params` text null,
	`status` int(1) not null default 0,
	FOREIGN KEY section_extension_fk_section_client(`section_client_id`) REFERENCES section_client(`id`),
	FOREIGN KEY section_extension_fk_extension(`extension_id`) REFERENCES extension(`id`)
);