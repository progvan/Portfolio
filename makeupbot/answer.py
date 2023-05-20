#ПОМИЛКИ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
TEXT_ERROR_GROUP = "Я не призначений для груп, видаліть мене."
#помилки з користувачем
TEXT_ERROR_AFTER_RECORDING_USER = "Якщо виникли якісь проблеми, то звертайтеся до адміну, посилання на його instagram вгорі."
TEXT_START_IN_RECORD = "Кнопка \"/start\" не функціонує в період вашого запису. \nМожете скористатися командою \"/video\", щоб бот вам надіслав відео-інструкцію як правильно записуватися."
#спільні помилки
TEXT_ERROR_GENERAL = "Некоректно введені дані"
TEXT_ERROR_VIDEO = "Сталася помилка, відео відсутнє"
#------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

#ВІДПОВІДІ БОТА АДМІНУ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
#привітання
TEXT_WELCOME_ADMIN = "Добрий день, я готовий до роботи"
#додавання нового запису
TEXT_ANSWER_ADD_DATA = "Напиши дату та час нового запису.\nПриклад вашого повідомлення:\nXX.XX XX:XX\n14.11 15:00\nМожна видалити і декілька дат разом, наприклад:\n15.11 15:00\n16.11 15:00\n17.11 15:00\n\nЯкщо ти хочеш повернутися до меню напиши \"Вийти\"."
TEXT_ANSWER_ADD_DATA_SAVE = "Я все записав, ось результат:"
#видалення запису
TEXT_ANSWER_DELETE_ROW = "\nВкажи який рядок хочеш видалити (просто цифра). Якщо захочеш повернутися до меню напиши \"Вийти\".\n\n❗️Зверни увагу: Якщо запис кимось зайнятий і ти його видалиш, тій людині яка була записана на цей час прийде повідомлення про видалення."
#пуста таблиця
TEXT_EMPTY_SHEDULE__ADMIN = "Графік пустий"
#текст оновлення
TEXT_UPDATE = "Версія бота 1.12.2\n-бот зберігається на віддаленому репозиторії на гітхаб та зв'язаний як на сайті де він хоститься так і на локальному комп'ютері розробника що забезпечує зручніше обслуговування бота."
#------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

#ВІДПОВІДІ БОТА КОРИСТУВАЧУ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
#привітання
TEXT_WELCOME_USERS = ("Добрий день, вас вітає MBot, який призначений для зручного запису на beauty процедури 💋💄"
                    + "\nТут ви можете обрати будь-яку послугу, яка вас цікавить, а саме:"
                    + "\n- макіяж\n- зачіска\n- макіяж + зачіска\n- фотосет 3в1."
                    + "\nДля запису надайте свій номер телефону та нікнейм від Instagram. Це потрібно для подальшого зв'язку з вами, а також є гарантією, що ви не робот."
                    + "\nМожете натиснути \"/video\", тоді вам буде надіслано відео-інструкція як правильно записуватися."
                    + "\n\n❗️Вся інформація, яку ви надаєте нам - конфіденційна❗️")
#запис телефону
TEXT_USER_SUBMIT_YOUR_CONTACT_ELSE = "Надайте свій номер телефону за допомогою кнопки під клавіатурою"
TEXT_USER_SAVE_CONTACT = "Ваш телефон збережено. \nТепер напишіть свій нікнейм у instagram без символу \"@\". Якщо у вас немає instagram, напишіть \"Немає\""
#запис інстаграм аккаунту
TEXT_USER_RETRY_INSTA = "Напишіть свій instagram-account без символу \"@\". Якщо у вас немає instagram, напишіть \"Немає\""
TEXT_USER_SAVE_INSTA = "Ваш обліковий запис збережено. "
TEXT_USER_DOES_HAVE_INSTA = "Ваша відповідь записана."
#обирання процедури
TEXT_USER_RECORD_TYPE_1 = "Ви обрали «"
TEXT_USER_RECORD_TYPE_2 = "». Тепер можете записатися."
#запис користувача
TEXT_USER_FREE_HOURS_1 = "Ось які є вільні годинки:\n"
TEXT_USER_FREE_HOURS_2 = "\nВкажіть цифру рядка якого ви хочете обрати\nЯкщо немає підходящого запису для вас, напишіть \"Вийти\""
TEXT_USER_CHECK_DATA = "Ви будете записані на "
TEXT_USER_NOT_SIGNED = "Можете записатися на іншу годину або написати пізніше коли з'являться нові."
TEXT_EMPTY_SHEDULE__USERS = "На разі вільних годинок немає, спробуйте написати пізніше."
TEXT_USER_MESG_DELETE_DATA = "Ваш запис скасував адмін. Якщо бажаєте записатися, натисніть  \"/start\""
#запис коментаря
TEXT_USER_WANTS_WRITE_COMMENT = "Наступне ваше повідомлення буде переслане адміну."
#
TEXT_VIDEO_USER = "Зачекайте, відео завантажуєтся"
#------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

#ВІДПОВІДІ ЯКІ ВИКОРИСТОВУЮТЬСЯ І ДЛЯ АДМІНА І ДЛЯ КОРИСТУВАЧА
TEXT_RETURN_MENU = "Повертаю вас у головне меню. "
TEXT_WRITE_START = "Натисніть \"/start\""

#logs
TEXT_USER_LOG1 = "Ви записані на "
TEXT_USER_LOG2 = "Користувач записаний"
TEXT_USER_LOG3 = "Користувач записаний та інформація про користувача відправлена адміну"

#НАЗВИ ГОЛОВНИХ КНОПОК
TEXT_BUTTON1 = "📍Вивести графік"
TEXT_BUTTON2 = "✏️Записати нові годинки"
TEXT_BUTTON3 = "🗑️Видалити рядки"
TEXT_BUTTON5 = "Записатися✏️"
TEXT_BUTTON_CONTACT = "Надати свій телефон📱"

#НАЗВИ ПОВІДОМЛЕНЬ НАД INLINE-КНОПКАМИ
TEXT_INLINE_BUTTON_INSTA_VERIFICATION = "Перевірте чи правильно ви ввели свій instagram\n\n"
TEXT_INLINE_BUTTON_TYPE = "Тепер оберіть послугу, на яку хочете записатися."
TEXT_INLINE_BUTTON_VERIFICATION = "Все правильно?"
TEXT_INLINE_BUTTON_Q_WRITE_COMMENT = "У вас є запитання чи пропозиції?"
TEXT_INLINE_BUTTON_ADMIN_INSTA = "Посилання на Instagram майстра"
TEXT_INLINE_BUTTON_USER_INSTA = "Посилання на Instagram клієнта"

#НАЗВИ INLINE-КНОПОК
TEXT_GO_LINK = "Перейти за посиланням"
TEXT_YES = "Так"
TEXT_NO = "Ні"
TEXT_HAIRSTYLE = "Зачіска"
TEXT_MAKEUP = "Макіяж"
TEXT_HAIRSTYLE_MAKEUP = "Зачіска + Макіяж"
TEXT_PHOTOSET = "Фотосет 3 в 1"


#КЛЮЧОВІ СЛОВА У ФУНКЦІЯХ
TEXT_THERE_IS_NO = "Немає"
TEXT_EXIT_FUNC = "Вийти"