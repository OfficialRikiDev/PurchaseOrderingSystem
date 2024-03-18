<?php
    class Countries {
        public function curl(){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://restcountries.com/v3.1/all');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);

            $countries = json_decode($result);
            $results = array();
            foreach ($countries as $country) {
                array_push($results, $country->name->common);

                echo "'{$country->name->common}',";
            }

            sort($results);

        }

        public function get(){
            $countries = array('Cyprus','Eritrea','Liberia','Bermuda','Vatican City','Cook Islands','Somalia','Zambia','Venezuela','Turkmenistan','Albania','Croatia','United Kingdom','Sudan','Timor-Leste','Republic of the Congo','Azerbaijan','Kenya','American Samoa','Ivory Coast','Senegal','Vietnam','El Salvador','Afghanistan','Saint Martin','Latvia','Guatemala','Kuwait','São Tomé and Príncipe','Kyrgyzstan','Poland','Guam','Ghana','Lithuania','Armenia','Jersey','Grenada','Tajikistan','Ethiopia','Western Sahara','Morocco','Puerto Rico','Christmas Island','New Zealand','Brunei','French Guiana','Niue','Romania','Svalbard and Jan Mayen','Belarus','Panama','Cameroon','Czechia','Saint Barthélemy','Greece','Mali','Martinique','France','Pakistan','Peru','Barbados','Greenland','Saint Pierre and Miquelon','Chad','Hungary','Comoros','Bangladesh','Tokelau','Fiji','China','Colombia','British Virgin Islands','Algeria','Maldives','Malaysia','Cayman Islands','Spain','Ireland','Estonia','Paraguay','Uruguay','South Africa','Saint Lucia','Vanuatu','Finland','Sweden','British Indian Ocean Territory','Lebanon','United States','Chile','Norfolk Island','Montserrat','Australia','Belize','Guyana','Mongolia','Tuvalu','Dominican Republic','Equatorial Guinea','Saint Kitts and Nevis','Bolivia','Nepal','French Southern and Antarctic Lands','Taiwan','Benin','Bulgaria','Moldova','Isle of Man','Bhutan','Cambodia','Antigua and Barbuda','Haiti','Cape Verde','Georgia','Burundi','Bahamas','Mauritius','Libya','Malawi','Mexico','Eswatini','Papua New Guinea','Dominica','Liechtenstein','Russia','Israel','Singapore','Uganda','Slovakia','Tonga','United Arab Emirates','Mayotte','Suriname','Uzbekistan','Saudi Arabia','Egypt','Italy','Madagascar','New Caledonia','Canada','United States Virgin Islands','Marshall Islands','Mauritania','Gambia','Trinidad and Tobago','Seychelles','Japan','Brazil','Syria','Saint Helena, Ascension and Tristan da Cunha','Tanzania','Andorra','Iran','Togo','Malta','South Korea','Samoa','Germany','Niger','Bouvet Island','Jamaica','Nicaragua','Guinea','Anguilla','Åland Islands','Belgium','Portugal','Denmark','Philippines','Wallis and Futuna','Austria','Guinea-Bissau','Monaco','Namibia','United States Minor Outlying Islands','Costa Rica','Bosnia and Herzegovina','Macau','Mozambique','Réunion','Montenegro','North Korea','Northern Mariana Islands','Ukraine','Iraq','South Georgia','Angola','Sierra Leone','Micronesia','Cuba','Turks and Caicos Islands','Serbia','Ecuador','Faroe Islands','Antarctica','Palestine','Turkey','Kiribati','Kazakhstan','Gibraltar','Iceland','Palau','Qatar','Switzerland','French Polynesia','Pitcairn Islands','Jordan','Myanmar','Thailand','Caribbean Netherlands','Aruba','Guadeloupe','Nigeria','Bahrain','Laos','Cocos (Keeling) Islands','Djibouti','Solomon Islands','Heard Island and McDonald Islands','India','San Marino','Luxembourg','Sint Maarten','Falkland Islands','Central African Republic','Botswana','Curaçao','Guernsey','Norway','Gabon','Zimbabwe','Lesotho','Slovenia','Argentina','Burkina Faso','Yemen','DR Congo','Oman','Indonesia','Nauru','Rwanda','North Macedonia','Kosovo','Netherlands','Tunisia','South Sudan','Honduras','Saint Vincent and the Grenadines','Sri Lanka','Hong Kong');
            sort($countries);
            return $countries;
        }
    }
?>