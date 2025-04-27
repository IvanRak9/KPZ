class TextDocument:
    def __init__(self, text):
        self.text = text

    def insert_text(self, index, new_text):
        self.text = self.text[:index] + new_text + self.text[index:]

    def delete_text(self, start_index, end_index):
        self.text = self.text[:start_index] + self.text[end_index:]

    def get_text(self):
        return self.text


class TextEditor:
    def __init__(self, text_document):
        self.text_document = text_document
        self.history = []

    def save(self):
        self.history.append(self.text_document.get_text())

    def undo(self):
        if self.history:
            previous_state = self.history.pop()
            self.text_document = TextDocument(previous_state)

    def insert_text(self, index, new_text):
        self.save()
        self.text_document.insert_text(index, new_text)

    def delete_text(self, start_index, end_index):
        self.save()
        self.text_document.delete_text(start_index, end_index)

    def get_text(self):
        return self.text_document.get_text()


def main():
    initial_text = "Hello, world!"
    document = TextDocument(initial_text)
    editor = TextEditor(document)

    print("Початковий текст:", editor.get_text())

    editor.insert_text(7, " This is a test")
    print("Текст після вставки:", editor.get_text())

    editor.delete_text(12, 17)
    print("Текст після видалення:", editor.get_text())

    editor.undo()
    print("Текст після скасування видалення:", editor.get_text())

    # Скасування вставки
    editor.undo()
    print("Текст після скасування вставки:", editor.get_text())


if __name__ == "__main__":
    main()
