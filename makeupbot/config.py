TOKEN = "TOKEN"

#admins
admin_id = id

link_admin_insta = "link"

#excel-файл
file_xlsx_name = "time_data.xlsx"
book = None
sheet = None
sheet_info_users = None
sheet_logs = None

ListUsersID = []

class Users(object):
    def __init__(self, id):
        self.UserId = id
        self.first_name = ""
        self.last_name = ""
        self.contact = 0
        self.message_id_contact = 0
        self.instagram_username = ""
        self.record_type = ""
        self.record_user = ""
        self.comment_user = ""
        self.lock = 1