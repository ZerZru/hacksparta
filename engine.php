<head>
    <style>
        body, html {
            font-family:'Verdana';
        }
    </style>
</head>

<?php
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $info = $_POST['info'];
        $pass = $_POST['pass'];
        $tpass = "HapoiwopdBWoh13525o7";

        if($pass!=$tpass) {
            die("Неправильный код доступа");
        };

        if(file_exists("data/$id.json")) {
            $json1 = file_get_contents('gotted_users.json');
            $jsonIterator = new RecursiveIteratorIterator(
                new RecursiveArrayIterator(json_decode($json1, TRUE)),
                RecursiveIteratorIterator::SELF_FIRST);

            foreach ($jsonIterator as $key => $val) {
                if(is_array($val)) {
                    echo '';
                } else {
                    echo "Про этого игрока уже была получена информация от $val. <a href='lib/players/$id.html'>Посмотреть</a><br>";
                };
            };
        } else {
            file_put_contents("data/$id.json", $info);

            date_default_timezone_set('UTC');
            $date = date('d.m.Y');

            $file = file_get_contents('gotted_users.json');
            $taskList = json_decode($file, TRUE); 
            $taskList[] = array($id=>$date);
            file_put_contents('gotted_users.json', json_encode($taskList));
            file_put_contents('lib/players/gotted_users.json', json_encode($taskList));
            unset($taskList);

            $json = file_get_contents("data/$id.json");
            $data = json_decode($json);

            #general
            $name = $data->data->customName;
            $level = $data->data->stats->level;
            $clan = $data->data->clan->icon;
            $health = $data->data->values->_health;

            if(empty($name)) {
                $name = '@'.$data->data->username;
            };

            #animal
            $aname = $data->data->animal->name;
            $atype = $data->data->animal->icon;
            $ahlth = $data->data->animal->maxHealth;
            $admg_min = $data->data->animal->minDamage;
            $admg_max = $data->data->animal->maxDamage;
            $aexp = $data->data->animal->experience;
            $aexp_max = $data->data->animal->experienceMax;
            $alvl = $data->data->animal->level;

            #skills
            $strength = $data->data->skills->strength;
            $agility = $data->data->skills->agility;
            $intuition = $data->data->skills->intuition;
            $endurance  = $data->data->skills->endurance;
            $luck = $data->data->skills->luck;

            #info
            $damage_min = $data->data->values->minDamage;
            $damage_max = $data->data->values->maxDamage;
            $defense = $data->data->values->defense;
            $dodge = $data->data->values->chanceDodge;
            $critical = $data->data->values->chanceCritical;
            $counter = $data->data->values->chanceCounter;
            $power = $data->data->values->criticalPower;
            $antidodge = $data->data->values->antiDodge;
            $anticritical = $data->data->values->antiCritical;
            $blessing = $data->data->values->blessing;

            #mastery
            $m_sword = $data->data->values->masterySwords;
            $m_axe = $data->data->values->masteryAxes;
            $m_spear = $data->data->values->masterySpears;
            $m_knife = $data->data->values->masteryDaggers;
            $m_hammer = $data->data->values->masteryHammers;
            $m_animal = $data->data->values->masteryAnimals;

            #stats
            $rating = $data->data->stats->rating;
            $wins = $data->data->stats->wins;
            $loses = $data->data->stats->loses;
            $draws = $data->data->stats->draws;
            $ratingstatus = $data->data->stats->ratingStatus;
            $experience = $data->data->stats->experience;
            $experience_max = $data->data->stats->experienceMax;
            $experience_stage = $data->data->stats->experienceStageMax;

            if(empty($ratingstatus)) {
                $ratingstatus='null';
            };

            #inventory
            $helmet = $data->data->items->helmet->data->_title->ru;
            $armor = $data->data->items->armor->data->_title->ru;
            $boots = $data->data->items->boots->data->_title->ru;
            $gloves = $data->data->items->gloves->data->_title->ru;
            $ring = $data->data->items->ring->data->_title->ru;
            $shield = $data->data->items->shield->data->_title->ru;
            $amulet = $data->data->items->amulet->data->_title->ru;
            $belt = $data->data->items->belt->data->_title->ru;
            $cloak = $data->data->items->cloak->data->_title->ru;
            $weapon = $data->data->items->weapon->data->_title->ru;

            if(empty($cloak)) {
                $cloak = 'null';
            }

            $player_info = "

    <i>Мудрый енот говорит...</i> <br> <br>

            $clan $name 🎖️$level ❤️$health <br><br>

    💪 Сила</strong>: $strength<br>
    ⚡️ Ловкость</strong>: $agility<br>
    🎯 Интуиция</strong>: $intuition<br>
    ❤️ Выносливость</strong>: $endurance<br>
    🎲 Удача</strong>: $luck<br><br>

    🗡️ <strong>Урон</strong>: $damage_min-$damage_max<br>
    🛡️ <strong>Броня</strong>: $defense<br>
    ⚡️ <strong>Уворот</strong>: $dodge<br>
    🎯 <strong>Критический удар</strong>: $critical<br>
    🐍 <strong>Ответный удар</strong>: $counter<br>
    💥 <strong>Мощность</strong>: $power<br>
    💘 <strong>Точность</strong>: $antidodge<br>
    💗 <strong>Стойкость</strong>: $anticritical<br>
    💖 <strong>Благословение</strong>: $blessing<br><br>

    🌟 <strong>Опыт</strong>: $experience → $experience_stage /... / <strong>$experience_max</strong> <br>
    💟 Склонность: <i><strong>В поиске</strong></i><br><br>

    🔹 <strong>Владение мечами</strong>: $m_sword<br>
    🔹 <strong>Владение топорами</strong>: $m_axe<br>
    🔹 <strong>Владение копьями</strong>: $m_spear<br>
    🔹 <strong>Владение ножами</strong>: $m_knife<br>
    🔹 <strong>Владение молотами</strong>: $m_hammer<br>
    🔹 <strong>Дрессировка</strong>: $m_animal<br><br>

    Лига Спарты <br>
    💯 Рейтинг: $rating<br>
    🏆 Побед: $wins<br>
    🤕 Поражений: $loses<br>
    🤝 Ничьих: $draws<br>
    🔸 Статус лиги: $ratingstatus<br><br> 

    🔸 <strong>Оружие</strong>: <i>$weapon</i><br>
    🔸 <strong>Щит</strong>: <i>$shield</i><br>
    🔸 <strong>Шлем</strong>: <i>$helmet</i><br>
    🔸 <strong>Доспех</strong>: <i>$armor</i><br>
    🔸 <strong>Перчатки</strong>: <i>$gloves</i><br>
    🔸 <strong>Сапоги</strong>: <i>$boots</i><br>
    🔸 <strong>Ремень</strong>: <i>$belt</i><br>
    🔸 <strong>Плащ</strong>: <i>$cloak</i><br>
    🔸 <strong>Амулет</strong>: <i>$amulet</i><br>
    🔸 <strong>Кольцо</strong>: <i>$ring</i><br><br>

    Имя: $atype $aname<br>
    🎖️  <strong>Уровень</strong>: $alvl<br> 
    🌟 <strong>Опыт</strong>: $aexp / $aexp_max<br>
    🗡️ <strong>Урон</strong>: $admg_min-$admg_max<br>
    ❤️ <strong>Здоровье</strong>: $ahlth<br>";
    
        file_put_contents("lib/players/$id.html", $player_info);
    
        };

        echo $player_info;
    };
?>