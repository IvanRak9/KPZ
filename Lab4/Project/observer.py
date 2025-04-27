class LightNode:
    pass


class LightTextNode(LightNode):
    def __init__(self, text):
        self.text = text


class LightElementNode(LightNode):
    def __init__(self, tag_name, display_type, closing_type, css_classes=None):
        self.tag_name = tag_name
        self.display_type = display_type
        self.closing_type = closing_type
        self.css_classes = css_classes if css_classes else []
        self.children = []
        self.event_listeners = {}

    def add_child(self, child):
        self.children.append(child)

    def add_event_listener(self, event, handler):
        if event in self.event_listeners:
            self.event_listeners[event].append(handler)
        else:
            self.event_listeners[event] = [handler]

    def outer_html(self):
        attributes = ' '.join([f'class="{cls}"' for cls in self.css_classes])
        opening_tag = f"<{self.tag_name} {attributes}>" if attributes else f"<{self.tag_name}>"
        closing_tag = f"</{self.tag_name}>" if self.closing_type == "closing" else f"<{self.tag_name}/>"
        return opening_tag + self.inner_html() + closing_tag

    def inner_html(self):
        html = ''.join(child.outer_html() if isinstance(child, LightElementNode) else child.text for child in self.children)
        for event, handlers in self.event_listeners.items():
            for handler in handlers:
                html += f'<script>{handler}</script>'
        return html


def main():
    book_text = """
    Chapter 1: Introduction
    This is the introduction to the book.

    Chapter 2: Body
    This is the main content of the book.

    Conclusion
    This concludes the book.
    """

    lines = book_text.split('\n')

    root = LightElementNode("div", "block", "closing")
    current_element = None

    for line in lines:
        if line.strip() == "":
            continue
        elif line.startswith("Chapter"):
            current_element = LightElementNode("h2", "block", "closing")
            current_element.add_child(LightTextNode(line.strip()))
            root.add_child(current_element)
            subscribe_button = LightElementNode("button", "inline", "closing", ["btn", "subscribe-button"])
            subscribe_button.add_child(LightTextNode(f"Subscribe {line.strip()}"))
            current_element.add_child(subscribe_button)
            subscribe_handler = f"""
            console.log('Підписались на {line.strip()}');
            """
            subscribe_button.add_event_listener("click", subscribe_handler)
        elif len(line) < 20:
            current_element = LightElementNode("h3", "block", "closing")
            current_element.add_child(LightTextNode(line.strip()))
            root.add_child(current_element)
        elif line.startswith(" "):
            current_element = LightElementNode("blockquote", "block", "closing")
            current_element.add_child(LightTextNode(line.strip()))
            root.add_child(current_element)
        else:
            current_element = LightElementNode("p", "block", "closing")
            current_element.add_child(LightTextNode(line.strip()))
            root.add_child(current_element)

    subscribe_script = """
    <script>
    const buttons = document.querySelectorAll('.subscribe-button');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            console.log('Subscribe');
        });
    });
    </script>
    """
    root.add_child(LightTextNode(subscribe_script))

    for i in range(1, 4):
        subscribe_button = LightElementNode("button", "inline", "closing", ["btn", "subscribe-button"])
        subscribe_button.add_child(LightTextNode(f"Subscribe Chapter {i}"))
        root.add_child(subscribe_button)
        subscribe_handler = f"""
        console.log('Subscribe to Chapter {i}');
        """
        subscribe_button.add_event_listener("click", subscribe_handler)

    html = "<!DOCTYPE html>\n<html>\n" + root.outer_html() + "\n</html>"

    with open("book.html", "w") as file:
        file.write(html)

    print("HTML сторінка збережена у файлі 'book.html'.")


if __name__ == "__main__":
    main()
