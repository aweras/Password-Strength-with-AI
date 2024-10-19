class User:
    def __init__(self, name, surname, password, email) -> None:
        self.name = name
        self.surname = surname
        self.password = password
        self.email = email

    def to_dict(self):
        return {
            "name": self.name,
            "surname": self.surname,
            "email": self.email
        }