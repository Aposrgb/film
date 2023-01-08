<?php

enum FilmType: int
{
    case OSTROV = 1;
    case OTEL = 2;
    case PARASITE = 3;
    case ZOV = 4;
    case IGRA = 5;
    case MILLIARD = 6;
    case PROPOVEDNIK = 7;
    case HISTORY = 8;
    case HOW = 9;
    case MOANA = 10;
    case IT = 11;
    case TRAIN = 12;
    case MAG = 13;

    public static function getImg($type): ?string
    {
        return match ($type) {
            "" . self::OTEL->value => 'img/hotel_belgrad.jpg',
            "" . self::OSTROV->value => 'img/bg_main.jpg',
            "" . self::PARASITE->value => 'img/parazite.jpg',
            "" . self::ZOV->value => 'img/zov_predkov.jpg',
            "" . self::IGRA->value => 'img/game_of_thrones.jpg',
            "" . self::MILLIARD->value => 'img/billions.jpg',
            "" . self::PROPOVEDNIK->value => 'img/propovednik.jpg',
            "" . self::HISTORY->value => 'img/toy_story.jpg',
            "" . self::HOW->value => 'img/how_to_train_dragon.jpg',
            "" . self::MOANA->value => 'img/moana.jpg',
            "" . self::IT->value => 'img/it.jpg',
            "" . self::TRAIN->value => 'img/train_to_busan.jpg',
            "" . self::MAG->value => 'img/meg.jpg',
            default => null
        };
    }

    public static function getRatingK($type): ?string
    {
        return match ($type) {
            "" . self::OTEL->value => '4',
            "" . self::OSTROV->value => '9',
            "" . self::PARASITE->value => '2.5',
            "" . self::ZOV->value => '6.8',
            "" . self::IGRA->value => '5.5',
            "" . self::MILLIARD->value => '9.1',
            "" . self::PROPOVEDNIK->value => '2.3',
            "" . self::HISTORY->value => '9.9',
            "" . self::HOW->value => '9.9',
            "" . self::MOANA->value => '1.1',
            "" . self::IT->value => '3',
            "" . self::TRAIN->value => '5',
            "" . self::MAG->value => '6',
            default => null
        };
    }

    public static function getRatingI($type): ?string
    {
        return match ($type) {
            "" . self::OTEL->value => '4.4',
            "" . self::OSTROV->value => '9.1',
            "" . self::PARASITE->value => '6',
            "" . self::ZOV->value => '7.8',
            "" . self::IGRA->value => '3.5',
            "" . self::MILLIARD->value => '4.1',
            "" . self::PROPOVEDNIK->value => '2.7',
            "" . self::HISTORY->value => '8.9',
            "" . self::HOW->value => '6.9',
            "" . self::MOANA->value => '1.9',
            "" . self::IT->value => '5',
            "" . self::TRAIN->value => '7',
            "" . self::MAG->value => '6.1',
            default => null
        };
    }

    public static function getJanr($type): ?string
    {
        return match ($type) {
            "" . self::OTEL->value => '<span>Комедия</span>, <span>Драмма</span>',
            "" . self::OSTROV->value => '<span>Триллер</span>, <span>Фантастика</span>',
            "" . self::PARASITE->value => '<span>Драмма</span>, <span>Триллер</span>',
            "" . self::ZOV->value => '<span>Приключения</span>, <span>Семейный</span>',
            "" . self::IGRA->value => '<span>Фэнтези</span>, <span>Боевик</span>',
            "" . self::MILLIARD->value => '<span>Драмма</span>',
            "" . self::PROPOVEDNIK->value => '<span>Ужасы</span>, <span>Фэнтези</span>',
            "" . self::HISTORY->value => '<span>Мультфильм</span>, <span>Фэнтези</span>',
            "" . self::HOW->value => '<span>Приключения</span>, <span>Мультфильм</span>',
            "" . self::MOANA->value => '<span>Мультфильм</span>, <span>Мюзикл</span>',
            "" . self::IT->value => '<span>Ужасы</span>, <span>Детектив</span>',
            "" . self::TRAIN->value => '<span>Боевик</span>, <span>Ужасы</span>',
            "" . self::MAG->value => '<span>Ужасы</span>, <span>Фантастика</span>',
            default => null
        };
    }

    public static function getDescription($type): ?string
    {
        return match ($type) {
            "" . self::OTEL->value => 'Балагур Павел Аркадьевич женится за долги. Комедия с Милошем Биковичем, снятая в Сербии и Москве',
            "" . self::OSTROV->value => 'Загадочный мистер Рорк воплощает в жизнь самые смелые и тайные мечты своих постояльцев на роскошном труднодоступном тропическом курорте. Но будут ли готовы гости разгадать тайну острова и спасти свои жизни, когда их фантазии обернутся кошмаром?',
            "" . self::PARASITE->value => 'Семья бедняков обманом получает работу в доме богачей. Южнокорейская драмеди, которая взяла четыре «Оскара»',
            "" . self::ZOV->value => 'Тернистый путь доброго пса Бака в Америке 1880-х. Харрисон Форд в живописной драме по роману Джека Лондона',
            "" . self::IGRA->value => 'Рыцари, мертвецы и драконы — в эпической битве за судьбы мира. Сериал, который навсегда изменил телевидение',
            "" . self::MILLIARD->value => 'Олигарх против прокурора, который хочет посадить его в тюрьму. Напряженная драма о махинациях и борьбе эгоОлигарх против прокурора, который хочет посадить его в тюрьму. Напряженная драма о махинациях и борьбе эго',
            "" . self::PROPOVEDNIK->value => 'Мистическая сущность вселяется в пастора. Потоки крови и черного юмора в провокационном сериале от Сета Рогена',
            "" . self::HISTORY->value => 'Игрушечные ковбой и космонавт соперничают за любовь своего человека. Новаторская и трогательная анимация Pixar',
            "" . self::HOW->value => 'Повзрослевшие Иккинг и Беззубик ищут тайный мир драконов. Продолжение мульт-саги по книгам Крессиды Коуэлл',
            "" . self::MOANA->value => 'Дочь вождя и упрямый полубог спасают природу от гибели. Фееричное странствие по океану с песнями и испытаниями',
            "" . self::IT->value => 'Когда в городке Дерри штата Мэн начинают пропадать дети, несколько ребят сталкиваются со своими величайшими страхами - не только с группой школьных хулиганов, но со злобным клоуном Пеннивайзом, чьи проявления жестокости и список жертв уходят в глубь веков.',
            "" . self::TRAIN->value => 'Беспощадный вирус превращает скоростной поезд в смертельную ловушку. Самый популярный южнокорейский хоррор',
            "" . self::MAG->value => 'Глубоководный батискаф, осуществляющий наблюдение в рамках международной программы по изучению подводной жизни, был атакован огромным существом, которое все считали давно вымершим. Неисправный аппарат теперь лежит на дне глубочайшей впадины Тихого океана… с оказавшимся в ловушке экипажем. Их время на исходе. Китайский океанограф-новатор, несмотря на протесты его дочери Суинь, зовет спасателя-подводника Джонаса Тейлора, чтобы тот помог спасти команду и океан от невиданной угрозы – доисторической 23-метровой акулы, мегалодона. Никто и подумать не мог, что много лет назад Тейлор уже сталкивался с этим чудовищным созданием.',
            default => null
        };
    }

    public static function getRejisser($type): ?string
    {
        return match ($type) {
            "" . self::OTEL->value => '
Константин Статский',
            "" . self::OSTROV->value => '
Джефф Уодлоу',
            "" . self::PARASITE->value => '
Пон Джун-хо',
            "" . self::ZOV->value => '
Крис Сандерс',
            "" . self::IGRA->value => '
Дэвид Наттер, Алан Тейлор, Алекс Грейвз',
            "" . self::MILLIARD->value => '
Колин Бакси, Нил Бёргер, Адам Бернштейн',
            "" . self::PROPOVEDNIK->value => '
Майкл Словис, Эван Голдберг, Сет Роген',
            "" . self::HISTORY->value => '
Джон Лассетер',
            "" . self::HOW->value => '
Дин ДеБлуа',
            "" . self::MOANA->value => '
Рон Клементс, Джон Маскер, Дон Холл',
            "" . self::IT->value => '
Андрес Мускетти',
            "" . self::TRAIN->value => '
Ён Сан-хо',
            "" . self::MAG->value => 'Джон Тёртлтауб',
            default => null
        };
    }

    public static function getActors($type): ?string
    {
        return match ($type) {
            "" . self::OTEL->value => 'Милош Бикович
,Диана Пожарская
,Борис Дергачев
,Александра Кузенкина
,Любомир Бандович
,Барбара Таталович
,Миодраг Радонич
,Елизавета Орашанин
,Срджан Тодорович
,Елисавета Саблич',
            "" . self::OSTROV->value => 'Майкл Пенья
,Мэгги Кью
,Люси Хейл
,Остин Стоуэлл
,Портия Даблдэй
,Джимми О. Ян
,Райан Хансен
,Майкл Рукер
,Париса Фитц-Хенли
,Майк Фогель',
            "" . self::PARASITE->value => 'Сон Кан-хо
,Ли Сон-гюн
,Чо Ё-джон
,Чхве У-щик
,Пак Со-дам
,Чан Хе-джин
,Чон Джи-со
,Чон Хён-джун
,Ли Джон-ын
,Пак Со-джун',
            "" . self::ZOV->value => 'Харрисон Форд
,Омар Си
,Кара Ги
,Дэн Стивенс
,Брэдли Уитфорд
,Джин Луиза Келли
,Майкл Хорс
,Карен Гиллан
,Колин Вуделл
,Мика Фицджералд',
            "" . self::IGRA->value => 'Питер Динклэйдж
,Лина Хиди
,Эмилия Кларк
,Кит Харингтон
,Софи Тёрнер
,Мэйси Уильямс
,Николай Костер-Вальдау
,Иэн Глен
,Алфи Аллен
,Джон Брэдли',
            "" . self::MILLIARD->value => 'Дэмиэн Льюис
,Пол Джаматти
,Мэгги Сифф
,Дэвид Костабайл
,Кондола Рашад
,Дэниэл К. Айзек
,Джеффри ДеМанн
,Дэн Содер
,Азия Кейт Диллон
,Келли АуКойн',
            "" . self::PROPOVEDNIK->value => 'Доминик Купер
,Джозеф Гилган
,Рут Негга
,Йен Коллетти
,Грэм Мактавиш
,Пип Торренс
,Ноа Тейлор
,Джули Энн Эмери
,Малкольм Баррет
,Марк Харелик',
            "" . self::HISTORY->value => 'Том Хэнкс
,Тим Аллен
,Дон Риклз
,Джим Варни
,Уоллес Шоун
,Джон Ратценбергер
,Энни Поттс
,Джон Моррис
,Эрик фон Деттен
,Лори Меткаф',
            "" . self::HOW->value => 'Джей Барушель
,Америка Феррера
,Ф. Мюррэй Абрахам
,Кейт Бланшетт
,Джерард Батлер
,Крэйг Фергюсон
,Джона Хилл
,Кристофер Минц-Плассе
,Кристен Уиг
,Кит Харингтон',
            "" . self::MOANA->value => 'Аулии Кравальо
,Дуэйн Джонсон
,Рэйчел Хаус
,Темуэра Моррисон
,Джемейн Клемент
,Николь Шерзингер
,Алан Тьюдик
,Оскар Кайтли
,Трой Поламалу
,Пуанани Кравальо',
            "" . self::IT->value => 'Джейден Мартелл
,Джереми Рэй Тейлор
,София Лиллис
,Финн Вулфхард
,Чоузен Джейкобс
,Джек Дилан Грейзер
,Уайатт Олефф
,Билл Скарсгард
,Николас Хэмилтон
,Джейк Сим',
            "" . self::TRAIN->value => 'Кон Ю
,Ма Дон-сок
,Чон Ю-ми
,Ким Су-ан
,Ким И-сон
,Чхве У-щик
,Ан Со-хи
,Чхве Гви-хва
,Чон Сог-ён
,Е Су-джон',
            "" . self::MAG->value => 'Джейсон Стэйтем
,Ли Бинбин
,Рэйн Уилсон
,Клифф Кёртис
,Уинстон Чао
,Шуя Софиа Цай
,Руби Роуз
,Пейдж Кеннеди
,Роберт Тейлор
,Оулавюр Дарри Оулафссон',
            default => null
        };
    }

    public static function getTrailers($type): ?string
    {
        return match ($type) {
            "" . self::OTEL->value => 'https://youtu.be/kRjmaFWnJs0',
            "" . self::OSTROV->value => 'https://www.youtube.com/embed/vWeIZ9MjiBs',
            "" . self::PARASITE->value => 'https://youtu.be/GGnM74uxjlo',
            "" . self::ZOV->value => 'https://youtu.be/IYdka8APxVs',
            "" . self::IGRA->value => 'https://youtu.be/Dh1mIO79fxo',
            "" . self::MILLIARD->value => 'https://youtu.be/NPFilbpd_Qs',
            "" . self::PROPOVEDNIK->value => 'https://youtu.be/1iWBPf-jRlM',
            "" . self::HISTORY->value => 'https://youtu.be/zBZ7wIoTW_A',
            "" . self::HOW->value => 'https://youtu.be/KGayl0JOXUw',
            "" . self::MOANA->value => 'https://youtu.be/LtbnhPkUNDE',
            "" . self::IT->value => 'https://youtu.be/FnCdOQsX5kc',
            "" . self::TRAIN->value => 'https://youtu.be/58r-Rq_TuEI',
            "" . self::MAG->value => 'https://youtu.be/4IouO9mhOc0',
            default => null
        };
    }
}