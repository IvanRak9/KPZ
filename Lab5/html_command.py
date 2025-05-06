class HTMLElement:
    def __init__(self, tag_name, text=""):
        self.tag_name = tag_name
        self.text = text
        self.children = []
        self.parent = None

    def add_child(self, child):
        child.parent = self
        self.children.append(child)

    def remove_child(self, child):
        self.children.remove(child)
        child.parent = None

    def set_text(self, new_text):
        self.text = new_text

    def __str__(self):
        return f"<{self.tag_name}>{self.text}</{self.tag_name}>"


class Command:
    def execute(self):
        pass

    def undo(self):
        pass


class AddElementCommand(Command):
    def __init__(self, parent, child):
        self.parent = parent
        self.child = child

    def execute(self):
        self.parent.add_child(self.child)

    def undo(self):
        self.parent.remove_child(self.child)


class RemoveElementCommand(Command):
    def __init__(self, parent, child):
        self.parent = parent
        self.child = child

    def execute(self):
        self.parent.remove_child(self.child)

    def undo(self):
        self.parent.add_child(self.child)


class ChangeTextCommand(Command):
    def __init__(self, element, new_text):
        self.element = element
        self.new_text = new_text
        self.old_text = element.text

    def execute(self):
        self.element.set_text(self.new_text)

    def undo(self):
        self.element.set_text(self.old_text)


class CommandManager:
    def __init__(self):
        self.history = []

    def execute_command(self, command):
        command.execute()
        self.history.append(command)

    def undo_last(self):
        if self.history:
            command = self.history.pop()
            command.undo()


def main():
    manager = CommandManager()

    root = HTMLElement("div")
    child = HTMLElement("p", "Hello")

    print("Initial root:", root.children)

    add_cmd = AddElementCommand(root, child)
    manager.execute_command(add_cmd)

    print("After add:", [str(c) for c in root.children])

    change_text_cmd = ChangeTextCommand(child, "New Text")
    manager.execute_command(change_text_cmd)
    print("After text change:", child)

    manager.undo_last()
    print("After undo text:", child)

    manager.undo_last()
    print("After undo add:", root.children)

if __name__ == "__main__":
    main()
