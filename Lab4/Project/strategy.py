from pathlib import Path
import base64


class LightElementNode:
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
        html = ''.join(child.outer_html() if isinstance(child, LightElementNode) else child for child in self.children)
        for event, handlers in self.event_listeners.items():
            for handler in handlers:
                html += f'<script>{handler}</script>'
        return html


class ImageElement(LightElementNode):
    def __init__(self, tag_name, display_type, closing_type, href, css_classes=None):
        super().__init__(tag_name, display_type, closing_type, css_classes)
        self.href = href

    def load_image(self):
        if Path(self.href).is_file():
            with open(self.href, "rb") as file:
                image_data = file.read()
                image_base64 = base64.b64encode(image_data).decode("utf-8")
                image_html = f'<img src="data:image/jpeg;base64,{image_base64}" />'
                return image_html
        else:
            return "Image not found"


def main():
    image_from_file = ImageElement("img", "inline", "self-closing", "image/images.jpg")
    image_from_file.add_child(image_from_file.load_image())

    root = LightElementNode("div", "block", "closing")
    root.add_child(image_from_file)

    html = "<!DOCTYPE html>\n<html>\n" + root.outer_html() + "\n</html>"

    with open("image_page.html", "w") as file:
        file.write(html)

    print("HTML сторінка з зображенням з файлової системи збережена у файлі 'image_page.html'.")


if __name__ == "__main__":
    main()
