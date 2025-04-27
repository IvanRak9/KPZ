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

    def add_child(self, child):
        self.children.append(child)

    def outer_html(self):
        attributes = ' '.join([f'class="{cls}"' for cls in self.css_classes])
        opening_tag = f"<{self.tag_name} {attributes}>" if attributes else f"<{self.tag_name}>"
        closing_tag = f"</{self.tag_name}>" if self.closing_type == "closing" else f"<{self.tag_name}/>"
        return opening_tag + self.inner_html() + closing_tag

    def inner_html(self):
        return ''.join(child.outer_html() if isinstance(child, LightElementNode) else child.text for child in self.children)


def main():
    body = LightElementNode("body", "block", "closing", ["main-body"])
    header = LightElementNode("header", "block", "closing", ["page-header"])
    header.add_child(LightTextNode("Welcome to LightHTML"))
    body.add_child(header)

    nav = LightElementNode("nav", "block", "closing", ["page-navigation"])
    nav.add_child(LightTextNode("Home"))
    nav.add_child(LightTextNode("About"))
    nav.add_child(LightTextNode("Services"))
    body.add_child(nav)

    main_content = LightElementNode("div", "block", "closing", ["main-content"])
    main_content.add_child(LightTextNode("This is the main content area"))
    body.add_child(main_content)

    footer = LightElementNode("footer", "block", "closing", ["page-footer"])
    footer.add_child(LightTextNode("© 2024 LightHTML"))
    body.add_child(footer)

    html = "<!DOCTYPE html>\n<html>\n" + body.outer_html() + "\n</html>"

    with open("output.html", "w") as file:
        file.write(html)

    print("HTML сторінка збережена у файлі 'output.html'.")


if __name__ == "__main__":
    main()
