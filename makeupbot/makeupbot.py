import telebot
from telebot import types
import time
import os

import config
import answer
import core

bot = telebot.TeleBot(config.TOKEN)
core.load_book_file()

button1 = types.KeyboardButton(answer.TEXT_BUTTON1)
button2 = types.KeyboardButton(answer.TEXT_BUTTON2)
button3 = types.KeyboardButton(answer.TEXT_BUTTON3)
button5 = types.KeyboardButton(answer.TEXT_BUTTON5)
button_contact = types.KeyboardButton(text = answer.TEXT_BUTTON_CONTACT, request_contact = True)

@bot.message_handler(commands=['start'])
def add_buttons(message):
    core.add_id_users_excel(message.chat.id)
    core.init_userList(message.chat.id)
    key_user = core.get_user_key(message.chat.id)
    core.tracking_flag_lock(key_user)
    core.add_LOG(message.chat.id, message.text, str(message.from_user.first_name), str(message.from_user.last_name))
    if config.ListUsersID[key_user].lock == 0:
        if message.chat.id == config.admin_id:
            markup_add = types.ReplyKeyboardMarkup(resize_keyboard=True, row_width=1)
            markup_add.add(button1, button2, button3)
            bot.reply_to(message, answer.TEXT_WELCOME_ADMIN, reply_markup = markup_add)
        else:
            if core.output_for_users() == False:
                bot.send_message(message.chat.id, answer.TEXT_EMPTY_SHEDULE__USERS, reply_markup=types.ReplyKeyboardRemove())
            else:
                markup_add = types.ReplyKeyboardMarkup(resize_keyboard=True, row_width=1)
                markup_add.add(button_contact)
                bot.reply_to(message, answer.TEXT_WELCOME_USERS, reply_markup = markup_add)
    elif config.ListUsersID[key_user].lock == 3:
            config.ListUsersID[key_user].lock = 0
            bot.send_message(message.chat.id, answer.TEXT_START_IN_RECORD)
    else:
        bot.send_message(message.chat.id, answer.TEXT_USER_LOG1 + core.pull_user_record(message.chat.id) + "\n" + answer.TEXT_ERROR_AFTER_RECORDING_USER)
        core.add_LOG(message.chat.id, answer.TEXT_USER_LOG1 + core.pull_user_record(message.chat.id))

@bot.message_handler(commands=['new_update_pass_1939'])
def funk_update(message):
    if message.chat.id == id:
        bot.send_message(id, answer.TEXT_UPDATE)
        bot.send_message(id, "Відправив інформацію про оновлення")

@bot.message_handler(commands=['video'])
def give_video(message):
    if core.check_user_in_system(message.chat.id) == True:
        if config.ListUsersID[core.get_user_key(message.chat.id)].lock == 0:
            if os.path.isfile('instruc.mp4'):
                bot.send_message(message.chat.id, answer.TEXT_VIDEO_USER)
                bot.send_video(message.chat.id, open('instruc.mp4', 'rb'))
            else:
                bot.send_message(message.chat.id, answer.TEXT_ERROR_VIDEO)
        elif config.ListUsersID[core.get_user_key(message.chat.id)].lock == 1:
            bot.send_message(message.chat.id, answer.TEXT_WRITE_START)
        else:
            bot.send_message(message.chat.id, answer.TEXT_USER_LOG1 + core.pull_user_record(message.chat.id) + "\n" + answer.TEXT_ERROR_AFTER_RECORDING_USER)
    else:
        bot.send_message(message.chat.id, answer.TEXT_WRITE_START)

@bot.message_handler(content_types=['sticker', 'animation'])
def reaction_sticker(message):
    bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL)

@bot.callback_query_handler(func = lambda call: True)
def call_func(call):
    key_user = core.get_user_key(call.message.chat.id)
    bot.answer_callback_query(call.id)
    bot.delete_message(call.message.chat.id, call.message.id)
    if call.data == 'yes_verification':
        core.enroll_user(config.ListUsersID[key_user].record_user, key_user)
        core.add_record_user_excel(config.ListUsersID[key_user].record_user, key_user)
        core.add_LOG(call.message.chat.id, answer.TEXT_USER_LOG2)
        create_inline_button_comment(call.message)
    elif call.data == 'no_verification':
        config.ListUsersID[key_user].record_user = ""
        markup_add = types.ReplyKeyboardMarkup(resize_keyboard=True, row_width=1)
        markup_add.add(button5)
        bot.send_message(call.message.chat.id, answer.TEXT_RETURN_MENU + answer.TEXT_USER_NOT_SIGNED, reply_markup=markup_add)
    elif call.data == 'yes_insta':
        bot.send_message(call.message.chat.id, answer.TEXT_USER_SAVE_INSTA)
        core.add_LOG(call.message.chat.id, answer.TEXT_USER_SAVE_INSTA)
        choice_type_record(call.message)
    elif call.data == 'no_insta':
        config.ListUsersID[key_user].instagram_username = ""
        bot.register_next_step_handler(bot.send_message(call.message.chat.id, answer.TEXT_USER_RETRY_INSTA), save_insta)
    elif call.data == 'yes_comment':
        core.add_LOG(call.message.chat.id, answer.TEXT_USER_WANTS_WRITE_COMMENT)
        bot.register_next_step_handler(bot.send_message(call.message.chat.id, answer.TEXT_USER_WANTS_WRITE_COMMENT), user_comment, key_user)
    elif call.data == 'no_comment':
        config.ListUsersID[key_user].comment_user = answer.TEXT_THERE_IS_NO
        core.add_LOG(call.message.chat.id, answer.TEXT_THERE_IS_NO)
        result_work_bot(call.message, key_user)
    elif call.data == 'hairstyle':
        markup_add = types.ReplyKeyboardMarkup(resize_keyboard=True, row_width=1)
        markup_add.add(button5)
        config.ListUsersID[key_user].record_type = answer.TEXT_HAIRSTYLE
        core.add_LOG(call.message.chat.id, answer.TEXT_USER_RECORD_TYPE_1 + answer.TEXT_HAIRSTYLE)
        bot.send_message(call.message.chat.id, answer.TEXT_USER_RECORD_TYPE_1 + config.ListUsersID[key_user].record_type + answer.TEXT_USER_RECORD_TYPE_2, reply_markup=markup_add)
    elif call.data == 'make-up':
        markup_add = types.ReplyKeyboardMarkup(resize_keyboard=True, row_width=1)
        markup_add.add(button5)
        config.ListUsersID[key_user].record_type = answer.TEXT_MAKEUP
        core.add_LOG(call.message.chat.id, answer.TEXT_USER_RECORD_TYPE_1 + answer.TEXT_MAKEUP)
        bot.send_message(call.message.chat.id, answer.TEXT_USER_RECORD_TYPE_1 + config.ListUsersID[key_user].record_type + answer.TEXT_USER_RECORD_TYPE_2, reply_markup=markup_add)
    elif call.data == 'hairstyle&make-up':
        markup_add = types.ReplyKeyboardMarkup(resize_keyboard=True, row_width=1)
        markup_add.add(button5)
        config.ListUsersID[key_user].record_type = answer.TEXT_HAIRSTYLE_MAKEUP
        core.add_LOG(call.message.chat.id, answer.TEXT_USER_RECORD_TYPE_1 + answer.TEXT_HAIRSTYLE_MAKEUP)
        bot.send_message(call.message.chat.id, answer.TEXT_USER_RECORD_TYPE_1 + config.ListUsersID[key_user].record_type + answer.TEXT_USER_RECORD_TYPE_2, reply_markup=markup_add)
    elif call.data == 'photoset':
        markup_add = types.ReplyKeyboardMarkup(resize_keyboard=True, row_width=1)
        markup_add.add(button5)
        config.ListUsersID[key_user].record_type = answer.TEXT_PHOTOSET
        core.add_LOG(call.message.chat.id, answer.TEXT_USER_RECORD_TYPE_1 + answer.TEXT_PHOTOSET)
        bot.send_message(call.message.chat.id, answer.TEXT_USER_RECORD_TYPE_1 + config.ListUsersID[key_user].record_type + answer.TEXT_USER_RECORD_TYPE_2, reply_markup=markup_add)

@bot.message_handler(content_types=['contact'])
def save_contact(message):
    key_user = core.get_user_key(message.chat.id)
    if core.check_user_in_system(message.chat.id):
        if message.contact.user_id == message.chat.id:
            config.ListUsersID[key_user].contact = message.contact.phone_number
            config.ListUsersID[key_user].first_name = str(message.from_user.first_name)
            config.ListUsersID[key_user].last_name = str(message.from_user.last_name)
            config.ListUsersID[key_user].message_id_contact = message.message_id
            bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_USER_SAVE_CONTACT, reply_markup=types.ReplyKeyboardRemove()), save_insta)
        elif config.ListUsersID[key_user].contact != None:
            bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL)
        else:
            bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL)
    else:
        bot.send_message(message.chat.id, answer.TEXT_WRITE_START)

@bot.message_handler(func = lambda message: True)
def menu(message):
    key_user = core.get_user_key(message.chat.id)
    if message.chat.type == 'private':
        if core.check_user_in_system(message.chat.id) == True:
            if config.ListUsersID[key_user].lock == 0 or message.chat.id == config.admin_id:
                if core.output_for_users() or message.chat.id == config.admin_id:
                    if config.ListUsersID[key_user].contact != 0 and config.ListUsersID[key_user].instagram_username != "" or message.chat.id == config.admin_id:
                        if config.ListUsersID[key_user].record_type != "" or message.chat.id == config.admin_id:
                            if message.text == answer.TEXT_BUTTON1 and message.chat.id == config.admin_id:
                                bot.send_message(message.chat.id, core.output_sort_data_admin())
                            elif message.text == answer.TEXT_BUTTON2 and message.chat.id == config.admin_id:
                                bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ANSWER_ADD_DATA), add_row)
                            elif message.text == answer.TEXT_BUTTON3 and message.chat.id == config.admin_id:
                                if config.sheet['A1'].value == None:
                                    bot.send_message(message.chat.id, core.output_sort_data_admin())
                                else:
                                    mesg = bot.send_message(message.chat.id, core.output_sort_data_admin() +  answer.TEXT_ANSWER_DELETE_ROW)
                                    bot.register_next_step_handler(mesg, delete_row)
                            elif message.text == answer.TEXT_BUTTON5:
                                mesg = bot.send_message(message.chat.id, answer.TEXT_USER_FREE_HOURS_1 + core.output_for_users() + answer.TEXT_USER_FREE_HOURS_2, reply_markup=types.ReplyKeyboardRemove())
                                bot.register_next_step_handler(mesg, enroll_user)
                            else:
                                bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL)
                        else:
                            bot.send_message(message.chat.id, answer.TEXT_INLINE_BUTTON_TYPE)
                    else:
                        bot.send_message(message.chat.id, answer.TEXT_USER_SUBMIT_YOUR_CONTACT_ELSE)
                else:
                    bot.send_message(message.chat.id, answer.TEXT_EMPTY_SHEDULE__USERS)
            elif config.ListUsersID[key_user].lock == 1:
                bot.send_message(message.chat.id, answer.TEXT_WRITE_START)
            else:
                bot.send_message(message.chat.id, answer.TEXT_USER_LOG1 + core.pull_user_record(message.chat.id) + "\n" + answer.TEXT_ERROR_AFTER_RECORDING_USER)
                core.add_LOG(message.chat.id, answer.TEXT_USER_LOG1 + core.pull_user_record(message.chat.id))
        else:
            bot.send_message(message.chat.id, answer.TEXT_WRITE_START)
    else:
        bot.send_message(message.chat.id, answer.TEXT_ERROR_GROUP)

def add_row(message):
    try:
        if message.text.lower() == answer.TEXT_EXIT_FUNC.lower():
            return bot.send_message(message.chat.id, answer.TEXT_RETURN_MENU)
        dates = message.text.split("\n")
        if core.check_date(dates, len(dates)) == 1:
            for counter in range(len(dates)):
                if (time.strptime(dates[counter], '%d.%m %H:%M') > time.strptime(core.init_today(), '%d.%m %H:%M')):
                    core.data_recording(dates[counter])
                else:
                    bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), add_row)
                    break
                if counter == len(dates) - 1:
                    bot.send_message(message.chat.id, answer.TEXT_ANSWER_ADD_DATA_SAVE)
                    bot.send_message(message.chat.id, core.output_sort_data_admin())
                    core.add_LOG(message.chat.id, "admin add record " + str(message.text))
        else:
            bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), add_row)
    except ValueError as ve:
        print("func: add_row ValueError\n", ve)
        bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), add_row)
    except TypeError as te:
        print("func: add_row TypeError\n", te)
        bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), add_row)

def delete_row(message):
    try:
        if message.text.lower() == answer.TEXT_EXIT_FUNC.lower():
            return bot.send_message(message.chat.id, answer.TEXT_RETURN_MENU)
        reverse_numbers = sorted(map(int, message.text.split(",")), reverse=True)
        for counter in range(len(reverse_numbers)):
            if  (0 < int(reverse_numbers[counter]) < (config.sheet.max_row + 1)):
                if config.sheet[int(reverse_numbers[counter])][2].value != None:
                    bot.send_message(config.sheet[int(reverse_numbers[counter])][2].value, answer.TEXT_USER_MESG_DELETE_DATA)
                    core.delete_record_sheet_users(config.sheet[int(reverse_numbers[counter])][2].value)
                config.sheet = config.book['Shedule']
                config.sheet.delete_rows(idx = int(reverse_numbers[counter]), amount = 1)
            else:
                bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), delete_row)
                break
            if counter == len(reverse_numbers) - 1:
                bot.send_message(message.chat.id, core.output_sort_data_admin())
                core.add_LOG(message.chat.id, "admin delete record")
    except ValueError as ve:
        print("func: delete_row ValueError\n", ve)
        bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), delete_row)
    except TypeError as te:
        print("func: delete_row TypeError\n", te)
        bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), delete_row)

def enroll_user(message):
    try:
        if message.text.lower() == answer.TEXT_EXIT_FUNC.lower():
            markup_add = types.ReplyKeyboardMarkup(resize_keyboard=True, row_width=1)
            markup_add.add(button5)
            return bot.send_message(message.chat.id, answer.TEXT_RETURN_MENU, reply_markup=markup_add)
        if  (0 < int(message.text) < core.value_free_places_for_users() + 1):
            bot.send_message(message.chat.id, answer.TEXT_USER_CHECK_DATA + core.info_check_user(int(message.text)))
            config.ListUsersID[core.get_user_key(message.chat.id)].record_user = core.info_check_user(int(message.text))
            create_inline_button_verification(message)
        else:
            bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), enroll_user)
    except ValueError as ve:
        print("func: enroll_user ValueError\n", ve)
        bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), enroll_user)
    except TypeError as te:
        print("func: enroll_user TypeError\n", te)
        bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), enroll_user)

def create_inline_button_verification(message):
    markup_inline_output = types.InlineKeyboardMarkup()
    button_yes = types.InlineKeyboardButton(text = answer.TEXT_YES, callback_data = 'yes_verification')
    button_no = types.InlineKeyboardButton(text = answer.TEXT_NO, callback_data = 'no_verification')
    markup_inline_output.add(button_yes, button_no)
    bot.send_message(message.chat.id, answer.TEXT_INLINE_BUTTON_VERIFICATION, reply_markup = markup_inline_output)

def create_inline_button_comment(message):
    markup_inline_output = types.InlineKeyboardMarkup()
    button_yes = types.InlineKeyboardButton(text = answer.TEXT_YES, callback_data = 'yes_comment')
    button_no = types.InlineKeyboardButton(text = answer.TEXT_NO, callback_data = 'no_comment')
    markup_inline_output.add(button_yes, button_no)
    bot.send_message(message.chat.id, answer.TEXT_INLINE_BUTTON_Q_WRITE_COMMENT, reply_markup = markup_inline_output)

def link_to_admin_insta(message):
    markup_inline_output = types.InlineKeyboardMarkup()
    button_insta = types.InlineKeyboardButton(text = answer.TEXT_GO_LINK, url = config.link_admin_insta)
    markup_inline_output.add(button_insta)
    bot.send_message(message.chat.id, answer.TEXT_INLINE_BUTTON_ADMIN_INSTA, reply_markup = markup_inline_output)

def link_to_user_insta(key_user):
    markup_inline_output = types.InlineKeyboardMarkup()
    button_insta = types.InlineKeyboardButton(text = answer.TEXT_GO_LINK, url = "https://www.instagram.com/" + config.ListUsersID[key_user].instagram_username + "/")
    markup_inline_output.add(button_insta)
    bot.send_message(config.admin_id, answer.TEXT_INLINE_BUTTON_USER_INSTA, reply_markup = markup_inline_output)

def save_insta(message):
    try:
        core.add_LOG(message.chat.id, message.text, str(message.from_user.first_name), str(message.from_user.last_name))
        key_user = core.get_user_key(message.chat.id)
        if message.text.lower() == answer.TEXT_THERE_IS_NO.lower():
            config.ListUsersID[key_user].instagram_username = answer.TEXT_THERE_IS_NO
            bot.send_message(message.chat.id, answer.TEXT_USER_DOES_HAVE_INSTA)
            core.add_LOG(message.chat.id, answer.TEXT_USER_DOES_HAVE_INSTA)
            choice_type_record(message)
            return
        if core.check_text_instagram_username(message.text):
            config.ListUsersID[key_user].instagram_username = message.text
            markup_inline_output = types.InlineKeyboardMarkup()
            button_yes = types.InlineKeyboardButton(text = answer.TEXT_YES, callback_data = 'yes_insta')
            button_no = types.InlineKeyboardButton(text = answer.TEXT_NO, callback_data = 'no_insta')
            markup_inline_output.add(button_yes, button_no)
            bot.send_message(message.chat.id, answer.TEXT_INLINE_BUTTON_INSTA_VERIFICATION + config.ListUsersID[key_user].instagram_username, reply_markup = markup_inline_output)
        else:
            bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), save_insta)
    except Exception as e:
        print("func save_insta:\n", e)
        config.ListUsersID[key_user].instagram_username = ""
        bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), save_insta)

def choice_type_record(message):
    markup_inline_output = types.InlineKeyboardMarkup(row_width=1)
    button_hair = types.InlineKeyboardButton(text = answer.TEXT_HAIRSTYLE, callback_data = 'hairstyle')
    button_make = types.InlineKeyboardButton(text = answer.TEXT_MAKEUP, callback_data = 'make-up')
    button_hair_make = types.InlineKeyboardButton(text = answer.TEXT_HAIRSTYLE_MAKEUP, callback_data = 'hairstyle&make-up')
    button_photoset = types.InlineKeyboardButton(text = answer.TEXT_PHOTOSET, callback_data = 'photoset')
    markup_inline_output.add(button_hair, button_make, button_hair_make, button_photoset)
    bot.send_message(message.chat.id, answer.TEXT_INLINE_BUTTON_TYPE, reply_markup = markup_inline_output)

def user_comment(message, key_user):
    try:
        core.add_LOG(message.chat.id, message.text, str(message.from_user.first_name), str(message.from_user.last_name))
        config.ListUsersID[key_user].comment_user = message.text
        result_work_bot(message, key_user)
    except Exception as e:
        print("func: user_comment: Exception:\n", e)
        core.add_LOG(message.chat.id, answer.TEXT_ERROR_GENERAL)
        bot.register_next_step_handler(bot.send_message(message.chat.id, answer.TEXT_ERROR_GENERAL), user_comment, key_user)

def result_work_bot(message, key_user):
    # USER
    bot.send_message(message.chat.id, core.info_record_user(message.chat.id))
    link_to_admin_insta(message)
    # ADMIN
    bot.send_message(config.admin_id, core.info_record_admin(message.chat.id))
    bot.forward_message(config.admin_id, message.chat.id, config.ListUsersID[key_user].message_id_contact)
    if config.ListUsersID[key_user].instagram_username != answer.TEXT_THERE_IS_NO:
        link_to_user_insta(key_user)
    # lock = 2
    core.tracking_flag_lock(key_user)
    core.add_LOG(message.chat.id, answer.TEXT_USER_LOG3)

try:
    bot.polling(none_stop = True)
except Exception as e:
    bot.send_message(id, e)
    bot.send_message(id, answer.TEXT_EXIT_FUNC)
    
