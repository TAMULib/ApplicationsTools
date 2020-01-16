<?php
include 'config.php';

    class Cards extends Dbh {
        
        public function theCards($data){
            $getCards = $this->connect()->query("SELECT * FROM cards");
            $cardResults = $getCards->fetchAll();
            $getOptions = $this->connect()->query("SELECT * FROM card_status");
            $optionResults = $getOptions->fetchAll();
                        
            $cardTemplate = '';
                    $i = 1;
                foreach($cardResults as $card) {
                    
                    if($card['location'] == "$data"){
                        $settingsOptions ='';
                        $e = 1;
                        foreach($optionResults as $setting) {
                            $settingsOptions .= '
                                    <li>
                                    <input type="radio" value="'.$setting['id'].'" name="group'.$i.'" '.($card['status'] == $setting['id'] ? 'checked="checked"' : '').' />
                                    <label>'.$setting['status'].'</label>
                                    </li>
                            ';
                            $e++;
                        };
                    
                    $cardTemplate .= '
                    <div class="card" data-column="'.$card['location'].'" id="card-'.$card['id'].'">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 contenteditable="false">'.$card['title'].'</h3>
                            </div>
                            <div class="card-information">
                                <div class="options">
                                     <ul>'.$settingsOptions.'</ul>
                                </div> 
                            </div>
                        </div>
                    </div>';
                    }
                    $i++;
                }
            echo $cardTemplate;
        }
    };

    
        $getCards = new Cards();